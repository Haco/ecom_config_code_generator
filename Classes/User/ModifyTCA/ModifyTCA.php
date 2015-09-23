<?php

namespace S3b0\EcomConfigCodeGenerator\User\ModifyTCA;

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
use TYPO3\CMS\Backend\Utility as BackendUtility;
use TYPO3\CMS\Core\Utility as CoreUtility;

/**
 * Class ModifyTCA
 * @package S3b0\EcomConfigCodeGenerator\User\ModifyTCA
 */
class ModifyTCA extends \TYPO3\CMS\Backend\Form\FormEngine {

	/**
	 * userFuncEcomConfigCodeGeneratorCurrencySettings function.
	 *
	 * @param array                              $PA
	 * @param \TYPO3\CMS\Backend\Form\FormEngine $pObj
	 *
	 * @return string
	 */
	public function userFuncEcomConfigCodeGeneratorCurrencySettings(array &$PA, \TYPO3\CMS\Backend\Form\FormEngine $pObj = NULL) {
		$table = 'tx_ecomconfigcodegenerator_domain_model_currency';
		$addWhere = \TYPO3\CMS\Core\Utility\MathUtility::canBeInterpretedAsInteger($PA['row']['uid']) ? " AND NOT $table.uid=" . $PA['row']['uid'] : "";
		if ( $rows = $pObj->getDatabaseConnection()->exec_SELECTgetRows("*", $table, "$table.settings & " . \S3b0\EcomConfigCodeGenerator\Setup::BIT_CURRENCY_IS_DEFAULT . $addWhere . BackendUtility\BackendUtility::BEenableFields($table)) ) {
			/** @var \Ecom\EcomToolbox\Utility\BitHandler $bitwiseFlag */
			$bitwiseFlag = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\Ecom\EcomToolbox\Utility\BitHandler::class);
			$bitwiseFlag->setBits($PA['row']['settings']);
			$isCurrentMarkedAsDefault = $bitwiseFlag->isBitSet(\S3b0\EcomConfigCodeGenerator\Setup::BIT_CURRENCY_IS_DEFAULT);

			if ( $isCurrentMarkedAsDefault ) {
				foreach ( $rows as $row ) {
					$bitwiseFlag->reset()->setBits($row['settings']);
					if ( !$bitwiseFlag->isBitSet(\S3b0\EcomConfigCodeGenerator\Setup::BIT_CURRENCY_IS_DEFAULT) ) {
						continue;
					}
					$bitwiseFlag->unsetSingleBit(\S3b0\EcomConfigCodeGenerator\Setup::BIT_CURRENCY_IS_DEFAULT);
					$pObj->getDatabaseConnection()->exec_UPDATEquery(
						$table,
						"$table.uid=" . $row['uid'],
						[ 'settings' => $bitwiseFlag->getBits() ]
					);
				}
			} elseif ( count($rows) > 1 ) {
				$defaultFlagSet = FALSE;
				foreach ( $rows as $row ) {
					$bitwiseFlag->reset();
					$bitwiseFlag->setBits($row['settings']);
					if ( !$bitwiseFlag->isBitSet(\S3b0\EcomConfigCodeGenerator\Setup::BIT_CURRENCY_IS_DEFAULT) ) {
						continue;
					}
					if ( !$defaultFlagSet && $bitwiseFlag->isBitSet(\S3b0\EcomConfigCodeGenerator\Setup::BIT_CURRENCY_IS_DEFAULT) ) {
						$defaultFlagSet = TRUE;
						continue;
					}
					$bitwiseFlag->unsetSingleBit(\S3b0\EcomConfigCodeGenerator\Setup::BIT_CURRENCY_IS_DEFAULT);
					$pObj->getDatabaseConnection()->exec_UPDATEquery(
						$table,
						"$table.uid=" . $row['uid'],
						[ 'settings' => $bitwiseFlag->getBits() ]
					);
				}
			}
			$PA['fieldConf']['config']['items'][(int) log(\S3b0\EcomConfigCodeGenerator\Setup::BIT_CURRENCY_IS_DEFAULT, 2)][0] = '!!! FLAG ALREADY SET !!! This will cause a break in plugin functionality! Save twice to set flag at current record!';
		}

