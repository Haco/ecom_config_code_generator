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
	 * salutation
	 *
	 * @var string
	 */
	protected $salutation = '';

	/**
	 * firstName
	 *
	 * @var string
	 */
	protected $firstName = '';

	/**
	 * lastName
	 *
	 * @var string
	 */
	protected $lastName = '';

	/**
	 * subject
	 *
	 * @var string
	 */
	protected $subject = '';

	/**
	 * message
	 *
	 * @var string
	 */
	protected $message = '';

	/**
	 * company
	 *
	 * @var string
	 */
	protected $company = '';

	/**
	 * jobTitle
	 *
	 * @var string
	 */
	protected $jobTitle = '';

	/**
	 * address
	 *
	 * @var string
	 */
	protected $address = '';

	/**
	 * postalCode
	 *
	 * @var string
	 */
	protected $postalCode = '';

	/**
	 * city
	 *
	 * @var string
	 */
	protected $city = '';

	/**
	 * phone
	 *
	 * @var string
	 */
	protected $phone = '';

	/**
	 * fax
	 *
	 * @var string
	 */
	protected $fax = '';

	/**
	 * email
	 *
	 * @var string
	 */
	protected $email = '';

	/**
	 * Resulting configuration (code)
	 *
	 * @var string
	 */
	protected $configuration = '';

	/**
	 * @var int
	 */
	protected $quantity = 1;

	/**
	 * The pricing by quantity
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
	 * country
	 *
	 * @var \Ecom\EcomToolbox\Domain\Model\Region
	 */
	protected $country = NULL;

	/**
	 * state
	 *
	 * @var \Ecom\EcomToolbox\Domain\Model\State
	 */
	protected $state = NULL;

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
	 * Returns the salutation
	 *
	 * @return string $salutation
	 */
	public function getSalutation() {
		return $this->salutation;
	}

	/**
	 * Sets the salutation
	 *
	 * @param string $salutation
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setSalutation($salutation) {
		$this->salutation = $salutation;
		return $this;
	}

	/**
	 * Returns the firstName
	 *
	 * @return string $firstName
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the firstName
	 *
	 * @param string $firstName
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
		return $this;
	}

	/**
	 * Returns the lastName
	 *
	 * @return string $lastName
	 */
	public function getLastName() {
		return $this->lastName;
	}

	/**
	 * Sets the lastName
	 *
	 * @param string $lastName
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
		return $this;
	}

	/**
	 * Returns the subject
	 *
	 * @return string $subject
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Sets the subject
	 *
	 * @param string $subject
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
		return $this;
	}

	/**
	 * Returns the message
	 *
	 * @return string $message
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * Sets the message
	 *
	 * @param string $message
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setMessage($message) {
		$this->message = $message;
		return $this;
	}

	/**
	 * Returns the company
	 *
	 * @return string $company
	 */
	public function getCompany() {
		return $this->company;
	}

	/**
	 * Sets the company
	 *
	 * @param string $company
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setCompany($company) {
		$this->company = $company;
		return $this;
	}

	/**
	 * Returns the jobTitle
	 *
	 * @return string $jobTitle
	 */
	public function getJobTitle() {
		return $this->jobTitle;
	}

	/**
	 * Sets the jobTitle
	 *
	 * @param string $jobTitle
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setJobTitle($jobTitle) {
		$this->jobTitle = $jobTitle;
		return $this;
	}

	/**
	 * Returns the address
	 *
	 * @return string $address
	 */
	public function getAddress() {
		return $this->address;
	}

	/**
	 * Sets the address
	 *
	 * @param string $address
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}

	/**
	 * Returns the postalCode
	 *
	 * @return string $postalCode
	 */
	public function getPostalCode() {
		return $this->postalCode;
	}

	/**
	 * Sets the postalCode
	 *
	 * @param string $postalCode
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setPostalCode($postalCode) {
		$this->postalCode = $postalCode;
		return $this;
	}

	/**
	 * Returns the city
	 *
	 * @return string $city
	 */
	public function getCity() {
		return $this->city;
	}

	/**
	 * Sets the city
	 *
	 * @param string $city
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setCity($city) {
		$this->city = $city;
		return $this;
	}

	/**
	 * Returns the phone
	 *
	 * @return string $phone
	 */
	public function getPhone() {
		return $this->phone;
	}

	/**
	 * Sets the phone
	 *
	 * @param string $phone
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setPhone($phone) {
		$this->phone = $phone;
		return $this;
	}

	/**
	 * Returns the fax
	 *
	 * @return string $fax
	 */
	public function getFax() {
		return $this->fax;
	}

	/**
	 * Sets the fax
	 *
	 * @param string $fax
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setFax($fax) {
		$this->fax = $fax;
		return $this;
	}

	/**
	 * Returns the email
	 *
	 * @return string $email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * Sets the email
	 *
	 * @param string $email
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setEmail($email) {
		$this->email = $email;
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
	 * Returns the quantity
	 *
	 * @return int $quantity
	 */
	public function getQuantity() {
		return $this->quantity;
	}

	/**
	 * Sets the quantity
	 *
	 * @param int $quantity
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
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
	 * @param int $parts
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
	 * Returns the country
	 *
	 * @return \Ecom\EcomToolbox\Domain\Model\Region $country
	 */
	public function getCountry() {
		return $this->country;
	}

	/**
	 * Sets the country
	 *
	 * @param \Ecom\EcomToolbox\Domain\Model\Region $country
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setCountry(\Ecom\EcomToolbox\Domain\Model\Region $country = NULL) {
		$this->country = $country;
		return $this;
	}

	/**
	 * Returns the state
	 *
	 * @return \Ecom\EcomToolbox\Domain\Model\State $state
	 */
	public function getState() {
		return $this->state;
	}

	/**
	 * Sets the state
	 *
	 * @param \Ecom\EcomToolbox\Domain\Model\State $state
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Log Allow chaining of methods
	 */
	public function setState(\Ecom\EcomToolbox\Domain\Model\State $state = NULL) {
		$this->state = $state;
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
	public function setFeUser(\TYPO3\CMS\Extbase\Domain\Model\FrontendUser $feUser = NULL) {
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
	public function setConfiguredParts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $configuredParts = NULL) {
		$this->configuredParts = $configuredParts;
		return $this;
	}

}