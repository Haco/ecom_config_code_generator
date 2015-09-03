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
 * Pricing information table
 */
class Price extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * The pricing value
	 *
	 * @var float
	 * @validate NotEmpty
	 */
	protected $value = 0.0;

	/**
	 * Corresponding currency
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency
	 * @lazy
	 */
	protected $currency = NULL;

	/**
	 * Returns the value
	 *
	 * @return float $value
	 */
	public function getValue() {
		return $this->value;
	}

	/**
	 * Sets the value
	 *
	 * @param float $value
	 * @return void
	 */
	public function setValue($value) {
		$this->value = $value;
	}

	/**
	 * Returns the currency
	 *
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency
	 */
	public function getCurrency() {
		return $this->currency;
	}

	/**
	 * Sets the currency
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency
	 * @return void
	 */
	public function setCurrency(\S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency) {
		$this->currency = $currency;
	}

}