		// Disable for non-admins
		$PA['fieldConf']['config']['readOnly'] = !$pObj->getBackendUserAuthentication()->isAdmin();
		// Re-render field based on the "true field type", and not as a "user"
		$PA['fieldConf']['config']['form_type'] = $PA['fieldConf']['config']['type'];
		return $pObj->getSingleField_SW($PA['table'], $PA['field'], $PA['row'], $PA);
	}

	/**
	 * itemsProcFuncEcomConfigCodeGeneratorDomainModelDependencyParts function.
	 *
	 * @param array                                    $PA
	 * @param \TYPO3\CMS\Backend\Form\DataPreprocessor $pObj
	 *
	 * @return void
	 */
	public function itemsProcFuncEcomConfigCodeGeneratorDomainModelDependencyParts(array &$PA, $pObj = NULL)  {
		// Adding an item!
		//$PA['items'][] = array($pObj->sL('Added label by PHP function|Tilfjet Dansk tekst med PHP funktion'), 999);

		if ( sizeof($PA['items']) && $PA['row']['part_groups'] ) {
			$partGroupsCollection = [ ];
			$referringPart = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_part', $PA['row']['part'], 'pid,part_group');

			/** @var \TYPO3\CMS\Core\Database\DatabaseConnection $db */
			$db = $GLOBALS['TYPO3_DB'];
			$partGroups = [ ];
			$result = $db->exec_SELECTquery('uid_foreign', 'tx_ecomconfigcodegenerator_dependency_partgroup_mm', "uid_local={$PA['row']['uid']}");
			while ( $row = $db->sql_fetch_assoc($result) ) {
				$partGroups[] = $row['uid_foreign'];
			}
			$db->sql_free_result($result);

			foreach ( $PA['items'] as $item ) {
				$data = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_part', $item[1], '*');
				if ( !sizeof($data) || $data['pid'] !== $referringPart['pid'] || !CoreUtility\GeneralUtility::inList(implode(',', $partGroups), $data['part_group']) ) {
					continue;
				}

				$item[2] = 'clear.gif';
				$partGroupsCollection[0]['div'] = '-- not assigned --';
				if ( CoreUtility\MathUtility::canBeInterpretedAsInteger($data['part_group']) ) {
					if ( !array_key_exists($data['part_group'], $partGroupsCollection) ) {
						$partGroup = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_partgroup', $data['part_group'], 'title');
						$partGroupsCollection[$data['part_group']]['div'] = $partGroup['title'];
					}
					$partGroupsCollection[$data['part_group']]['items'][] = $item;
				} else {
					$partGroupsCollection[0]['items'][] = $item;
				}

			}
			//usort($configurationPackages, 'self::cmp'); // Sort Alphabetically @package label
			ksort($partGroupsCollection); // Order by uid @package

			$PA['items'] = [ ];
			foreach ( $partGroupsCollection as $partGroup ) {
				if ( !is_array($partGroup['items']) ) {
					continue;
				}
				$PA['items'][] = [
					$partGroup['div'],
					'--div--'
				];
				$PA['items'] = array_merge($PA['items'], $partGroup['items']);
			}
		} elseif ( !$PA['row']['part_groups'] ) {
			$PA['items'] = [ ];
		}

		// No return - the $PA and $pObj variables are passed by reference, so just change content in then and it is passed back automatically...
	}

	/**
	 * itemsProcFuncEcomConfigCodeGeneratorDomainModelDependentNoteDependentParts function.
	 *
	 * @param array                                    $PA
	 * @param \TYPO3\CMS\Backend\Form\DataPreprocessor $pObj
	 *
	 * @return void
	 */
	public function itemsProcFuncEcomConfigCodeGeneratorDomainModelDependentNoteDependentParts(array &$PA, $pObj = NULL)  {
		// Adding an item!
		//$PA['items'][] = array($pObj->sL('Added label by PHP function|Tilfjet Dansk tekst med PHP funktion'), 999);

		if ( sizeof($PA['items']) ) {
			$partGroupsCollection = [ ];

			/** @var \TYPO3\CMS\Core\Database\DatabaseConnection $db */
			$db = $GLOBALS['TYPO3_DB'];
			$partGroups = [ ];
			$result = $db->exec_SELECTquery('uid', 'tx_ecomconfigcodegenerator_domain_model_partgroup', "pid={$PA['row']['pid']}");
			while ( $row = $db->sql_fetch_assoc($result) ) {
				$partGroups[] = $row['uid'];
			}
			$db->sql_free_result($result);

			foreach ( $PA['items'] as $item ) {
				$data = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_part', $item[1], '*');
				if ( !sizeof($data) || !CoreUtility\GeneralUtility::inList(implode(',', $partGroups), $data['part_group']) ) {
					continue;
				}

				$item[2] = 'clear.gif';
				$partGroupsCollection[0]['div'] = '-- not assigned --';
				if ( CoreUtility\MathUtility::canBeInterpretedAsInteger($data['part_group']) ) {
					if ( !array_key_exists($data['part_group'], $partGroupsCollection) ) {
						$partGroup = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_partgroup', $data['part_group'], 'title');
						$partGroupsCollection[$data['part_group']]['div'] = $partGroup['title'];
					}
					$partGroupsCollection[$data['part_group']]['items'][] = $item;
				} else {
					$partGroupsCollection[0]['items'][] = $item;
				}

			}
			//usort($configurationPackages, 'self::cmp'); // Sort Alphabetically @package label
			ksort($partGroupsCollection); // Order by uid @package

			$PA['items'] = [ ];
			foreach ( $partGroupsCollection as $partGroup ) {
				if ( !is_array($partGroup['items']) ) {
					continue;
				}
				$PA['items'][] = [
					$partGroup['div'],
					'--div--'
				];
				$PA['items'] = array_merge($PA['items'], $partGroup['items']);
			}
		} elseif ( !$PA['row']['part_groups'] ) {
			$PA['items'] = [ ];
		}

		// No return - the $PA and $pObj variables are passed by reference, so just change content in then and it is passed back automatically...
	}

}

?>