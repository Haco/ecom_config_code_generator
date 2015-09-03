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
 * Dependency notes, that appear when special parts have been chosen
 */
class DependentNote extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * The note itself
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $note = '';

	/**
	 * Wrapper <div class="alert alert-xxx"> (default Bootstrap classes)
	 *
	 * @var integer
	 */
	protected $noteWrap = 0;

	/**
	 * Specifies whether to use logical OR or AND chaining for dependent parts
	 *
	 * @var boolean
	 */
	protected $useLogicalAnd = FALSE;

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
	 * Returns the note
	 *
	 * @return string $note
	 */
	public function getNote() {
		switch ( $this->noteWrap ) {
			case 1:
				return "<div class=\"alert alert-success\"><table><tr><td style=\"vertical-align:middle;width:2.5em\"><i class=\"fa fa-check-circle fa-fw fa-lg\"></i></td><td>{$this->note}</td></tr></table></div>";
				break;
			case 2:
				return "<div class=\"alert alert-info\"><table><tr><td style=\"vertical-align:middle;width:2.5em\"><i class=\"fa fa-info-circle fa-fw fa-lg\"></i></td><td>{$this->note}</td></tr></table></div>";
				break;
			case 3:
				return "<div class=\"alert alert-warning\"><table><tr><td style=\"vertical-align:middle;width:2.5em\"><i class=\"fa fa-exclamation-triangle fa-fw fa-lg\"></i></td><td>{$this->note}</td></tr></table></div>";
				break;
			case 4:
				return "<div class=\"alert alert-danger\"><table><tr><td style=\"vertical-align:middle;width:2.5em\"><i class=\"fa fa-exclamation-circle fa-fw fa-lg\"></i></td><td>{$this->note}</td></tr></table></div>";
				break;
			default:
				return $this->note;
		}
	}

	/**
	 * Sets the note
	 *
	 * @param string $note
	 * @return void
	 */
	public function setNote($note) {
		$this->note = $note;
	}

	/**
	 * Returns the noteWrap
	 *
	 * @return integer
	 */
	public function getNoteWrap() {
		return $this->noteWrap;
	}

	/**
	 * Sets the noteWrap
	 *
	 * @param integer $noteWrap
	 * @return void
	 */
	public function setNoteWrap($noteWrap) {
		$this->noteWrap = $noteWrap;
	}

	/**
	 * Returns the useLogicalAnd
	 *
	 * @return boolean $useLogicalAnd
	 */
	public function getUseLogicalAnd() {
		return $this->useLogicalAnd;
	}

	/**
	 * Sets the useLogicalAnd
	 *
	 * @param boolean $useLogicalAnd
	 * @return void
	 */
	public function setUseLogicalAnd($useLogicalAnd) {
		$this->useLogicalAnd = $useLogicalAnd;
	}

	/**
	 * Returns the boolean state of useLogicalAnd
	 *
	 * @return boolean
	 */
	public function isUseLogicalAnd() {
		return $this->useLogicalAnd;
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