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
use S3b0\EcomConfigCodeGenerator\Setup;

/**
 * Group of parts available for configuration
 */
class PartGroup extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var integer
	 */
	protected $sorting = 0;

	/**
	 * The part group title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * Icon file, if any
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $icon = NULL;

	/**
	 * Where to place segment in code?
	 *
	 * @var integer
	 */
	protected $placeInCode = 0;

	/**
	 * User prompt plus hints, if any
	 *
	 * @var string
	 */
	protected $prompt = '';

	/**
	 * Wrapper <div class="alert alert-xxx"> (default Bootstrap classes)
	 *
	 * @var integer
	 */
	protected $promptWrap = 0;

	/**
	 * Global settings, i.e. visibility options, pricing options, multiple select
	 * availability ...
	 *
	 * @var integer
	 */
	protected $settings = 0;

	/**
	 * Parts belonging to the group
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part>
	 * @cascade remove
	 * @lazy
	 */
	protected $parts = NULL;

	/**
	 * The default part if should be pre-selected
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part
	 * @lazy
	 */
	protected $defaultPart = NULL;

	/**
	 * Notes depending on divers parts selected
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote>
	 * @cascade remove
	 * @lazy
	 */
	protected $dependentNotes = NULL;

	/**
	 * Modals opening when dependency match on parts selected
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Modal>
	 * @cascade remove
	 * @lazy
	 */
	protected $modals = NULL;

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration
	 */
	protected $configuration;

	/**
	 * @var string
	 */
	protected $pricing = '';

	/**
	 * @var float
	 */
	protected $pricingNumeric = 0.0;

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part>
	 */
	protected $activeParts = NULL;

	/**
	 * @var \ArrayObject
	 */
	protected $dependentNotesFluidParsedMessages;

	/**
	 * @var boolean
	 */
	protected $active = FALSE;

	/**
	 * @var boolean
	 */
	protected $current = FALSE;

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup
	 */
	protected $next = NULL;

	/**
	 * @var integer
	 */
	protected $stepIndicator = 0;

	/**
	 * @var boolean
	 */
	protected $selectable = TRUE;

	/**
	 * @var boolean
	 */
	protected $last = FALSE;

	/**
	 * __construct
	 */
	public function __construct() {
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
		$this->parts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->activeParts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->dependentNotes = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->dependentNotesFluidParsedMessages = new \ArrayObject();
		$this->modals = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * @return integer
	 */
	public function getSorting() {
		return $this->sorting;
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
	 * Returns the icon
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $icon
	 */
	public function getIcon() {
		return $this->icon;
	}

	/**
	 * Sets the icon
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $icon
	 * @return void
	 */
	public function setIcon(\TYPO3\CMS\Extbase\Domain\Model\FileReference $icon) {
		$this->icon = $icon;
	}

	/**
	 * Returns the placeInCode
	 *
	 * @return integer $placeInCode
	 */
	public function getPlaceInCode() {
		return $this->placeInCode;
	}

	/**
	 * Sets the placeInCode
	 *
	 * @param integer $placeInCode
	 * @return void
	 */
	public function setPlaceInCode($placeInCode) {
		$this->placeInCode = $placeInCode;
	}

	/**
	 * Returns the prompt
	 *
	 * @return string $prompt
	 */
	public function getPrompt() {
		switch ( $this->promptWrap ) {
			case 1:
				return "<div class=\"alert alert-success\">{$this->prompt}</div>";
				break;
			case 2:
				return "<div class=\"alert alert-info\">{$this->prompt}</div>";
				break;
			case 3:
				return "<div class=\"alert alert-warning\">{$this->prompt}</div>";
				break;
			case 4:
				return "<div class=\"alert alert-danger\">{$this->prompt}</div>";
				break;
			default:
				return $this->prompt;
		}
	}

	/**
	 * Sets the prompt
	 *
	 * @param string $prompt
	 * @return void
	 */
	public function setPrompt($prompt) {
		$this->prompt = $prompt;
	}

	/**
	 * Returns the promptWrap
	 *
	 * @return integer
	 */
	public function getPromptWrap() {
		return $this->promptWrap;
	}

	/**
	 * Sets the promptWrap
	 *
	 * @param integer $promptWrap
	 * @return void
	 */
	public function setPromptWrap($promptWrap) {
		$this->promptWrap = $promptWrap;
	}

	/**
	 * Returns the settings
	 *
	 * @return integer $settings
	 */
	public function getSettings() {
		return $this->settings;
	}

	/**
	 * Sets the settings
	 *
	 * @param integer $settings
	 * @return void
	 */
	public function setSettings($settings) {
		$this->settings = $settings;
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
	 * Check if configured parts are also available...
	 *
	 * @param array $partUidList
	 * @todo check right to exist
	 * @return boolean
	 */
	public function areConfiguredPartsAvailable($partUidList = [ ]) {
		$check = FALSE;
		if ( is_array($partUidList) && sizeof($partUidList) && $this->parts instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $this->parts->count() ) {
			/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
			foreach ( $this->parts as $part ) {
				if ( in_array($part->getUid(), $partUidList) ) {
					$check = TRUE;
					break;
				}
			}
		}

		return $check;
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
	 * Returns the defaultPart
	 *
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $defaultPart
	 */
	public function getDefaultPart() {
		return $this->defaultPart;
	}

	/**
	 * Sets the defaultPart
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $defaultPart
	 * @return void
	 */
	public function setDefaultPart(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $defaultPart) {
		$this->defaultPart = $defaultPart;
	}

	/**
	 * @return boolean
	 */
	public function hasDefaultPart() {
		return $this->defaultPart && ( $this->defaultPart instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Part || $this->defaultPart instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy );
	}

	/**
	 * Adds a DependentNote
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote $dependentNote
	 * @return void
	 */
	public function addDependentNote(\S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote $dependentNote) {
		$this->dependentNotes->attach($dependentNote);
	}

	/**
	 * Removes a DependentNote
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote $dependentNoteToRemove The DependentNote to be
	 *                                                                                        removed
	 * @return void
	 */
	public function removeDependentNote(\S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote $dependentNoteToRemove) {
		$this->dependentNotes->detach($dependentNoteToRemove);
	}

	/**
	 * Returns the dependentNotes
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote> $dependentNotes
	 */
	public function getDependentNotes() {
		return $this->dependentNotes;
	}

	/**
	 * Sets the dependentNotes
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote> $dependentNotes
	 * @return void
	 */
	public function setDependentNotes(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $dependentNotes) {
		$this->dependentNotes = $dependentNotes;
	}

	/**
	 * Adds a dependentNotesFluidParsedMessages
	 *
	 * @param string $dependentNotesFluidParsedMessages
	 * @return void
	 */
	public function addDependentNotesFluidParsedMessage($dependentNotesFluidParsedMessages) {
		if ( !$this->dependentNotesFluidParsedMessages instanceof \ArrayObject ) {
			$this->dependentNotesFluidParsedMessages = new \ArrayObject();
		}
		$this->dependentNotesFluidParsedMessages->append($dependentNotesFluidParsedMessages);
	}

	/**
	 * Returns the dependentNotesFluidParsedMessages
	 *
	 * @return string
	 */
	public function getDependentNotesFluidParsedMessages() {
		$dependentNotesFluidParsedMessages = '';
		if ( $this->dependentNotesFluidParsedMessages instanceof \ArrayAccess ) {
			foreach ( $this->dependentNotesFluidParsedMessages as $dependentNotesFluidParsedMessage ) {
				$dependentNotesFluidParsedMessages .= "<p>{$dependentNotesFluidParsedMessage}</p>";
			}
		}

		return $dependentNotesFluidParsedMessages;
	}

	/**
	 * Adds a Modal
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Modal $modal
	 * @return void
	 */
	public function addModal(\S3b0\EcomConfigCodeGenerator\Domain\Model\Modal $modal) {
		$this->modals->attach($modal);
	}

	/**
	 * Removes a Modal
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Modal $modalToRemove The Modal to be removed
	 * @return void
	 */
	public function removeModal(\S3b0\EcomConfigCodeGenerator\Domain\Model\Modal $modalToRemove) {
		$this->modals->detach($modalToRemove);
	}

	/**
	 * Returns the modals
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Modal> $modals
	 */
	public function getModals() {
		return $this->modals;
	}

	/**
	 * Sets the modals
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Modal> $modals
	 * @return void
	 */
	public function setModals(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $modals) {
		$this->modals = $modals;
	}

	/**
	 * @return boolean
	 */
	public function hasModals() {
		return $this->modals instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $this->modals->count();
	}

	/**
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration
	 */
	public function getConfiguration() {
		return $this->configuration;
	}

	/**
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration $configuration
	 */
	public function setConfiguration(\S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration $configuration = NULL) {
		$this->configuration = $configuration;
	}

	/**
	 * @return string
	 */
	public function getPricing() {
		return \S3b0\EcomConfigCodeGenerator\Utility\PriceHandler::getPriceInCurrency($this->pricingNumeric, $this->configuration->getCurrency(), TRUE);
	}

	/**
	 * @param string $pricing
	 */
	public function setPricing($pricing) {
		$this->pricing = $pricing;
	}

	/**
	 * @return float
	 */
	public function getPricingNumeric() {
		return $this->pricingNumeric;
	}

	/**
	 * @param float $pricingNumeric
	 */
	public function setPricingNumeric($pricingNumeric) {
		$this->pricingNumeric = $pricingNumeric;
	}

	/**
	 * Adds a part to active items
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part
	 * @return void
	 */
	public function addActivePart(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part) {
		if ( !$this->activeParts instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage )
			$this->activeParts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		if ( !$this->activeParts->contains($part) )
			$this->activeParts->attach($part);
	}

	/**
	 * Removes a part from active items
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $partToRemove The Part to be removed
	 * @return void
	 */
	public function removeActivePart(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $partToRemove) {
		if ( $this->activeParts instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $this->activeParts->contains($partToRemove) )
			$this->activeParts->detach($partToRemove);
	}

	/**
	 * Returns the activeParts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $activeParts
	 */
	public function getActiveParts() {
		return $this->activeParts;
	}

	/**
	 * Sets the activeParts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $activeParts
	 * @return void
	 */
	public function setActiveParts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $activeParts) {
		$this->activeParts = $activeParts;
	}

	/**
	 * @return boolean
	 */
	public function isActive() {
		return $this->active;
	}

	/**
	 * @param boolean $active
	 * @return void
	 */
	public function setActive($active) {
		$this->active = $active;
	}

	/**
	 * @return boolean
	 */
	public function isCurrent() {
		return $this->current;
	}

	/**
	 * @param boolean $current
	 */
	public function setCurrent($current) {
		$this->current = $current;
	}

	/**
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup
	 */
	public function getNext() {
		return $this->next;
	}

	/**
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $next
	 */
	public function setNext($next) {
		$this->next = $next;
	}

	/**
	 * @return boolean
	 */
	public function isUnlocked() {
		return ($this->settings & Setup::BIT_PARTGROUP_IS_LOCKED) === Setup::BIT_PARTGROUP_IS_LOCKED;
	}

	/**
	 * @param boolean $locked
	 */
	public function setUnlocked($locked = TRUE) {
		if ( $this->isUnlocked() && $locked === FALSE ) {
			$this->setSettings($this->getSettings() - Setup::BIT_PARTGROUP_IS_LOCKED);
		} elseif ( !$this->isUnlocked() && $locked === TRUE ) {
			$this->setSettings($this->getSettings() + Setup::BIT_PARTGROUP_IS_LOCKED);
		}
	}

	/**
	 * @return boolean
	 */
	public function isVisibleInSummary() {
		return ($this->settings & Setup::BIT_PARTGROUP_IN_SUMMARY) === Setup::BIT_PARTGROUP_IN_SUMMARY;
	}

	/**
	 * @return boolean
	 */
	public function isVisibleInNavigation() {
		return ($this->settings & Setup::BIT_PARTGROUP_IN_NAVIGATION) === Setup::BIT_PARTGROUP_IN_NAVIGATION;
	}

	/**
	 * @return boolean
	 */
	public function isMultipleSelectable() {
		return ($this->settings & Setup::BIT_PARTGROUP_MULTIPLE_SELECT) === Setup::BIT_PARTGROUP_MULTIPLE_SELECT;
	}

	/**
	 * @return boolean
	 */
	public function isPricePercentage() {
		return ($this->settings & Setup::BIT_PARTGROUP_USE_PERCENTAGE_PRICING) === Setup::BIT_PARTGROUP_USE_PERCENTAGE_PRICING;
	}

	/**
	 * @return boolean
	 */
	public function isLocked() {
		return !$this->isUnlocked();
	}

	/**
	 * @return integer
	 */
	public function getStepIndicator() {
		return $this->stepIndicator;
	}

	/**
	 * @param integer $stepIndicator
	 */
	public function setStepIndicator($stepIndicator) {
		$this->stepIndicator = $stepIndicator;
	}

	/**
	 * @return boolean
	 */
	public function isSelectable() {
		return $this->selectable;
	}

	/**
	 * @param boolean $selectable
	 */
	public function setSelectable($selectable) {
		$this->selectable = $selectable;
	}

	/**
	 * @return boolean
	 */
	public function isLast() {
		return $this->last;
	}

	/**
	 * @param boolean $last
	 */
	public function setLast($last) {
		$this->last = $last;
	}

	/**
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency
	 * @param array                                               $settings
	 */
	public function setPartsCurrencyPricing(\S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency = NULL, array $settings = [ ]) {
		if ( $this->parts instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $this->parts->count() ) {
			/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
			foreach ( $this->parts as $part ) {
				$part->setCurrencyPricing($currency, $settings);
				if ( $part->isActive() ) {
					$this->pricingNumeric += $part->getNoCurrencyPricing();
				}
			}
		}
	}

	/**
	 * reset function
	 */
	public function reset() {
		$this->dependentNotesFluidParsedMessages = new \ArrayObject();
		$this->active = FALSE;
		$this->current = FALSE;
		$this->next = NULL;
		$this->selectable = TRUE;
		$this->last = FALSE;
	}

}