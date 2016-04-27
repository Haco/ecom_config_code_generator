<?php
namespace S3b0\EcomConfigCodeGenerator\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>, ecom instruments GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * Class AjaxRequestController
 *
 * @package S3b0\EcomConfigCodeGenerator\Controller
 */
class AjaxRequestController extends \S3b0\EcomConfigCodeGenerator\Controller\GeneratorController
{

    /**
     * @var \TYPO3\CMS\Extbase\Mvc\View\JsonView $view
     */
    protected $view;

    /**
     * @var string
     */
    protected $defaultViewObjectName = \TYPO3\CMS\Extbase\Mvc\View\JsonView::class;

    /**
     * Initializes the controller before invoking an action method.
     *
     * Override this method to solve tasks which all actions have in
     * common.
     *
     * @return void
     * @api
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
     */
    public function initializeAction()
    {
        global $TYPO3_CONF_VARS;
        /** !!! IMPORTANT TO MAKE JSON WORK !!! */
        $TYPO3_CONF_VARS[ 'FE' ][ 'debug' ] = '0';
        $this->contentObject = $this->contentRepository->findByUid($this->request->getArgument('cObj'));
        parent::initializeAction();
    }

    /**
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentNameException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    public function initializeUpdatePartAction()
    {
        if ($this->request->hasArgument('part') && !$this->request->getArgument('part') instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Part) {
            if (MathUtility::canBeInterpretedAsInteger($this->request->getArgument('part'))) {
                $this->request->setArgument('part', $this->partRepository->findByUid($this->request->getArgument('part')));
            } elseif (preg_match('/^[a-z0-9]+$/i', $this->request->getArgument('part'))) {
                $page = $this->getDatabaseConnection()->exec_SELECTgetSingleRow('tx_product', 'pages', "uid={$this->contentObject->getPid()}");
                /** @var \S3b0\EcomProductTools\Domain\Model\Product $product */
                $product = $this->productRepository->findByUid($page[ 'tx_product' ]);
                $pseudoPartGroup = new \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup(1, $this->configuration);
                /** @var \S3b0\EcomProductTools\Domain\Model\Accessory $accessory */
                foreach ($product->getAccessories() as $accessory) {
                    if (preg_match("/{$this->request->getArgument('part')}/im", $accessory->getArticleNumbersPlain()) && ($articleCount = sizeof($accessory->getArticleNumbers()))) {
                        if ($articleCount > 1) {
                            for ($i = 0; $i < $articleCount; $i++) {
                                if (preg_match("/{$this->request->getArgument('part')}/im", $accessory->getArticleNumbers()[ $i ])) {
                                    $this->request->setArgument('part', new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part($accessory, $i, $pseudoPartGroup, $this->feSession->get('config') ?: []));
                                    break 2;
                                }
                            }
                        } else {
                            $this->request->setArgument('part', new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part($accessory, 0, $pseudoPartGroup, $this->feSession->get('config') ?: []));
                            break;
                        }
                    }
                }
            }
        }
    }

    /**
     * action updatePart
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part|null $part
     * @param bool                                                 $unset
     *
     * @return void
     */
    public function updatePartAction(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part = null, $unset = false)
    {
        $configuration = $this->feSession->get('config') ?: [];
        // Manage Session data
        /** Add part */
        if ($unset === false) {
            \S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::addPartToConfiguration($this, $part, $configuration);
            /** Remove part */
        } else {
            \S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::removePartFromConfiguration($this, $part, $configuration);
        }

        $partGroup = $part->getPartGroup();
        $arguments = $partGroup->isMultipleSelectable() ? [$partGroup] : [];
        $data = parent::getIndexActionData($arguments);
        $data[ 'part' ] = $part;
        $data[ 'multiple' ] = $partGroup->isMultipleSelectable();

        $this->view->assign('value', $data);
    }

    /**
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentNameException
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
     */
    public function initializeShowHintAction()
    {
        if ($this->request->hasArgument('part') && MathUtility::canBeInterpretedAsInteger($this->request->getArgument('part')) && !$this->request->getArgument('part') instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Part) {
            $this->request->setArgument('part', $this->partRepository->findByUid($this->request->getArgument('part')));
        }
    }

    /**
     * action updatePart
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part|null $part
     *
     * @return void
     */
    public function showHintAction(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part = null)
    {
        $this->view->assign('value', [$this->sanitize_output($part->getHint())]);
    }


    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $parts
     *
     * @return string
     */
    public function getPartSelectorHTML(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $parts)
    {
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
        $view = $this->objectManager->get(\TYPO3\CMS\Fluid\View\StandaloneView::class);

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration[ 'view' ][ 'partialRootPath' ] ?: end($extbaseFrameworkConfiguration[ 'view' ][ 'partialRootPaths' ]));
        $templatePathAndFilename = "{$partialRootPath}Part/Selector.html";
        $view->setTemplatePathAndFilename($templatePathAndFilename);
        $view->setPartialRootPaths([$partialRootPath]);
        $view->assignMultiple([
            'parts'          => $parts,
            'pricingEnabled' => $this->pricing
        ]);
        $view->setFormat('html');

        return $this->sanitize_output($view->render());
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup> $partGroups
     *
     * @return string
     */
    public function getPartGroupSelectorHTML(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $partGroups)
    {
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
        $view = $this->objectManager->get(\TYPO3\CMS\Fluid\View\StandaloneView::class);

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration[ 'view' ][ 'partialRootPath' ] ?: end($extbaseFrameworkConfiguration[ 'view' ][ 'partialRootPaths' ]));
        $templatePathAndFilename = "{$partialRootPath}PartGroup/Selector.html";
        $view->setTemplatePathAndFilename($templatePathAndFilename);
        $view->setPartialRootPaths([$partialRootPath]);
        $view->assign('partGroups', $partGroups);
        $view->setFormat('html');

        return $this->sanitize_output($view->render());
    }

}
