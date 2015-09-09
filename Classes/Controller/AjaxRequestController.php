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
use TYPO3\CMS\Core\Utility\MathUtility;

/**
 * Class AjaxRequestController
 * @package S3b0\EcomConfigCodeGenerator\Controller
 */
class AjaxRequestController extends \S3b0\EcomConfigCodeGenerator\Controller\GeneratorController {

	/**
	 * @var \TYPO3\CMS\Extbase\Mvc\View\JsonView $view
	 */
	protected $view;

	/**
	 * @var string
	 */
	protected $defaultViewObjectName = 'TYPO3\\CMS\\Extbase\\Mvc\\View\\JsonView';

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
	public function initializeAction() {
		global $TYPO3_CONF_VARS;
		/** !!! IMPORTANT TO MAKE JSON WORK !!! */
		$TYPO3_CONF_VARS['FE']['debug'] = '0';
		$this->contentObject = $this->contentRepository->findByUid($this->request->getArgument('cObj'));
		parent::initializeAction();
	}

	/**
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentNameException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 */
	public function initializeIndexAction() {
		if ( MathUtility::canBeInterpretedAsInteger($this->request->getArgument('partGroup')) && !$this->request->getArgument('partGroup') instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup )
			$this->request->setArgument('partGroup', $this->partGroupRepository->findByUid($this->request->getArgument('partGroup')));
	}

	/**
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\InvalidArgumentNameException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\NoSuchArgumentException
	 */
	public function initializeUpdatePartAction() {
		if ( MathUtility::canBeInterpretedAsInteger($this->request->getArgument('part')) && !$this->request->getArgument('part') instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Part )
			$this->request->setArgument('part', $this->partRepository->findByUid($this->request->getArgument('part')));
	}

	/**
	 * action updatePart
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part|NULL $part
	 * @param boolean                                              $unset
	 * @return void
	 */
	public function updatePartAction(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part = NULL, $unset = FALSE) {
		$configuration = $this->feSession->get('config');
		$temp = &$configuration[$part->getPartGroup()->getUid()];
		// Manage Session data
		/** Add part */
		if ( $unset === FALSE ) {
			if ( !$part->getPartGroup()->isMultipleSelectable() ) {
				$temp = [ ];
			}
			$temp[$part->getSorting()] = $part->getUid();
			$this->feSession->store('config', $configuration);
		/** Remove part */
		} else {
			if ( is_array($temp) ) {
				if( ( $key = array_search($part->getUid(), $temp) ) !== FALSE ) {
					unset($temp[$key]);
				}
			}
			if ( sizeof($temp) === 0 )
				unset($configuration[$part->getPartGroup()->getUid()]);
				$this->feSession->store('config', $configuration);
		}

		$data = parent::getIndexActionData();
		$data['part'] = $part;
		$data['multiple'] = $part->getPartGroup()->isMultipleSelectable();

		$this->view->assign('value', $data);
	}

	public function showHintAction() {

	}

	/**
	 * @param string $templateName template name (UpperCamelCase)
	 * @param array $variables variables to be passed to the Fluid view
	 *
	 * @return string
	 */
	private function getHTML($templateName, array $variables = []) {
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
		$view = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath'] ?: end($extbaseFrameworkConfiguration['view']['templateRootPaths']));
		$partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath'] ?: end($extbaseFrameworkConfiguration['view']['partialRootPaths']));
		$templatePathAndFilename = $templateRootPath . 'StandAloneViews/' . $templateName . '.html';
		$view->setTemplatePathAndFilename($templatePathAndFilename);
		$view->setPartialRootPaths([$partialRootPath]);
		$view->assignMultiple($variables);
		$view->setFormat('html');

		return $view->render();
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $parts
	 * @return string
	 */
	public function getSelectorHTML(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $parts) {
		/** @var \TYPO3\CMS\Fluid\View\StandaloneView $view */
		$view = $this->objectManager->get('TYPO3\\CMS\\Fluid\\View\\StandaloneView');

		$extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath'] ?: end($extbaseFrameworkConfiguration['view']['templateRootPaths']));
		$partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath'] ?: end($extbaseFrameworkConfiguration['view']['partialRootPaths']));
		$templatePathAndFilename = $partialRootPath . 'Part/AjaxSelector.html';
		$view->setTemplatePathAndFilename($templatePathAndFilename);
		$view->setPartialRootPaths([$partialRootPath]);
		$view->assign('parts', $parts);
		$view->setFormat('html');

		return $view->render();
	}

}
