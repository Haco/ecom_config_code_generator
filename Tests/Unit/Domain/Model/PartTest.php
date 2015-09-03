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
 * Test case for class \S3b0\EcomConfigCodeGenerator\Domain\Model\Part.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class PartTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part();
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
	public function getCodeSegmentReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getCodeSegment()
		);
	}

	/**
	 * @test
	 */
	public function setCodeSegmentForStringSetsCodeSegment() {
		$this->subject->setCodeSegment('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'codeSegment',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getImageReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getImage()
		);
	}

	/**
	 * @test
	 */
	public function setImageForFileReferenceSetsImage() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setImage($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'image',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getHintReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getHint()
		);
	}

	/**
	 * @test
	 */
	public function setHintForStringSetsHint() {
		$this->subject->setHint('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'hint',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDependencyReturnsInitialValueForDependency() {
		$this->assertEquals(
			NULL,
			$this->subject->getDependency()
		);
	}

	/**
	 * @test
	 */
	public function setDependencyForDependencySetsDependency() {
		$dependencyFixture = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency();
		$this->subject->setDependency($dependencyFixture);

		$this->assertAttributeEquals(
			$dependencyFixture,
			'dependency',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPricingReturnsInitialValueForPrice() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getPricing()
		);
	}

	/**
	 * @test
	 */
	public function setPricingForObjectStorageContainingPriceSetsPricing() {
		$pricing = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Price();
		$objectStorageHoldingExactlyOnePricing = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOnePricing->attach($pricing);
		$this->subject->setPricing($objectStorageHoldingExactlyOnePricing);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOnePricing,
			'pricing',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPricingToObjectStorageHoldingPricing() {
		$pricing = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Price();
		$pricingObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$pricingObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($pricing));
		$this->inject($this->subject, 'pricing', $pricingObjectStorageMock);

		$this->subject->addPricing($pricing);
	}

	/**
	 * @test
	 */
	public function removePricingFromObjectStorageHoldingPricing() {
		$pricing = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Price();
		$pricingObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$pricingObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($pricing));
		$this->inject($this->subject, 'pricing', $pricingObjectStorageMock);

		$this->subject->removePricing($pricing);

	}
}
