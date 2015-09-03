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
 * Test case for class \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class DependentNoteTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getNoteReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getNote()
		);
	}

	/**
	 * @test
	 */
	public function setNoteForStringSetsNote() {
		$this->subject->setNote('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'note',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUseLogicalAndReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getUseLogicalAnd()
		);
	}

	/**
	 * @test
	 */
	public function setUseLogicalAndForBooleanSetsUseLogicalAnd() {
		$this->subject->setUseLogicalAnd(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'useLogicalAnd',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDependentPartsReturnsInitialValueForPart() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getDependentParts()
		);
	}

	/**
	 * @test
	 */
	public function setDependentPartsForObjectStorageContainingPartSetsDependentParts() {
		$dependentPart = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part();
		$objectStorageHoldingExactlyOneDependentParts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneDependentParts->attach($dependentPart);
		$this->subject->setDependentParts($objectStorageHoldingExactlyOneDependentParts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneDependentParts,
			'dependentParts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addDependentPartToObjectStorageHoldingDependentParts() {
		$dependentPart = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part();
		$dependentPartsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$dependentPartsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($dependentPart));
		$this->inject($this->subject, 'dependentParts', $dependentPartsObjectStorageMock);

		$this->subject->addDependentPart($dependentPart);
	}

	/**
	 * @test
	 */
	public function removeDependentPartFromObjectStorageHoldingDependentParts() {
		$dependentPart = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part();
		$dependentPartsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$dependentPartsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($dependentPart));
		$this->inject($this->subject, 'dependentParts', $dependentPartsObjectStorageMock);

		$this->subject->removeDependentPart($dependentPart);

	}
}
