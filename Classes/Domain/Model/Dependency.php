<?php
namespace S3b0\EcomConfigCodeGenerator\Domain\Model;


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
 * Limit part visibility on selected parts
 */
class Dependency extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Select mode allow|deny
	 *
	 * @var integer
	 */
	protected $mode = 0;

	/**
	 * Select depending part groups
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup>
	 */
	protected $partGroups = NULL;

	/**
	 * Select depending parts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part>
	 */
	protected $parts = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->partGroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->parts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the mode
	 *
	 * @return integer $mode
	 */
	public function getMode() {
		return $this->mode;
	}

	/**
	 * Sets the mode
	 *
	 * @param integer $mode
	 * @return void
	 */
	public function setMode($mode) {
		$this->mode = $mode;
	}

	/**
	 * Adds a PartGroup
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
	 * @return void
	 */
	public function addPartGroup(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup) {
		$this->partGroups->attach($partGroup);
	}

	/**
	 * Removes a PartGroup
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroupToRemove The PartGroup to be removed
	 * @return void
	 */
	public function removePartGroup(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroupToRemove) {
		$this->partGroups->detach($partGroupToRemove);
	}

	/**
	 * Returns the partGroups
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup> $partGroups
	 */
	public function getPartGroups() {
		return $this->partGroups;
	}

	/**
	 * Sets the partGroups
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup> $partGroups
	 * @return void
	 */
	public function setPartGroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $partGroups) {
		$this->partGroups = $partGroups;
	}

	/**
	 * Adds a Part
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part
	 * @return void
	 */
	public function addPart(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part) {
		$this->parts->attach($part);
	}

	/**
	 * Removes a Part
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $partToRemove The Part to be removed
	 * @return void
	 */
	public function removePart(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $partToRemove) {
		$this->parts->detach($partToRemove);
	}

	/**
	 * Returns the parts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $parts
	 */
	public function getParts() {
		return $this->parts;
	}

	/**
	 * Sets the parts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $parts
	 * @return void
	 */
	public function setParts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $parts) {
		$this->parts = $parts;
	}

	/**
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part>
	 */
	public function getPartsByPartGroup(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup) {
		if ( !$this->parts instanceof \Countable || $this->parts->count() === 0 ) {
			return $this->parts;
		}

		$parts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
		foreach ( $this->parts as $part ) {
			if ( $part->getPartGroup() === $partGroup ) {
				$parts->attach($part);
			}
		}

		return $parts;
	}

}