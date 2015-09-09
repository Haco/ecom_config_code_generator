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
 * PartController
 */
class PartController extends \S3b0\EcomConfigCodeGenerator\Controller\InjectController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$parts = $this->partRepository->findAll();
		$this->view->assign('parts', $parts);
	}

	/**
	 * action show
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part
	 * @return void
	 */
	public function showAction(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part) {
		$this->view->assign('part', $part);
	}

	/**
	 * Initialize part groups
	 *
	 * @param \TYPO3\CMS\Extbase\Mvc\Controller\ActionController $controller
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage       $parts
	 * @param array                                              $configuration
	 * @return void
	 */
	public static function initialize(\TYPO3\CMS\Extbase\Mvc\Controller\ActionController $controller, \TYPO3\CMS\Extbase\Persistence\ObjectStorage &$parts, array $configuration) {
		/** @var \S3b0\EcomConfigCodeGenerator\Controller\InjectController $controller */
		$partsToBeRemoved = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
		foreach ( $parts as $part ) {
			/** HANDLE DEPENDENCIES */
			if ( self::checkForPartDependencies($controller, $part, $configuration) === FALSE ) {
				$partsToBeRemoved->attach($part);
			}
		}

		$parts->removeAll($partsToBeRemoved);
	}

	/**
	 * @param \S3b0\EcomConfigCodeGenerator\Controller\InjectController $controller    Ensure an Instance of extensions InjectController is given to provide necessary injections
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part           $part
	 * @param array                                                     $configuration
	 * @return boolean                                                  Returns FALSE if dependency check failed
	 */
	private static function checkForPartDependencies(\S3b0\EcomConfigCodeGenerator\Controller\InjectController $controller, \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part, array $configuration) {
		$check = TRUE;
		if ( !$part->getDependency() instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency )
			return $check;

		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency $dependency */
		$dependency = $part->getDependency();
		if ( $dependency instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency ) {
			/** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage $partGroups */
			$partGroups = $dependency->getPartGroups();
			if ( $partGroups instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $partGroups->count() ) {
				$dependencyCheck = [ ];
				/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
				foreach ( $partGroups as $partGroup ) {
					$partGroupCheck = [ ];
					  // If part group has no part selected or dependency has no parts selected for current group
					if ( !array_key_exists($partGroup->getUid(), $configuration) || sizeof($dependency->getPartsByPartGroup($partGroup)) === 0 )
						continue;
					  // Fetch selected parts for comparison
					$selectedParts = $controller->partRepository->findByList($configuration[$partGroup->getUid()]);
					  // Start actual dependency check
					if ( $selectedParts instanceof \Countable && $selectedParts->count() ) {
						  // Loop selected parts; fill $partGroupCheck array
						/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $selectedPart */
						foreach ( $selectedParts as $selectedPart ) {
							$partGroupCheck[] = $dependency->getPartsByPartGroup($partGroup)->contains($selectedPart);
						}
					}
					$dependencyCheck[] = in_array(TRUE, $partGroupCheck);
				}
				$check = $dependency->getMode() === 1 ? !in_array(FALSE, $dependencyCheck) : in_array(FALSE, $dependencyCheck);
			}
		}

		return $check;
	}

}