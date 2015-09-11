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

/**
 * GeneratorController
 */
class GeneratorController extends \S3b0\EcomConfigCodeGenerator\Controller\BaseController {

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
		$checkIfPartGroupArgumentIsSet = $arguments[0] instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup;
		// Get current configuration (Array: options=array(options)|packages=array(package => option(s)))
		$configuration = $this->feSession->get('config') ?: [ ];
		$partGroups = $this->initializePartGroups(
			$this->contentObject->getCcgConfiguration()->getPartGroups() ?: new \TYPO3\CMS\Extbase\Persistence\ObjectStorage(),
			$configuration,
			$currentPartGroup,
			$progress
		);
		if ( $arguments[0] instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ) {
			/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $currentPartGroup */
			$currentPartGroup = $arguments[0];
		}
		if ( $currentPartGroup instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ) {
			$currentPartGroup->setCurrent(TRUE);
			$this->initializeParts(
				$currentPartGroup->getParts(),
				$configuration
			);
			$this->automaticallySetPartIfNoAlternativeExists($currentPartGroup->getParts());
		}

		$jsonData = [
			'title' => $this->contentObject->getCcgConfiguration()->getTitle(),
			'instructions' => $this->contentObject->getBodytext(),
			'configuration' => $configuration,
			'progress' => $progress,
			'progressPercentage' => $progress * 100,
			'partGroups' => $partGroups,
			'currentPartGroup' => $currentPartGroup,
			'showResultingConfiguration' => $progress === 1 && !$checkIfPartGroupArgumentIsSet
		];

		/** GET RESULT */
		if ( $progress === 1 && is_array($configuration) ) {
			$jsonData['configurationCode'] = $this->getConfigurationCode($configuration);
		}

		if ( $this->request->getControllerName() === 'AjaxRequest' ) {
			$jsonData['selectPartsHTML'] = $currentPartGroup instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ? $this->getPartSelectorHTML($currentPartGroup->getParts()) : NULL;
			$jsonData['selectPartGroupsHTML'] = $this->getPartGroupSelectorHTML($partGroups);
		}

		return $jsonData;
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
		$configuration = $this->feSession->get('config') ?: [ ];
		if ( sizeof($configuration) ) {
			$this->addConfigurationLog($configuration);
		}
/*		$additionalParams = sprintf($this->settings['requestForm']['additionalParamsQueryString'], $configurationCode, $data[0], $log->getUid());

		// Build link & redirect
		$arguments = \TYPO3\CMS\Core\Utility\GeneralUtility::explodeUrl2Array($additionalParams);
		$this->redirectToUri(
			$this->uriBuilder
				->setTargetPageUid((int) $this->settings['requestForm']['pid'])
				->setArguments([
					'L' => $GLOBALS['TSFE']->sys_language_content,
					$arguments
				])
				->setUseCacheHash(FALSE)
				->setCreateAbsoluteUri(TRUE)
				->build()
		);*/
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