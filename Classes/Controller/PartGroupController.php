<?php
namespace S3b0\EcomConfigCodeGenerator\Controller;


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
 * PartGroupController
 */
class PartGroupController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * partGroupRepository
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\PartGroupRepository
	 * @inject
	 */
	protected $partGroupRepository = NULL;

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$partGroups = $this->partGroupRepository->findAll();
		$this->view->assign('partGroups', $partGroups);
	}

	/**
	 * action show
	 *
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
	 * @return void
	 */
	public function showAction(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup) {
		$this->view->assign('partGroup', $partGroup);
	}

}