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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * LogController
 */
class LogController extends \S3b0\EcomConfigCodeGenerator\Controller\GeneratorController {

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\LogRepository
	 * @inject
	 */
	protected $logRepository;

	/**
	 * action confirmation
	 *
	 * @return void
	 */
	public function confirmationAction() { }

	/**
	 * action new
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Log $newLog
	 * @ignorevalidation $newLog
	 * @return void
	 */
	public function newAction(\S3b0\EcomConfigCodeGenerator\Domain\Model\Log $newLog = NULL) {
		$data = $this->getIndexActionData();

		if ( $data['progress'] < 1 ) {
			$this->redirect('index');
		}
		$this->view->assignMultiple([
			'newLog' => $newLog,
			'countryList' => $this->regionRepository->findByType(0),
			'stateList' => $this->stateRepository->findAll()
		]);
	}

	/**
	 * action initializeCreate
	 */
	protected function initializeCreateAction(){
		$propertyMappingConfiguration = $this->arguments['newLog']->getPropertyMappingConfiguration();
		$propertyMappingConfiguration->allowProperties('country');
		$propertyMappingConfiguration->allowProperties('state');
	}

	/**
	 * action create
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Log $newLog
	 * @return void
	 */
	public function createAction(\S3b0\EcomConfigCodeGenerator\Domain\Model\Log $newLog) {
		/** EMail stuff */
		$configuration = $this->feSession->get('config') ?: [ ];
		if ( sizeof($configuration) ) {
			$this->addConfigurationToLog($newLog, $configuration);
		}

		$this->createRecord($newLog);

		$data = $this->getConfigurationCode($configuration);
		if ( $this->settings['mail']['senderEmail'] && GeneralUtility::validEmail($this->settings['mail']['senderEmail']) && $this->settings['mail']['senderName'] ) {
			$from = [ $this->settings['mail']['senderEmail'] => $this->settings['mail']['senderName'] ];
		} else {
			$from = \TYPO3\CMS\Core\Utility\MailUtility::getSystemFrom();
		}
		/** @var \TYPO3\CMS\Core\Mail\MailMessage $mailToSender */
		$mailToSender = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
		$mailToSender->setContentType('text/html');

		/**
		 * Email to sender
		 */
		$mailToSender->setFrom($from)
			->setTo([ $newLog->getEmail() => "{$newLog->getFirstName()} {$newLog->getLastName()}" ])
			->setSubject($this->settings['mail']['senderSubject'] ?: LocalizationUtility::translate('mail.toSender.subject', $this->extensionName, [ $data['title'] ]))
			->setBody($this->getStandAloneTemplate('Email/ToSender', [
				'configurationCode' => $data,
				'log' => $newLog
			]))
			->send();

		/** @var \TYPO3\CMS\Core\Mail\MailMessage $mailToReceiver */
		$mailToReceiver = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
		$mailToReceiver->setContentType('text/html');

		/**
		 * Email to receiver
		 */
		$mailToReceiver->setFrom([ $newLog->getEmail() => "{$newLog->getFirstName()} {$newLog->getLastName()}" ])
			->setTo($from)
			->setSubject($this->settings['mail']['receiverSubject'] ?: LocalizationUtility::translate('mail.toReceiver.subject', $this->extensionName, [ $data['title'] ]))
			->setBody($this->getStandAloneTemplate('Email/ToReceiver', [
				'configurationCode' => $data,
				'log' => $newLog
			]))
			->send();

		\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::resetConfiguration($this);

		$this->redirect('confirmation');
	}

}