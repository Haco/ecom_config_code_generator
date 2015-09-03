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
 * Currency information table
 */
class Currency extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * Currency title
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $title = '';

	/**
	 * ISO 4217 code see https://en.wikipedia.org/wiki/ISO_4217
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $isoCode = '';

	/**
	 * Exchange rate (depending on default currency)
	 *
	 * @var float
	 */
	protected $exchange = 0.0;

	/**
	 * Currency symbol, i.e. €, $, £. ¥ ...
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $symbol = '';

	/**
	 * Currency region or country
	 *
	 * @var string
	 * @validate NotEmpty
	 */
	protected $region = '';

	/**
	 * Reference to locallang item for region label translation
	 *
	 * @var string
	 */
	protected $llReference = '';

	/**
	 * The region flag, if available
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 */
	protected $flag = NULL;

	/**
	 * Divers currency settings
	 *
	 * @var boolean
	 */
	protected $settings = FALSE;

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
	 * Returns the isoCode
	 *
	 * @return string $isoCode
	 */
	public function getIsoCode() {
		return $this->isoCode;
	}

	/**
	 * Sets the isoCode
	 *
	 * @param string $isoCode
	 * @return void
	 */
	public function setIsoCode($isoCode) {
		$this->isoCode = $isoCode;
	}

	/**
	 * Returns the exchange
	 *
	 * @return float $exchange
	 */
	public function getExchange() {
		return $this->exchange;
	}

	/**
	 * Sets the exchange
	 *
	 * @param float $exchange
	 * @return void
	 */
	public function setExchange($exchange) {
		$this->exchange = $exchange;
	}

	/**
	 * Returns the symbol
	 *
	 * @return string $symbol
	 */
	public function getSymbol() {
		return $this->symbol;
	}

	/**
	 * Sets the symbol
	 *
	 * @param string $symbol
	 * @return void
	 */
	public function setSymbol($symbol) {
		$this->symbol = $symbol;
	}

	/**
	 * Returns the region
	 *
	 * @return string $region
	 */
	public function getRegion() {
		return $this->region;
	}

	/**
	 * Sets the region
	 *
	 * @param string $region
	 * @return void
	 */
	public function setRegion($region) {
		$this->region = $region;
	}

	/**
	 * Returns the llReference
	 *
	 * @return string $llReference
	 */
	public function getLlReference() {
		return $this->llReference;
	}

	/**
	 * Sets the llReference
	 *
	 * @param string $llReference
	 * @return void
	 */
	public function setLlReference($llReference) {
		$this->llReference = $llReference;
	}

	/**
	 * Returns the flag
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $flag
	 */
	public function getFlag() {
		return $this->flag;
	}

	/**
	 * Sets the flag
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $flag
	 * @return void
	 */
	public function setFlag(\TYPO3\CMS\Extbase\Domain\Model\FileReference $flag) {
		$this->flag = $flag;
	}

	/**
	 * Returns the settings
	 *
	 * @return boolean $settings
	 */
	public function getSettings() {
		return $this->settings;
	}

	/**
	 * Sets the settings
	 *
	 * @param boolean $settings
	 * @return void
	 */
	public function setSettings($settings) {
		$this->settings = $settings;
	}

	/**
	 * Returns the boolean state of settings
	 *
	 * @return boolean
	 */
	public function isSettings() {
		return $this->settings;
	}

}