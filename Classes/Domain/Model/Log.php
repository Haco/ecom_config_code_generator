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
 * Log model
 */
class Log extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * PHP SESSION ID
	 *
	 * @var string
	 */
	protected $sessionId = '';

	/**
	 * Resulting configuration (code)
	 *
	 * @var string
	 */
	protected $configuration = '';

	/**
	 * The configration pricing
	 *
	 * @var string
	 */
	protected $pricing = '';

	/**
	 * The IP address (as of data protection anonymized)
	 *
	 * @var string
	 */
	protected $ipAddress = '';

	/**
	 * FE user record, if any
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FrontendUser
	 */
	protected $feUser = NULL;

	/**
	 * Configured parts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part>
	 */
	protected $configuredParts = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
		$this->setSessionId($GLOBALS['TSFE']->fe_user->id)->setPid(0);
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
		$this->configuredParts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the sessionId
	 *
	 * @return string $sessionId
	 */
	public function getSessionId() {
		return $this->sessionId;
	}

	/**
	 * Sets the sessionId
	 *
	 * @param string $sessionId
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setSessionId($sessionId) {
		$this->sessionId = $sessionId;
		return $this;
	}

	/**
	 * Returns the configuration
	 *
	 * @return string $configuration
	 */
	public function getConfiguration() {
		return $this->configuration;
	}

	/**
	 * Sets the configuration
	 *
	 * @param string $configuration
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setConfiguration($configuration) {
		$this->configuration = $configuration;
		return $this;
	}

	/**
	 * Returns the pricing
	 *
	 * @return string $pricing
	 */
	public function getPricing() {
		return $this->pricing;
	}

	/**
	 * Sets the pricing
	 *
	 * @param string $pricing
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setPricing($pricing) {
		$this->pricing = $pricing;
		return $this;
	}

	/**
	 * Returns the ipAddress
	 *
	 * @return string $ipAddress
	 */
	public function getIpAddress() {
		return $this->ipAddress;
	}

	/**
	 * Sets the ipAddress
	 *
	 * @param string $ipAddress
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setIpAddress($ipAddress) {
		$this->ipAddress = $ipAddress;
		return $this;
	}

	/**
	 * @param integer $parts
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function maskIpAddress($parts = 4) {
		$tokens = \TYPO3\CMS\Core\Utility\GeneralUtility::intExplode('.', \TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REMOTE_ADDR'), TRUE, 4);

		$ipParts = array_slice($tokens, 0, $parts);
		$ipParts = array_pad($ipParts, 4, '*');

		$this->ipAddress = implode('.', $ipParts);
		return $this;
	}

	/**
	 * Returns the feUser
	 *
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
	 */
	public function getFeUser() {
		return $this->feUser;
	}

	/**
	 * Sets the feUser
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setFeUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser) {
		$this->feUser = $feUser;
		return $this;
	}

	/**
	 * Adds a configured Part
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $configuredPart
	 * @return void
	 */
	public function addConfiguredPart(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $configuredPart) {
		$this->configuredParts->attach($configuredPart);
	}

	/**
	 * Removes a configured Part
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $configuredPartToRemove The Modal to be removed
	 * @return void
	 */
	public function removeConfiguredPart(\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $configuredPartToRemove) {
		$this->configuredParts->detach($configuredPartToRemove);
	}

	/**
	 * Returns the configuredParts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $configuredParts
	 */
	public function getConfiguredParts() {
		return $this->configuredParts;
	}

	/**
	 * Sets the configuredParts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $configuredParts
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setConfiguredParts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $configuredParts) {
		$this->configuredParts = $configuredParts;
		return $this;
	}

}