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
 * Test case for class \S3b0\EcomConfigCodeGenerator\Domain\Model\Price.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class PriceTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Price
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Price();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getValueReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getValue()
		);
	}

	/**
	 * @test
	 */
	public function setValueForFloatSetsValue() {
		$this->subject->setValue(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'value',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getCurrencyReturnsInitialValueForCurrency() {
		$this->assertEquals(
			NULL,
			$this->subject->getCurrency()
		);
	}

	/**
	 * @test
	 */
	public function setCurrencyForCurrencySetsCurrency() {
		$currencyFixture = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency();
		$this->subject->setCurrency($currencyFixture);

		$this->assertAttributeEquals(
			$currencyFixture,
			'currency',
			$this->subject
		);
	}
}
