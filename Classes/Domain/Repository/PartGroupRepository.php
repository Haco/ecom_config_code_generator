<?php
namespace S3b0\EcomConfigCodeGenerator\Domain\Repository;


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
 * The repository for PartGroups
 */
class PartGroupRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
	 * @var array
	 */
	protected $defaultOrderings = [
		'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	];

	/**
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration $configuration
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	public function findByConfiguration(\S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration $configuration) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->getQuerySettings()->setRespectSysLanguage(FALSE);

		return $this->fillOjectStorageFromQueryResult($query->matching($query->equals('configuration', $configuration))->execute());
	}

	/**
	 * Fill objectStorage from QueryResult
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $queryResult
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	protected function fillOjectStorageFromQueryResult(\TYPO3\CMS\Extbase\Persistence\QueryResultInterface $queryResult = NULL) {
		/* @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage $objectStorage */
		$objectStorage = $this->objectManager->get('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage');

		if ( $queryResult !== NULL ) {
			foreach ( $queryResult as $object ) {
				$objectStorage->attach($object);
			}
		}

		return $objectStorage;
	}

}