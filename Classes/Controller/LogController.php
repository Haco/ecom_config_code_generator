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

/*		$data = $this->getIndexActionData();
		$formData = GeneralUtility::_POST();
		if ( $this->settings['mail']['senderEmail'] && GeneralUtility::validEmail($this->settings['mail']['senderEmail']) && $this->settings['mail']['senderName'] ) {
			$from = [ $this->settings['mail']['senderEmail'] => $this->settings['mail']['senderName'] ];
		} else {
			$from = \TYPO3\CMS\Core\Utility\MailUtility::getSystemFrom();
		}*/
		/** @var \TYPO3\CMS\Core\Mail\MailMessage $mail */
		$mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Mail\MailMessage::class);
		$mail->setContentType('text/html');

		/**
		 * Email to sender
		 */
/*		$mail->setFrom($from)
			->setTo([ $formData['email'] => "{$formData['first_name']} {$formData['last_name']}" ])
			->setSubject($this->settings['mail']['senderSubject'] ?: "Your {$data['title']} request")
			->setBody($this->getStandAloneTemplate('Email/ToSender', [
				'value' => $data,
				'formData' => $formData
			]))
			->send();*/

		/**
		 * Email to receiver
		 */
		/*		$mail->setFrom([ $formData['email'] => "{$formData['first_name']} {$formData['last_name']}" ])
					->setTo($from)
					->setSubject($this->settings['mail']['receiverSubject'] ?: "New {$data['title']} request")
					->setBody($this->getStandAloneTemplate('Email/ToReceiver', [
						'value' => $data,
						'formData' => $formData
					]))
					->send();*/

		#	\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::resetConfiguration($this);

		$this->redirect('confirmation');
	}

}