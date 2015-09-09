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
 * PartGroupController
 */
class PartGroupController extends \S3b0\EcomConfigCodeGenerator\Controller\InjectController {

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$partGroups = $this->partGroupRepository->findAll();
		$this->view->assign('partGroups', $partGroups);
	}

	/**
	 * action show
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
	 * @return void
	 */
	public function showAction(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup) {
		$this->view->assign('partGroup', $partGroup);
	}

	/**
	 * Initialize part groups
	 *
	 * @param \TYPO3\CMS\Extbase\Mvc\Controller\ActionController   $controller
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage         $partGroups
	 * @param array                                                $configuration
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $current
	 * @param integer                                              $progress
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public static function initialize(\TYPO3\CMS\Extbase\Mvc\Controller\ActionController $controller, \TYPO3\CMS\Extbase\Persistence\ObjectStorage $partGroups, array &$configuration, \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup &$current = NULL, &$progress = 0) {
		/** @var \S3b0\EcomConfigCodeGenerator\Controller\InjectController $controller */
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $current */
		$current = NULL;   // Mark part group current
		$isActive = FALSE; // Set part group state
		$previous = NULL;  // Set previous part group (next as of array_reverse)
		$cycle = 1;        // Count loop cycles
		$hidden = 0;       // Count hidden
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
		foreach ( array_reverse($partGroups->toArray()) as $partGroup ) {
			/** Handle hidden groups */
			if ( $partGroup->isHidden() ) {
				if ( $partGroup->hasDefaultPart() ) {
					$configuration[$partGroup->getUid()][$partGroup->getDefaultPart()->getSorting()] = $partGroup->getDefaultPart()->getUid();
					$partGroup->addActivePart($partGroup->getDefaultPart());
				} else {
					$partGroups->detach($partGroup);
				}
				$hidden++;
				$cycle++;
				continue;
			}
			/**
			 * Add dependent notes, if set
			 */
			if ( $partGroup->getDependentNotes() instanceof \Countable && $partGroup->getDependentNotes()->count() ) {
				/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote $dependentNote */
				foreach ( $partGroup->getDependentNotes() as $dependentNote ) {
					if ( $dependentNote->getDependentParts()->count() ) {
						$logicalAnd = $dependentNote->isUseLogicalAnd();
						$addMessage = FALSE;
						/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $dependentPart */
						foreach ( $dependentNote->getDependentParts() as $dependentPart ) {
							if ( is_array($configuration[$partGroup->getUid()]) && in_array($dependentPart->getUid(), $configuration[$partGroup->getUid()]) ) {
								$addMessage = TRUE;
								if ( !$logicalAnd ) {
									break;
								}
							} else {
								if ( $logicalAnd ) {
									$addMessage = FALSE;
									break;
								}
							}
						}
						if ( $addMessage ) {
							$partGroup->addDependentNotesFluidParsedMessage($dependentNote->getNote());
						}
					}
				}
			}
			/**
			 * Check for active packages
			 */
			if ( array_key_exists($partGroup->getUid(), $configuration) ) {
				$partGroup->setActiveParts(self::getAndSetActiveParts($controller, $configuration[$partGroup->getUid()]));
				if ( !$isActive ) {
					$isActive = TRUE;
					if ( $previous instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ) {
						$previous->setActive(TRUE);
						$current = $current ?: $previous;
					}
				}
			}
			// Initially use first package
			if ( $cycle === $partGroups->count() && !$current instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ) {
				$isActive = TRUE;
				$current = $current ?: $partGroup;
			}
			$partGroup->setActive($isActive);
			// Fallback to first package wherein no option is active
			if ( $partGroup->isActive() && $partGroup->getActiveParts() instanceof \Countable && $partGroup->getActiveParts()->count() === 0 ) {
				if ( !$current instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ) {
					$current = $partGroup;
				} elseif ( $current instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup && $current !== $partGroup ) {
					$current = $partGroup;
				}
			}
			$partGroup->setNext($previous);
			/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $previous */
			$previous = $partGroup;
			$cycle++;
		}
		if ( !$current instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ) {
			$current = $partGroup;
		}
		$current->setCurrent(TRUE);
		if ( !$isActive ) {
			$partGroup->setActive(TRUE);
		}

		if ( property_exists($controller, 'feSession') && $controller->feSession instanceof \Ecom\EcomToolbox\Domain\Session\FrontendSessionHandler )
			$controller->feSession->store('config', $configuration);

		// Get progress state update (ratio of active to visible packages) => float from 0 to 1 (*100 = %)
		$progress = ( sizeof($configuration) - $hidden ) / ( $partGroups->count() - $hidden );

		return $partGroups;
	}

	/**
	 * @param \S3b0\EcomConfigCodeGenerator\Controller\InjectController $controller Ensure an Instance of extensions InjectController is given to provide necessary injections
	 * @param array                                                     $list
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	private static function getAndSetActiveParts(\S3b0\EcomConfigCodeGenerator\Controller\InjectController $controller, array $list) {
		$objectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		if ( $parts = $controller->partRepository->findByList($list) ) {
			/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
			foreach ( $parts as $part ) {
				$part->setActive(TRUE);
				$objectStorage->attach($part);
			}
		}

		return $objectStorage;
	}

}