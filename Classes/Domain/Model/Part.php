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
 * A part available to configuration
 */
class Part extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var int
	 */
	protected $sorting = 0;

	/**
	 * The part title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * Representation of part as segment in code!
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $codeSegment = '';

	/**
	 * A part image
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $image = NULL;

	/**
	 * Give user a hint
	 *
	 * @var string
	 */
	protected $hint = '';

	/**
	 * Set a dependency on other parts
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency
	 */
	protected $dependency = NULL;

	/**
	 * Part pricing
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Price>
	 * @cascade remove
	 */
	public $pricing = NULL;

	/**
	 * Part pricing (percentage)
	 *
	 * @var float
	 */
	public $pricingPercentage = 0.0;

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Price
	 */
	public $currencyPricing = NULL;

	/**
	 * @var float
	 */
	public $noCurrencyPricing = 0.0;

	/**
	 * @var string
	 */
	public $differencePricing = '';

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup
	 */
	protected $partGroup = NULL;

	/**
	 * @var bool
	 */
	protected $active = FALSE;

	/**
	 * @var int
	 */
	protected $modalTrigger = 0;

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
		$this->pricing = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * @return int $sorting
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
	 * Returns the codeSegment
	 *
	 * @return string $codeSegment
	 */
	public function getCodeSegment() {
		return $this->codeSegment;
	}

	/**
	 * Sets the codeSegment
	 *
	 * @param string $codeSegment
	 * @return void
	 */
	public function setCodeSegment($codeSegment) {
		$this->codeSegment = $codeSegment;
	}

	/**
	 * Returns the image
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * Sets the image
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
	 * @return void
	 */
	public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image) {
		$this->image = $image;
	}

	/**
	 * Returns the hint
	 *
	 * @return string $hint
	 */
	public function getHint() {
		return $this->hint;
	}

	/**
	 * Sets the hint
	 *
	 * @param string $hint
	 * @return void
	 */
	public function setHint($hint) {
		$this->hint = $hint;
	}

	/**
	 * Returns the dependency
	 *
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency $dependency
	 */
	public function getDependency() {
		return $this->dependency;
	}

	/**
	 * Sets the dependency
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency $dependency
	 * @return void
	 */
	public function setDependency(\S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency $dependency) {
		$this->dependency = $dependency;
	}

	/**
	 * Adds a Price
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricing
	 * @return void
	 */
	public function addPricing(\S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricing) {
		$this->pricing->attach($pricing);
	}

	/**
	 * Removes a Price
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricingToRemove The Price to be removed
	 * @return void
	 */
	public function removePricing(\S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricingToRemove) {
		$this->pricing->detach($pricingToRemove);
	}

	/**
	 * Returns the pricing
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Price> $pricing
	 */
	public function getPricing() {
		return $this->pricing;
	}

	/**
	 * Sets the pricing
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Price> $pricing
	 * @return void
	 */
	public function setPricing(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $pricing) {
		$this->pricing = $pricing;
	}

	/**
	 * Returns the pricingPercentage
	 *
	 * @return float $pricingPercentage
	 */
	public function getPricingPercentage() {
		return $this->pricingPercentage;
	}

	/**
	 * Sets the pricingPercentage
	 *
	 * @param float $pricingPercentage
	 */
	public function setPricingPercentage($pricingPercentage) {
		$this->pricingPercentage = $pricingPercentage;
	}

	/**
	 * Returns the currencyPricing
	 *
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $currencyPricing
	 */
	public function getCurrencyPricing() {
		return $this->currencyPricing;
	}

	/**
	 * Sets the currencyPricing
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency
	 * @param array                                               $settings
	 */
	public function setCurrencyPricing(\S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency = NULL, array $settings = [ ]) {
		\S3b0\EcomConfigCodeGenerator\Utility\PriceHandler::setPriceInCurrency($this, $currency, $settings);
	}

	/**
	 * Returns the noCurrencyPricing
	 *
	 * @return float $noCurrencyPricing
	 */
	public function getNoCurrencyPricing() {
		return $this->noCurrencyPricing;
	}

	/**
	 * Sets the noCurrencyPricing
	 *
	 * @param float $noCurrencyPricing
	 */
	public function setNoCurrencyPricing($noCurrencyPricing) {
		$this->noCurrencyPricing = $noCurrencyPricing;
	}

	/**
	 * Returns the differencePricing
	 *
	 * @return string $differencePricing
	 */
	public function getDifferencePricing() {
		if ( $this->partGroup->isMultipleSelectable() ) {
			$value = $this->noCurrencyPricing * ($this->active ? -1 : 1);
		} else {
			if ( $this->active ) {
				$value = $this->noCurrencyPricing * -1;
			} else {
				$value = $this->noCurrencyPricing - $this->partGroup->getPricingNumeric();
			}
		}
		$value = \S3b0\EcomConfigCodeGenerator\Utility\PriceHandler::getPriceInCurrency($value, $this->partGroup->getConfiguration()->getCurrency(), TRUE);

		return $value;
	}

	/**
	 * Sets the differencePricing
	 *
	 * @param string $differencePricing
	 */
	public function setDifferencePricing($differencePricing) {
		$this->differencePricing = $differencePricing;
	}

	/**
	 * Returns the part group
	 *
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
	 */
	public function getPartGroup() {
		return $this->partGroup;
	}

	/**
	 * Sets the part group
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
	 * @return void
	 */
	public function setPartGroup(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup) {
		$this->partGroup = $partGroup;
	}

	/**
	 * @return bool $active
	 */
	public function isActive() {
		return $this->active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive($active) {
		$this->active = $active;
	}

	/**
	 * @return int $modalTrigger
	 */
	public function getModalTrigger() {
		return $this->modalTrigger;
	}

	/**
	 * @param int $modalTrigger
	 */
	public function setModalTrigger($modalTrigger) {
		$this->modalTrigger = $modalTrigger;
	}

}