<?php

namespace S3b0\EcomConfigCodeGenerator\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>, ecom instruments GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \S3b0\EcomConfigCodeGenerator\Domain\Model\Log.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class LogTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Log
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Log();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getSessionIdReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSessionId()
		);
	}

	/**
	 * @test
	 */
	public function setSessionIdForStringSetsSessionId() {
		$this->subject->setSessionId('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'sessionId',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getConfigurationReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getConfiguration()
		);
	}

	/**
	 * @test
	 */
	public function setConfigurationForStringSetsConfiguration() {
		$this->subject->setConfiguration('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'configuration',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPricingReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPricing()
		);
	}

	/**
	 * @test
	 */
	public function setPricingForStringSetsPricing() {
		$this->subject->setPricing('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'pricing',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIpAddressReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getIpAddress()
		);
	}

	/**
	 * @test
	 */
	public function setIpAddressForStringSetsIpAddress() {
		$this->subject->setIpAddress('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'ipAddress',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFeUserReturnsInitialValueForFrontendUser() {	}

	/**
	 * @test
	 */
	public function setFeUserForFrontendUserSetsFeUser() {	}
}
