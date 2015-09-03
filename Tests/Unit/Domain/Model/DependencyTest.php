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
 * Test case for class \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>
 */
class DependencyTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getModeReturnsInitialValueForInteger() {
		$this->assertSame(
			0,
			$this->subject->getMode()
		);
	}

	/**
	 * @test
	 */
	public function setModeForIntegerSetsMode() {
		$this->subject->setMode(12);

		$this->assertAttributeEquals(
			12,
			'mode',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPartGroupsReturnsInitialValueForPartGroup() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getPartGroups()
		);
	}

	/**
	 * @test
	 */
	public function setPartGroupsForObjectStorageContainingPartGroupSetsPartGroups() {
		$partGroup = new \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup();
		$objectStorageHoldingExactlyOnePartGroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOnePartGroups->attach($partGroup);
		$this->subject->setPartGroups($objectStorageHoldingExactlyOnePartGroups);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOnePartGroups,
			'partGroups',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPartGroupToObjectStorageHoldingPartGroups() {
		$partGroup = new \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup();
		$partGroupsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$partGroupsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($partGroup));
		$this->inject($this->subject, 'partGroups', $partGroupsObjectStorageMock);

		$this->subject->addPartGroup($partGroup);
	}

	/**
	 * @test
	 */
	public function removePartGroupFromObjectStorageHoldingPartGroups() {
		$partGroup = new \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup();
		$partGroupsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$partGroupsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($partGroup));
		$this->inject($this->subject, 'partGroups', $partGroupsObjectStorageMock);

		$this->subject->removePartGroup($partGroup);

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
}
