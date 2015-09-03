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

use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * GeneratorController
 */
class GeneratorController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Content
	 */
	protected $contentObject = NULL;

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration
	 */
	protected $configuration = NULL;

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\ContentRepository
	 * @inject
	 */
	protected $contentRepository;

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

		// Frontend-Session
#		$this->getFeSession()->setStorageKey('ext-' . $this->request->getControllerExtensionKey());
#		\S3b0\Ecompc\Setup::setPriceHandling($this);
		// Add cObj-pid to configurationSessionStorageKey to make it unique in sessionStorage
#		$this->configurationSessionStorageKey .= $this->contentObject->getPid();
		// Get current configuration (Array: options=array(options)|packages=array(package => option(s)))
#		$this->selectedConfiguration = $this->getFeSession()->get($this->configurationSessionStorageKey) ?: [
#			'options' => [ ],
#			'packages' => [ ]
#		];
	}

	/**
	 * action index
	 *
	 * @return void
	 */
	public function indexAction() {

	}

	/**
	 * action currencySelect
	 *
	 * @return void
	 */
	public function currencySelectAction() {

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