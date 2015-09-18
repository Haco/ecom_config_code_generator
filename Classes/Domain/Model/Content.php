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
 * Extending tt_content table
 */
class Content extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var string
	 */
	protected $bodytext = '';

	/**
	 * @var string
	 */
	protected $header = '';

	/**
	 * Link content element to configuration
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration
	 * @lazy
	 */
	protected $ccgConfiguration = NULL;

	/**
	 * @return string
	 */
	public function getBodytext() {
		return $this->bodytext;
	}

	/**
	 * @param string $bodytext
	 */
	public function setBodytext($bodytext) {
		$this->bodytext = $bodytext;
	}

	/**
	 * @return string
	 */
	public function getHeader() {
		return $this->header;
	}

	/**
	 * @param string $header
	 */
	public function setHeader($header) {
		$this->header = $header;
	}

	/**
	 * Returns the ccgConfiguration
	 *
	 * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration $ccgConfiguration
	 */
	public function getCcgConfiguration() {
		return $this->ccgConfiguration;
	}

	/**
	 * Sets the ccgConfiguration
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration $ccgConfiguration
	 * @return void
	 */
	public function setCcgConfiguration(\S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration $ccgConfiguration) {
		$this->ccgConfiguration = $ccgConfiguration;
	}

}