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
class PartController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * partGroupRepository
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\PartRepository
	 * @inject
	 */
	protected $partRepository = NULL;

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
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage         $parts
	 * @param array                                                $configuration
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public static function initialize(\TYPO3\CMS\Extbase\Persistence\ObjectStorage &$parts, array &$configuration) {
		$selectedParts = [ ];
		foreach ( $configuration as $partGroupSelectedParts ) {
			if ( sizeof($partGroupSelectedParts) ) {
				foreach ( $partGroupSelectedParts as $part ) {
					$selectedParts[] = $part;
				}
			}
		}

		$partsToBeRemoved = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
		foreach ( $parts as $part ) {
			/** HANDLE DEPENDENCIES */
			$parts->detach($part);
			debug(get_class($part->getDependency()));
			if ( ( $dependency = $part->getDependency() ) instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency ) {
				if ( $dependency->getParts() ) {
					/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $dependentPart */
					foreach ( $dependency->getParts() as $dependentPart ) {
						if ( in_array($dependentPart->getUid(), $selectedParts) ) {
							/** @mode explicit deny */
							if ( $dependency->getMode() === 0 ) {
								$partsToBeRemoved->attach($part);
								continue 2;
							}
						} else {
							/** @mode explicit allow */
							if ( $dependency->getMode() === 1 ) {
								$partsToBeRemoved->attach($part);
								continue 2;
							}
						}
					}
				}
			}
		}

		$parts->removeAll($partsToBeRemoved);

		return $parts;
	}

}