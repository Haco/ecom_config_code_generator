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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * GeneratorController
 */
class GeneratorController extends \S3b0\EcomConfigCodeGenerator\Controller\InjectController {

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Content
	 */
	protected $contentObject = NULL;

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration
	 */
	protected $configuration = NULL;

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
		  // Fetch content object
		$this->contentObject = $this->contentObject ?: $this->contentRepository->findByUid($this->configurationManager->getContentObject()->data['uid']);
		if ( !$this->contentObject instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Content )
			$this->throwStatus(404, NULL, '<h1>' . LocalizationUtility::translate('404.noContentObject', $this->extensionName) . '</h1>' . LocalizationUtility::translate('404.message.noContentObject', $this->extensionName, [ "<a href=\"mailto:{$this->settings['webmasterEmail']}\">{$this->settings['webmasterEmail']}</a>" ]));
		  // Fetch configuration
		$this->configuration = $this->contentObject->getCcgConfiguration();
		if ( !$this->configuration instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration && !$this->configuration instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy )
			$this->throwStatus(404, NULL, '<h1>' . LocalizationUtility::translate('404.noConfiguration', $this->extensionName) . '</h1>' . LocalizationUtility::translate('404.message.noConfiguration', $this->extensionName, [ "<a href=\"mailto:{$this->settings['webmasterEmail']}\">{$this->settings['webmasterEmail']}</a>" ]));
		if ( !$this->configuration->getPartGroups()->count() )
			$this->throwStatus(404, NULL, '<h1>' . LocalizationUtility::translate('404.noPartGroups', $this->extensionName) . '</h1>' . LocalizationUtility::translate('404.message.noPartGroups', $this->extensionName, [ "<a href=\"mailto:{$this->settings['webmasterEmail']}\">{$this->settings['webmasterEmail']}</a>" ]));

		// Frontend-Session
		$this->feSession->setStorageKey(Setup::getSessionStorageKey($this->contentObject));
		  // On reset destroy config session data
		if ( $this->request->getControllerActionName() === 'reset' ) {
			$this->feSession->delete('config');
			$this->redirectToUri($this->uriBuilder->build());
		}
		  // Set currency, if any
		if ( GeneralUtility::_GET('currency') && !$this->feSession->get('currency') )
			$this->feSession->store('currency', GeneralUtility::_GET('currency'));
		  // Redirect to currency selection if pricing enabled
		if ( $this->configuration->isPricingEnabled() && $this->request->getControllerActionName() != 'currencySelect' && !$this->feSession->get('currency') )
			$this->forward('currencySelect');
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
	public function initializeView(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view) {
		$this->view->assign('contentObject', $this->contentObject);
		$this->view->assign('pricingEnabled', $this->configuration->isPricingEnabled());
		$this->view->assign('jsData', [
			'controller' => $this->request->getControllerName(),
			'pageId' => $GLOBALS['TSFE']->id,
			'contentObject' => $this->contentObject->_getProperty('_localizedUid'),
			'sysLanguage' => (int) $GLOBALS['TSFE']->sys_language_content
		]);
	}

	/**
	 * action index
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
	 * @return void
	 */
	public function indexAction(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup = NULL) {
		$this->view->assign('value', $this->getIndexActionData(func_get_args()));
	}

	/**
	 * @param array $arguments
	 * @return array
	 */
	public function getIndexActionData(array $arguments = [ ]) {
		// Get current configuration (Array: options=array(options)|packages=array(package => option(s)))
		$configuration = $this->feSession->get('config') ?: [ ];
		$partGroups = \S3b0\EcomConfigCodeGenerator\Controller\PartGroupController::initialize(
			$this,
			$this->contentObject->getCcgConfiguration()->getPartGroups() ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage(),
			$configuration,
			$currentPartGroup,
			$progress
		);
		if ( $arguments[0] instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ) {
			/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $currentPartGroup */
			$currentPartGroup = $arguments[0];
		}
		\S3b0\EcomConfigCodeGenerator\Controller\PartController::initialize(
			$this,
			$currentPartGroup->getParts(),
			$configuration
		);

		$configCodeHTML = '';
		$summaryTable = '';
		/** GET RESULT */
		if ( $progress === 1 ) {

		}

		return [
			'title' => $this->contentObject->getCcgConfiguration()->getTitle(),
			'configuration' => $configuration,
			'progress' => $progress,
			'progressPercentage' => $progress * 100,
			'partGroups' => $partGroups,
			'currentPartGroup' => $currentPartGroup,
			'selectPartsHTML' => method_exists($this, 'getSelectorHTML') && $currentPartGroup instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ? $this->getSelectorHTML($currentPartGroup->getParts()) : NULL
		];
	}

	/**
	 * action currencySelect
	 *
	 * @return void
	 */
	public function currencySelectAction() {
		$this->view->assign('currencies', $this->currencyRepository->findAll());
	}

	/**
	 * action request
	 *
	 * @return void
	 */
	public function requestAction() {

	}

	/**
	 * action reset
	 *
	 * @return void
	 */
	public function resetAction() {

	}

	/**
	 * action setPart
	 *
	 * @return void
	 */
	public function setPartAction() {

	}

}