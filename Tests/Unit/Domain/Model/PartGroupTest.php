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
 * Test case for class \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class PartGroupTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup();
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
	public function getIconReturnsInitialValueForFileReference() {
		$this->assertEquals(
			NULL,
			$this->subject->getIcon()
		);
	}

	/**
	 * @test
	 */
	public function setIconForFileReferenceSetsIcon() {
		$fileReferenceFixture = new \TYPO3\CMS\Extbase\Domain\Model\FileReference();
		$this->subject->setIcon($fileReferenceFixture);

		$this->assertAttributeEquals(
			$fileReferenceFixture,
			'icon',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPlaceInCodeReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getPlaceInCode()
		);
	}

	/**
	 * @test
	 */
	public function setPlaceInCodeForIntegerSetsPlaceInCode() {
		$this->subject->setPlaceInCode(12);

		$this->assertAttributeEquals(
			12,
			'placeInCode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPromptReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getPrompt()
		);
	}

	/**
	 * @test
	 */
	public function setPromptForStringSetsPrompt() {
		$this->subject->setPrompt('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'prompt',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSettingsReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getSettings()
		);
	}

	/**
	 * @test
	 */
	public function setSettingsForIntegerSetsSettings() {
		$this->subject->setSettings(12);

		$this->assertAttributeEquals(
			12,
			'settings',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPartsReturnsInitialValueForPart() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getParts()
		);
	}

	/**
	 * @test
	 */
	public function setPartsForObjectStorageContainingPartSetsParts() {
		$part = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part();
		$objectStorageHoldingExactlyOneParts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneParts->attach($part);
		$this->subject->setParts($objectStorageHoldingExactlyOneParts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneParts,
			'parts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPartToObjectStorageHoldingParts() {
		$part = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part();
		$partsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$partsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($part));
		$this->inject($this->subject, 'parts', $partsObjectStorageMock);

		$this->subject->addPart($part);
	}

	/**
	 * @test
	 */
	public function removePartFromObjectStorageHoldingParts() {
		$part = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part();
		$partsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$partsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($part));
		$this->inject($this->subject, 'parts', $partsObjectStorageMock);

		$this->subject->removePart($part);

	}

	/**
	 * @test
	 */
	public function getDefaultPartReturnsInitialValueForPart() {
		$this->assertEquals(
			NULL,
			$this->subject->getDefaultPart()
		);
	}

	/**
	 * @test
	 */
	public function setDefaultPartForPartSetsDefaultPart() {
		$defaultPartFixture = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part();
		$this->subject->setDefaultPart($defaultPartFixture);

		$this->assertAttributeEquals(
			$defaultPartFixture,
			'defaultPart',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getDependentNoteReturnsInitialValueForDependentNote() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getDependentNote()
		);
	}

	/**
	 * @test
	 */
	public function setDependentNoteForObjectStorageContainingDependentNoteSetsDependentNote() {
		$dependentNote = new \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote();
		$objectStorageHoldingExactlyOneDependentNote = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneDependentNote->attach($dependentNote);
		$this->subject->setDependentNote($objectStorageHoldingExactlyOneDependentNote);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneDependentNote,
			'dependentNote',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addDependentNoteToObjectStorageHoldingDependentNote() {
		$dependentNote = new \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote();
		$dependentNoteObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$dependentNoteObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($dependentNote));
		$this->inject($this->subject, 'dependentNote', $dependentNoteObjectStorageMock);

		$this->subject->addDependentNote($dependentNote);
	}

	/**
	 * @test
	 */
	public function removeDependentNoteFromObjectStorageHoldingDependentNote() {
		$dependentNote = new \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote();
		$dependentNoteObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$dependentNoteObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($dependentNote));
		$this->inject($this->subject, 'dependentNote', $dependentNoteObjectStorageMock);

		$this->subject->removeDependentNote($dependentNote);

	}
}
