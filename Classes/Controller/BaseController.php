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

use S3b0\EcomConfigCodeGenerator\Setup;
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class BaseController
 *
 * @package S3b0\EcomConfigCodeGenerator\Controller
 */
class BaseController extends \Ecom\EcomToolbox\Controller\ActionController
{

    /**
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Content
     */
    protected $contentObject = null;

    /**
     * feSession
     *
     * @var \Ecom\EcomToolbox\Domain\Session\FrontendSessionHandler
     * @inject
     */
    public $feSession;

    /**
     * contentRepository
     *
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\ContentRepository
     * @inject
     */
    protected $contentRepository;

    /**
     * partGroupRepository
     *
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\PartGroupRepository
     * @inject
     */
    protected $partGroupRepository;

    /**
     * partRepository
     *
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\PartRepository
     * @inject
     */
    protected $partRepository;

    /**
     * currencyRepository
     *
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\CurrencyRepository
     * @inject
     */
    protected $currencyRepository;

    /**
     * logRepository
     *
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\LogRepository
     * @inject
     */
    protected $logRepository;

    /**
     * frontendUserRepository
     *
     * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
     * @inject
     */
    protected $frontendUserRepository;

    /**
     * regionRepository
     *
     * @var \Ecom\EcomToolbox\Domain\Repository\RegionRepository
     * @inject
     */
    protected $regionRepository;

    /**
     * stateRepository
     *
     * @var \Ecom\EcomToolbox\Domain\Repository\StateRepository
     * @inject
     */
    protected $stateRepository;

    /**
     * productRepository
     *
     * @var \S3b0\EcomProductTools\Domain\Repository\ProductRepository
     * @inject
     */
    protected $productRepository;

    /**
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration
     */
    public $configuration = null;

    /**
     * @var bool Indicate if pricing is active or not
     */
    protected $pricing = false;

    /**
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency
     */
    protected $currency = null;

    /**
     * @var array
     */
    protected $page = [];

    /**
     * @var \S3b0\EcomProductTools\Domain\Model\Product|null
     */
    protected $product = null;

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
        // Fetch content object
        $this->contentObject = $this->contentObject ?: $this->contentRepository->findByUid($this->configurationManager->getContentObject()->data[ 'uid' ]);
        if (!$this->contentObject instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Content) {
            $this->throwStatus(404, null, '<h1>' . LocalizationUtility::translate('404.noContentObject', $this->extensionName) . '</h1>' . LocalizationUtility::translate('404.message.noContentObject', $this->extensionName, ["<a href=\"mailto:{$this->settings['webmasterEmail']}\">{$this->settings['webmasterEmail']}</a>"]));
        }
        // Fetch configuration
        $this->configuration = $this->contentObject->getCcgConfiguration();
        if (!$this->configuration instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration && !$this->configuration instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy) {
            $this->throwStatus(404, null, '<h1>' . LocalizationUtility::translate('404.noConfiguration', $this->extensionName) . '</h1>' . LocalizationUtility::translate('404.message.noConfiguration', $this->extensionName, ["<a href=\"mailto:{$this->settings['webmasterEmail']}\">{$this->settings['webmasterEmail']}</a>"]));
        }
        if (!$this->configuration->getPartGroups()->count()) {
            $this->throwStatus(404, null, '<h1>' . LocalizationUtility::translate('404.noPartGroups', $this->extensionName) . '</h1>' . LocalizationUtility::translate('404.message.noPartGroups', $this->extensionName, ["<a href=\"mailto:{$this->settings['webmasterEmail']}\">{$this->settings['webmasterEmail']}</a>"]));
        }

        $this->pricing = $this->configuration->isPricingEnabled() && $GLOBALS[ 'TSFE' ]->loginUser && \Ecom\EcomToolbox\Security\Frontend::checkForUserRoles($this->settings[ 'accessPricing' ]);

