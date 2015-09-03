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
 * Test case for class \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class CurrencyTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getIsoCodeReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getIsoCode()
		);
	}

	/**
	 * @test
	 */
	public function setIsoCodeForStringSetsIsoCode() {
		$this->subject->setIsoCode('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'isoCode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getExchangeReturnsInitialValueForFloat() {
		$this->assertSame(
			0.0,
			$this->subject->getExchange()
		);
	}

	/**
	 * @test
	 */
	public function setExchangeForFloatSetsExchange() {
		$this->subject->setExchange(3.14159265);

		$this->assertAttributeEquals(
			3.14159265,
			'exchange',
			$this->subject,
			'',
			0.000000001
		);
	}

	/**
	 * @test
	 */
	public function getSymbolReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSymbol()
		);
	}

	/**
	 * @test
	 */
	public function setSymbolForStringSetsSymbol() {
		$this->subject->setSymbol('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'symbol',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getRegionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getRegion()
		);
	}

	/**
	 * @test
	 */
	public function setRegionForStringSetsRegion() {
		$this->subject->setRegion('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'region',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getLlReferenceReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getLlReference()
		);
	}

	/**
	 * @test
	 */
	public function setLlReferenceForStringSetsLlReference() {
		$this->subject->setLlReference('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'llReference',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getFlagReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getFlag()
		);
	}

	/**
	 * @test
	 */
	public function setFlagForFileReferenceSetsFlag() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setFlag($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'flag',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSettingsReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getSettings()
		);
	}

	/**
	 * @test
	 */
	public function setSettingsForBooleanSetsSettings() {
		$this->subject->setSettings(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'settings',
			$this->subject
		);
	}
}
