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
 * Modal
 */
class Modal extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * text
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $text = '';

	/**
	 * Use confirm instead of alert
	 *
	 * @var boolean
	 */
	protected $useConfirmation = FALSE;

	/**
	 * Parts the note display depends on
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part>
	 */
	protected $dependentParts = NULL;

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
		$this->dependentParts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the text
	 *
	 * @return string $text
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * Sets the text
	 *
	 * @param string $text
	 * @return void
	 */
	public function setText($text) {
		$this->text = $text;
	}

	/**
	 * Returns the useConfirmation
	 *
	 * @return boolean $useConfirmation
	 */
	public function getUseConfirmation() {
		return $this->useConfirmation;
	}

	/**
	 * Sets the useConfirmation
	 *
	 * @param boolean $useConfirmation
	 * @return void
	 */
	public function setUseConfirmation($useConfirmation) {
		$this->useConfirmation = $useConfirmation;
	}

	/**
	 * Adds a Part
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $dependentPart
	 * @return void
	 */
	public function addDependentPart(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $dependentPart) {
		$this->dependentParts->attach($dependentPart);
	}

	/**
	 * Removes a Part
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $dependentPartToRemove The Part to be removed
	 * @return void
	 */
	public function removeDependentPart(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $dependentPartToRemove) {
		$this->dependentParts->detach($dependentPartToRemove);
	}

	/**
	 * Returns the dependentParts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $dependentParts
	 */
	public function getDependentParts() {
		return $this->dependentParts;
	}

	/**
	 * Sets the dependentParts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $dependentParts
	 * @return void
	 */
	public function setDependentParts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $dependentParts) {
		$this->dependentParts = $dependentParts;
	}

}