        // Frontend-Session
        $this->feSession->setStorageKey(Setup::getSessionStorageKey($this->contentObject));
        // On reset destroy config session data
        if ($this->request->getControllerName() === 'Generator' && $this->request->getControllerActionName() === 'reset') {
            $this->feSession->delete('config');
            $this->redirect('index', 'Generator');
        }
        // Redirect to currency selection if pricing enabled
        if (
            $this->pricing &&
            $this->request->getControllerName() !== 'AjaxRequest' &&
            !in_array(
                $this->request->getControllerActionName(),
                [
                    'currencySelect',
                    'setCurrency'
                ]
            ) &&
            !$this->feSession->get('currency', 'ecom')
        ) {
            $this->redirect('currencySelect', 'Generator');
        }
        if ($this->pricing && $this->feSession->get('currency', 'ecom') && MathUtility::canBeInterpretedAsInteger($this->feSession->get('currency', 'ecom'))) {
            $this->currency = $this->currencyRepository->findByUid($this->feSession->get('currency', 'ecom'));
        } else {
            $this->currency = $this->currencyRepository->getDefault($this->settings);
        }
        $this->contentObject->getCcgConfiguration()->setCurrencyPricing($this->currency, $this->settings);
    }

    /**
     * Initializes the view before invoking an action method.
     *
     * Override this method to solve assign variables common for all actions
     * or prepare the view in another way before the action is called.
     *
     * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view The view to be initialized
     *
     * @return void
     * @api
     */
    public function initializeView(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view)
    {
        $this->view->assignMultiple([
            'contentObject'  => $this->contentObject,
            'pricingEnabled' => $this->pricing,
            'jsData'         => [
                'pageId'        => $GLOBALS[ 'TSFE' ]->id,
                'controller'    => $this->request->getControllerName(),
                'sysLanguage'   => (int)$GLOBALS[ 'TSFE' ]->sys_language_content,
                'contentObject' => $this->contentObject->_getProperty('_localizedUid')
            ]
        ]);
        if ($this->pricing) {
            $this->view->assignMultiple([
                'currencyActive' => $this->currency,
                'currencies'     => $this->currencyRepository->findAll()
            ]);
        }
    }

    /**
     * Initialize part groups
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage         $partGroups
     * @param array                                                $configuration
     * @param bool                                                 $enableDetach Enables detaching objects (DB issue)
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $current
     * @param int                                                  $progress
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    protected function initializePartGroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $partGroups, &$configuration, $enableDetach = true, \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup &$current = null, &$progress = 0)
    {
        /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $current */
        $current = null;   // Current part group
        $previous = null;  // Previous part group (NEXT as of array_reverse)
        $cycle = 1;        // Count loop cycles
        $locked = 0;       // Count locked items, still visible!

        /** @var array $configuredParts Create an array containing all configured part for validation */
        $configuredParts = [];
        if (sizeof($configuration)) {
            foreach ($configuration as $partGroupParts) {
                $configuredParts = array_merge($configuredParts, (array)$partGroupParts);
            }
        }

        /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
        foreach (array_reverse($partGroups->toArray()) as $partGroup) {
            $partGroup->reset();
            /**
             * Handle locked part groups
             * They might have a default part set (mostly used as code placeholder)
             * If any, add them to configuration. Keep them as long as they are set visible.
             * No further processing necessary, so continue!
             */
            if ($partGroup->isLocked()) {
                if ($partGroup->hasDefaultPart()) {
                    $partGroup->setSelectable(false);
                    \S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::addPartToConfiguration(
                        $this,
                        $partGroup->getDefaultPart(),
                        $configuration
                    );
                    $locked++;
                    $cycle++;
                } elseif (!array_key_exists($partGroup->getUid(), $configuration) && $enableDetach) {
                    $partGroups->detach($partGroup);
                }
                continue;
            }
            /**
             * Add dependent notes, if any.
             * Dependent notes may appear if a trigger part has been added to configuration.
             * Just like Modals, but displayed inline.
             */
            if ($partGroup->getDependentNotes() instanceof \Countable && $partGroup->getDependentNotes()->count()) {
                /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote $dependentNote */
                foreach ($partGroup->getDependentNotes() as $dependentNote) {
                    if ($dependentNote->getDependentParts()->count()) {
                        $logicalAnd = $dependentNote->isUseLogicalAnd();
                        $addMessage = false;
                        /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $dependentPart */
                        foreach ($dependentNote->getDependentParts() as $dependentPart) {
                            if (is_array($configuredParts) && in_array($dependentPart->getUid(), $configuredParts)) {
                                $addMessage = true;
                                if (!$logicalAnd) {
                                    break;
                                }
                            } else {
                                if ($logicalAnd) {
                                    $addMessage = false;
                                    break;
                                }
                            }
                        }
                        if ($addMessage) {
                            $partGroup->addDependentNotesFluidParsedMessage($dependentNote->getNote());
                        }
                    }
                }
            }
            /**
             * Set modal triggers, if any
             */
            if ($partGroup->hasModals()) {
                /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Modal $modal */
                foreach ($partGroup->getModals() as $modal) {
                    /** Dependency check */
                    if ($modal->hasDependentParts()) {
                        self::checkForModalDependencies($modal, $configuredParts);
                    }
                }
            }
            /**
             * Check for active packages, set corresponding sate and fill ObjectStorage
             */
            if (array_key_exists($partGroup->getUid(), $configuration) && is_array($configuration[ $partGroup->getUid() ])) {
                // First of all check dependencies and unset parts, if not valid anymore
                foreach ($configuration[ $partGroup->getUid() ] as $partUid) {
                    /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
                    if ($part = $this->partRepository->findByUid($partUid)) {
                        if (self::checkForPartDependencies($this, $part, $configuration)) {
                            \S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::addPartToConfiguration($this, $part, $configuration);
                        } else {
                            \S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::removePartFromConfiguration($this, $part, $configuration);
                        }
                    }
                }
            }
            $originallyAvailablePartsAmount = $partGroup->getParts()->count();
            $this->initializeParts(
                $partGroup->getParts(),
                $configuration,
                $enableDetach
            );
            /**
             * Reset part if availability has been affected by dependencies
             */
            if ($partGroup->getParts()->count() !== $originallyAvailablePartsAmount && $partGroup->getParts()
                    ->count() === 1
            ) {
                $partGroup->setSelectable(false);
                \S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::removePartGroupFromConfiguration($this, $partGroup, $configuration);
                \S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::addPartToConfiguration($this, $partGroup->getParts()->toArray()[ 0 ], $configuration);
            }
            $partGroup->setUnlocked($partGroup->getParts()->count() > 1);
            $partGroup->setNext($previous);
            /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $previous */
            $previous = $partGroup;
            $cycle++;
        }

        if ($this->checkIfAccessoryPartGroupMustBeAdded()) {
            $this->addAccessoryPartGroup($configuration, $partGroups);
        }

        $cycle = 0;
        foreach ($partGroups as $partGroup) {
            $partGroup->setStepIndicator($partGroup->isVisibleInNavigation() ? ++$cycle : 0);
            /** SET PRICE */
            $partGroup->setPartsCurrencyPricing($this->currency, $this->settings);
            $this->contentObject->getCcgConfiguration()->summateConfigurationPricing($partGroup);
            $this->correctNextPartGroupIfItHasBeenAffectedByAutoSetPartsOrSimilar($partGroup);
            if ((
                    !array_key_exists($partGroup->getUid(), $configuration) &&
                    !is_array($configuration[ $partGroup->getUid() ]) &&
                    !$current instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup
                ) || (
                    $this->request->hasArgument('partGroup') &&
                    $this->request->getArgument('partGroup') instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup &&
                    $this->request->getArgument('partGroup')->getUid() === $partGroup->getUid()
                )) {
                $current = $partGroup;
                $partGroup->setCurrent(true);
            }
        }
        $partGroup->setLast(true);
        $this->feSession->store('config', $configuration);

        // Get progress state update (ratio of active to visible packages) => float from 0 to 1 (*100 = %)
        $progress = (sizeof($configuration) - $locked) / ($partGroups->count() - $locked);

        return $partGroups;
    }

    /**
     * Traverse setting correct 'next' item, skipping locked
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
     */
    private function correctNextPartGroupIfItHasBeenAffectedByAutoSetPartsOrSimilar(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup = null, $traverse = 0)
    {
        $next = $partGroup->getNext();
        if ($traverse > 0) {
            for ($i = 0; $i < $traverse; $i++) {
                if ($next instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup) {
                    $next = $next->getNext();
                } else {
                    $next = null;
                    continue;
                }
            }
        }
        if ($next instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup) {
            if ($next->isUnlocked()) {
                $partGroup->setNext($next);
            } elseif ($next->getNext() instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup) {
                $this->correctNextPartGroupIfItHasBeenAffectedByAutoSetPartsOrSimilar($partGroup, ++$traverse);
            }
        } else {
            $partGroup->setNext(null);
        }
    }

    /**
     * @param \S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller Ensure an Instance of extensions
     *                                                                            BaseController is given to provide
     *                                                                            necessary injections
     * @param array                                                   $list
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    protected static function getAndSetActivePartsForPartGroup(\S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller, array $list)
    {
        $objectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        if ($parts = $controller->partRepository->findByList($list)) {
            /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
            foreach ($parts as $part) {
                $part->setActive(true);
                $objectStorage->attach($part);
            }
        }

        return $objectStorage;
    }

    /**
     * Initialize parts
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $parts
     * @param array                                        $configuration
     * @param bool                                         $enableDetach Enables detaching objects (DB issue)
     *
     * @return void
     */
    public function initializeParts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage &$parts, array $configuration, $enableDetach = true)
    {
        $partsToBeRemoved = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
        foreach ($parts as $part) {
            /** HANDLE DEPENDENCIES */
            if (self::checkForPartDependencies($this, $part, $configuration) === false) {
                $partsToBeRemoved->attach($part);
            }
        }

        if ($enableDetach) {
            $parts->removeAll($partsToBeRemoved);
        }
    }

    /**
     * @param \S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller    Ensure an Instance of extensions
     *                                                                               BaseController is given to provide
     *                                                                               necessary injections
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part         $part
     * @param array                                                   $configuration
     *
     * @return bool                                                   Returns FALSE if dependency check failed
     */
    protected static function checkForPartDependencies(\S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller, \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part, array $configuration)
    {
        $check = true;
        if (!$part->getDependency() instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency) {
            return $check;
        }

        /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency $dependency */
        $dependency = $part->getDependency();
        /** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage $partGroups */
        $partGroups = $dependency->getPartGroups();
        if ($partGroups instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $partGroups->count()) {
            $dependencyCheck = [];
            /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
            foreach ($partGroups as $partGroup) {
                $partGroupCheck = [];
                // If part group has no part selected or dependency has no parts selected for current group
                if (!array_key_exists($partGroup->getUid(), $configuration) || $dependency->getPartsByPartGroup($partGroup)->count() === 0) {
                    continue;
                }
                // Fetch selected parts for comparison
                $selectedParts = $controller->partRepository->findByList($configuration[ $partGroup->getUid() ]);
                // Start actual dependency check
                if ($selectedParts instanceof \Countable && $selectedParts->count()) {
                    // Loop selected parts; fill $partGroupCheck array
                    /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $selectedPart */
                    foreach ($selectedParts as $selectedPart) {
                        $partGroupCheck[] = $dependency->getPartsByPartGroup($partGroup)->contains($selectedPart);
                    }
                }
                $dependencyCheck[] = in_array(true, $partGroupCheck);
            }
            if (sizeof($dependencyCheck) === $partGroups->count()) {
                /** @mode -> 0: explicit deny | 1: explicit allow */
                $check = $dependency->getMode() === 1 ? !in_array(false, $dependencyCheck) : in_array(false, $dependencyCheck);
            }
        }

        return $check;
    }

    /**
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Modal $modal
     * @param array                                            $configuredParts
     */
    protected static function checkForModalDependencies(\S3b0\EcomConfigCodeGenerator\Domain\Model\Modal $modal, array $configuredParts)
    {
        if (sizeof($configuredParts)) {
            /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
            foreach ($modal->getDependentParts() as $part) {
                if (in_array($part->getUid(), $configuredParts)) {
                    $modal->getTriggerPart()->setModalTrigger($modal->getUid());
                    break;
                }
            }
        }
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $storage
     * @param array $configuration
     *
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    protected function automaticallySetPartIfNoAlternativeExists(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $storage = null, array $configuration)
    {
        /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
        $part = $storage->toArray()[ 0 ];
        if ($storage instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $storage->count() === 1) {
            \S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::removePartGroupFromConfiguration($this, $part->getPartGroup(), $configuration);
            \S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::addPartToConfiguration($this, $part, $configuration);

            $arguments = $this->request->getArguments();
            ArrayUtility::mergeRecursiveWithOverrule($arguments, ['partGroup' => $part->getPartGroup()->getNext()]);
            $this->forward('index', null, null, $arguments);
        }
    }

    /**
     * @param array $configuration
     *
     * @return array
     */
    protected function getConfigurationCode(array $configuration)
    {
        $summaryTableRows     = [];
        $summaryTableMailRows = [];
        $code                 = [];
        $blankCode            = [];
        $addedAccessory       = false;
        if (sizeof($configuration)) {
            /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
            foreach ($this->contentObject->getCcgConfiguration()->getPartGroups() as $partGroup) {
                $parts = $configuration[ $partGroup->getUid() ];
                ksort($parts); // Order by sorting
                $segment = '';
                $partList = [];
                // Handle Accessory
                if ($partGroup->getUid() === -1) {
                    $data = self::getConfigurationCodeDataForAccessoryPartGroup($parts, $partGroup);
                    $summaryTableRows[] = $data[0];
                    $summaryTableMailRows[] = $data[1];
                    $addedAccessory = true;
                } else {
                    foreach ($parts as $partUid) {
                        /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
                        $part = $this->partRepository->findByUid($partUid);
                        $partList[] = trim(($part->getTitle() !== "-" ? $part->getTitle() : "") . (strlen($part->getCodeSegment()) ? " [{$part->getCodeSegment()}]" : ""));
                        $segment .= $part->getCodeSegment();
                    }
                    if ($partGroup->getPlaceInCode()) {
                        $code[ $partGroup->getPlaceInCode() ] = "<span class=\"syntax-help\" title=\"{$partGroup->getTitle()}\">{$segment}</span>";
                        $blankCode[ $partGroup->getPlaceInCode() ] = $segment;
                    } else {
                        $code[] = "<span class=\"syntax-help\" title=\"{$partGroup->getTitle()}\">{$segment}</span>";
                        $blankCode[] = $segment;
                    }
                    if ($partGroup->isVisibleInSummary()) {
                        $summaryTableRows[] = ("
                            <td>{$partGroup->getStepIndicator()}</td>
                            <td>{$partGroup->getTitle()}</td>
                            <td>" . implode(', ', $partList) . "</td>
                            <td>" . ($partGroup->isSelectable() ? "<a data-part-group=\"{$partGroup->getUid()}\" class=\"generator-part-group-select\"><i class=\"fa fa-edit\"></i></a>" : "") . "</td>
                        ") . ($this->pricing ? "<td style=\"text-align:right\">{$partGroup->getPricing()}</td>" : "");
                        $summaryTableMailRows[] = ("
                            <td>{$partGroup->getTitle()}</td>
                            <td>" . implode(', ', $partList) . "</td>
                        ");
                    }
                }
            }
            ksort($code);      // Order code either incremental or by place in code
            ksort($blankCode); // Order code either incremental or by place in code
        }

        /** Handle Accessory (especially for Log Controller!) */
        if ($addedAccessory === false) {
            if ($this->checkIfAccessoryPartGroupMustBeAdded()) {
                $parts = $configuration[ -1 ];
                $step = isset($partGroup) && $partGroup instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ? $partGroup->getStepIndicator() : 0;
                $partGroup = $this->addAccessoryPartGroup($configuration, null, ++$step, true);
                $data = self::getConfigurationCodeDataForAccessoryPartGroup($parts, $partGroup);
                $summaryTableRows[] = $data[0];
                $summaryTableMailRows[] = $data[1];
            }
        }

        return [
            'title'            => $this->contentObject->getCcgConfiguration()->getTitle(),
            'code'             => $this->contentObject->getCcgConfiguration()->getPrefix() . implode('', $code) . $this->contentObject->getCcgConfiguration()->getSuffix(),
            'blankCode'        => $this->contentObject->getCcgConfiguration()->getPrefix() . implode('', $blankCode) . $this->contentObject->getCcgConfiguration()->getSuffix(),
            'summaryTable'     => $this->sanitize_output('<table><tr>' . implode('</tr><tr>', $summaryTableRows) . '</tr></table>'),
            'summaryTableMail' => $this->sanitize_output('<table><tr>' . implode('</tr><tr>', $summaryTableMailRows) . '</tr></table>')
        ];
    }

    /**
     * @param array                                                $parts
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
     *
     * @return array
     */
    private static function getConfigurationCodeDataForAccessoryPartGroup(array $parts, \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup)
    {
        $partList = [];
        foreach ($parts as $ps => $sku) {
            if (intval($ps) === -1 && strlen($sku) === 0) {
                $partList = [ LocalizationUtility::translate('part.none', Setup::EXT_KEY) ];
                break;
            }
            $part = $partGroup->getPartBySku($sku);
            $partList[] = "{$part->getTitle()} [{$part->getCodeSegment()}]";
        }
        $summaryTableRow = ("
                        <td>{$partGroup->getStepIndicator()}</td>
                        <td>{$partGroup->getTitle()}</td>
                        <td>" . implode('<br />', $partList) . "</td>
                        <td><a data-part-group=\"{$partGroup->getUid()}\" class=\"generator-part-group-select\"><i class=\"fa fa-edit\"></i></a></td>
                    ");
        $summaryTableMailRow = ("
                        <td>{$partGroup->getTitle()}</td>
                        <td>" . implode(', ', $partList) . "</td>
                    ");

        return [ $summaryTableRow, $summaryTableMailRow ];
    }

    /**
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Log $log
     * @param array                                          $configuration
     */
    protected function addConfigurationToLog(\S3b0\EcomConfigCodeGenerator\Domain\Model\Log &$log, array $configuration)
    {
        $ipLength = !MathUtility::canBeInterpretedAsInteger($this->settings[ 'log' ][ 'ipLength' ]) || $this->settings[ 'log' ][ 'ipLength' ] > 4 ? 4 : $this->settings[ 'log' ][ 'ipLength' ];
        $code = [];

        self::initializePartGroups($this->partGroupRepository->findByConfiguration($this->contentObject->getCcgConfiguration()), $configuration, false);

        $currentConfiguration = $this->contentObject->getCcgConfiguration();
        /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
        foreach ($currentConfiguration->getPartGroups() as $partGroup) {
            $parts = $configuration[ $partGroup->getUid() ];
            ksort($parts); // Order by sorting
            $segment = '';
            foreach ($parts as $partUid) {
                /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
                $part = $this->partRepository->findByUid($partUid);
                $log->addConfiguredPart($part);
                $segment .= $part->getCodeSegment();
            }
            if ($partGroup->getPlaceInCode()) {
                $code[ $partGroup->getPlaceInCode() ] = $segment;
            } else {
                $code[] = $segment;
            }
        }
        if (is_array($configuration[ -1 ])) {
            $log->setAccessories(implode(', ', $configuration[ -1 ]));
        }
        ksort($code);

        /** Set minimum quantity */
        if ($log->getQuantity() === 0) {
            $log->setQuantity(1);
        }
        $currentConfiguration->setConfigurationPricingNumeric($currentConfiguration->getConfigurationPricingNumeric() * ($log->getQuantity() ?: 1));
        $log->setSessionId($GLOBALS[ 'TSFE' ]->fe_user->id)
            ->setConfiguration($currentConfiguration->getPrefix() . implode('', $code) . $this->contentObject->getCcgConfiguration()->getSuffix())
            ->maskIpAddress($ipLength)
            ->setPricing($currentConfiguration->getConfigurationPricing())
            ->setPid(0);
        if ($GLOBALS[ 'TSFE' ]->loginUser) {
            /** @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser */
            $feUser = $this->frontendUserRepository->findByUid($GLOBALS[ 'TSFE' ]->fe_user->user[ 'uid' ]);
            $log->setFeUser($feUser);
        }
    }

    /**
     * @return boolean
     */
    protected function checkIfAccessoryPartGroupMustBeAdded()
    {
        if ($this->product instanceof \S3b0\EcomProductTools\Domain\Model\Product) {
            return $this->product->hasAccessories();
        }
        $this->page = $this->getDatabaseConnection()->exec_SELECTgetSingleRow('tx_product', 'pages', "uid={$this->contentObject->getPid()}");
        if (MathUtility::canBeInterpretedAsInteger($this->page['tx_product']) && $this->page['tx_product']) {
            $this->product = $this->productRepository->findByUid($this->page['tx_product']);
            if ($this->product instanceof \S3b0\EcomProductTools\Domain\Model\Product) {
                return $this->product->hasAccessories();
            }
        }

        return false;
    }

    /**
     * @param array                                             $configuration
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage|null $storage
     * @param integer                                           $stepIndicator
     *
     * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup|integer
     */
    protected function addAccessoryPartGroup(array $configuration, \TYPO3\CMS\Extbase\Persistence\ObjectStorage $storage = null, $stepIndicator = 0, $returnPartGroup = false)
    {
        $pseudoPartGroup = new \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup(1, $this->configuration);
        if ($stepIndicator) {
            $pseudoPartGroup->setStepIndicator($stepIndicator);
        }
        $pseudoPartGroup->addPart(new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part(null, 0, $pseudoPartGroup, $configuration));
        /** @var \S3b0\EcomProductTools\Domain\Model\Accessory $accessory */
        foreach ($this->product->getAccessories() as $accessory) {
            if ($articleCount = sizeof($accessory->getArticleNumbers())) {
                if ($articleCount > 1) {
                    for ($i = 0; $i < $articleCount; $i++) {
                        $pseudoPartGroup->addPart(new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part($accessory, $i, $pseudoPartGroup, $configuration));
                    }
                } else {
                    $pseudoPartGroup->addPart(new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part($accessory, 0, $pseudoPartGroup, $configuration));
                }
            }
        }
        if ($storage instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage) {
            $storage->attach($pseudoPartGroup);
        }

        return $returnPartGroup ? $pseudoPartGroup : 1;
    }

    /**
     * @param string $templateName template name (UpperCamelCase)
     * @param array  $variables    variables to be passed to the Fluid view
     *
     * @return string
     */
    protected function getStandAloneTemplate($templateName, array $variables = [])
    {
        /** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
        $view = $this->objectManager->get(\TYPO3\CMS\Fluid\View\StandaloneView::class);

        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration[ 'view' ][ 'templateRootPath' ] ?: end($extbaseFrameworkConfiguration[ 'view' ][ 'templateRootPaths' ]));
        $partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration[ 'view' ][ 'partialRootPath' ] ?: end($extbaseFrameworkConfiguration[ 'view' ][ 'partialRootPaths' ]));
        $templatePathAndFilename = "{$templateRootPath}{$templateName}.html";
        $view->setTemplatePathAndFilename($templatePathAndFilename);
        $view->setPartialRootPaths([$partialRootPath]);
        $view->assignMultiple($variables);
        $view->setFormat('html');

        return $this->sanitize_output($view->render());
    }

    /**
     * Minify All Output - based on the search and replace regexes.
     *
     * @param string $buffer Input string
     *
     * @return string
     */
    protected function sanitize_output($buffer)
    {
        $search = [
            '/\>[^\S ]+/s', //strip whitespaces after tags, except space
            '/[^\S ]+\</s', //strip whitespaces before tags, except space
            '/(\s)+/s'  // shorten multiple whitespace sequences
        ];
        $replace = [
            '>',
            '<',
            '\\1'
        ];
        $buffer = preg_replace($search, $replace, $buffer);

        return $buffer;
    }

}