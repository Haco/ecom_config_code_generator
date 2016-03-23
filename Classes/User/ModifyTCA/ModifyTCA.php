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
use S3b0\EcomConfigCodeGenerator\Setup;
use TYPO3\CMS\Backend\Utility as BackendUtility;
use TYPO3\CMS\Core\Utility as CoreUtility;

/**
 * Class ModifyTCA
 *
 * @package S3b0\EcomConfigCodeGenerator\User\ModifyTCA
 */
class ModifyTCA
{

    /**
     * itemsProcFuncEcomConfigCodeGeneratorDomainModelDependencyParts function.
     *
     * @param array                                    $PA
     * @param \TYPO3\CMS\Backend\Form\DataPreprocessor $pObj
     *
     * @return void
     */
    public function itemsProcFuncEcomConfigCodeGeneratorDomainModelDependencyParts(array &$PA, $pObj = null)
    {
        // Adding an item!
        //$PA['items'][] = array($pObj->sL('Added label by PHP function|Tilfjet Dansk tekst med PHP funktion'), 999);

        if (sizeof($PA[ 'items' ]) && $PA[ 'row' ][ 'part_groups' ]) {
            $partGroupsCollection = [];
            $referringPart = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_part', $PA[ 'row' ][ 'part' ], 'pid,part_group');

            /** @var \TYPO3\CMS\Core\Database\DatabaseConnection $db */
            $db = $GLOBALS[ 'TYPO3_DB' ];
            $partGroups = [];
            $result = $db->exec_SELECTquery('uid_foreign', 'tx_ecomconfigcodegenerator_dependency_partgroup_mm', "uid_local={$PA['row']['uid']}");
            while ($row = $db->sql_fetch_assoc($result)) {
                $partGroups[] = $row[ 'uid_foreign' ];
            }
            $db->sql_free_result($result);

            foreach ($PA[ 'items' ] as $item) {
                $data = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_part', $item[ 1 ], '*');
                if (!sizeof($data) || $data[ 'pid' ] !== $referringPart[ 'pid' ] || !CoreUtility\GeneralUtility::inList(implode(',', $partGroups), $data[ 'part_group' ])) {
                    continue;
                }

                $item[ 2 ] = 'clear.gif';
                $partGroupsCollection[ 0 ][ 'div' ] = '-- not assigned --';
                if (CoreUtility\MathUtility::canBeInterpretedAsInteger($data[ 'part_group' ])) {
                    if (!array_key_exists($data[ 'part_group' ], $partGroupsCollection)) {
                        $partGroup = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_partgroup', $data[ 'part_group' ], 'title');
                        $partGroupsCollection[ $data[ 'part_group' ] ][ 'div' ] = $partGroup[ 'title' ];
                    }
                    $partGroupsCollection[ $data[ 'part_group' ] ][ 'items' ][] = $item;
                } else {
                    $partGroupsCollection[ 0 ][ 'items' ][] = $item;
                }

            }
            //usort($configurationPackages, 'self::cmp'); // Sort Alphabetically @package label
            ksort($partGroupsCollection); // Order by uid @package

            $PA[ 'items' ] = [];
            foreach ($partGroupsCollection as $partGroup) {
                if (!is_array($partGroup[ 'items' ])) {
                    continue;
                }
                $PA[ 'items' ][] = [
                    $partGroup[ 'div' ],
                    '--div--'
                ];
                $PA[ 'items' ] = array_merge($PA[ 'items' ], $partGroup[ 'items' ]);
            }
        } elseif (!$PA[ 'row' ][ 'part_groups' ]) {
            $PA[ 'items' ] = [];
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
    public function itemsProcFuncEcomConfigCodeGeneratorDomainModelDependentNoteDependentParts(array &$PA, $pObj = null)
    {
        // Adding an item!
        //$PA['items'][] = array($pObj->sL('Added label by PHP function|Tilfjet Dansk tekst med PHP funktion'), 999);

        if (sizeof($PA[ 'items' ])) {
            $partGroupsCollection = [];

            /** @var \TYPO3\CMS\Core\Database\DatabaseConnection $db */
            $db = $GLOBALS[ 'TYPO3_DB' ];
            $partGroups = [];
            $result = $db->exec_SELECTquery('uid', 'tx_ecomconfigcodegenerator_domain_model_partgroup', "pid={$PA['row']['pid']}");
            while ($row = $db->sql_fetch_assoc($result)) {
                $partGroups[] = $row[ 'uid' ];
            }
            $db->sql_free_result($result);

            foreach ($PA[ 'items' ] as $item) {
                $data = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_part', $item[ 1 ], '*');
                if (!sizeof($data) || !CoreUtility\GeneralUtility::inList(implode(',', $partGroups), $data[ 'part_group' ])) {
                    continue;
                }

                $item[ 2 ] = 'clear.gif';
                $partGroupsCollection[ 0 ][ 'div' ] = '-- not assigned --';
                if (CoreUtility\MathUtility::canBeInterpretedAsInteger($data[ 'part_group' ])) {
                    if (!array_key_exists($data[ 'part_group' ], $partGroupsCollection)) {
                        $partGroup = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_partgroup', $data[ 'part_group' ], 'title');
                        $partGroupsCollection[ $data[ 'part_group' ] ][ 'div' ] = $partGroup[ 'title' ];
                    }
                    $partGroupsCollection[ $data[ 'part_group' ] ][ 'items' ][] = $item;
                } else {
                    $partGroupsCollection[ 0 ][ 'items' ][] = $item;
                }

            }
            //usort($configurationPackages, 'self::cmp'); // Sort Alphabetically @package label
            ksort($partGroupsCollection); // Order by uid @package

            $PA[ 'items' ] = [];
            foreach ($partGroupsCollection as $partGroup) {
                if (!is_array($partGroup[ 'items' ])) {
                    continue;
                }
                $PA[ 'items' ][] = [
                    $partGroup[ 'div' ],
                    '--div--'
                ];
                $PA[ 'items' ] = array_merge($PA[ 'items' ], $partGroup[ 'items' ]);
            }
        } elseif (!$PA[ 'row' ][ 'part_groups' ]) {
            $PA[ 'items' ] = [];
        }

        // No return - the $PA and $pObj variables are passed by reference, so just change content in then and it is passed back automatically...
    }

    /**
     * Check if pricing is fixed or percentage
     *
     * @param array $PA
     *
     * @return bool
     */
    public function checkPriceHandling($PA)
    {
        $partGroup = BackendUtility\BackendUtility::getRecord('tx_ecomconfigcodegenerator_domain_model_partgroup', $PA[ 'record' ][ 'part_group' ], 'settings');
        $check = ($partGroup[ 'settings' ] & Setup::BIT_PARTGROUP_USE_PERCENTAGE_PRICING) === Setup::BIT_PARTGROUP_USE_PERCENTAGE_PRICING;

        switch ($PA[ 'conditionParameters' ][ 0 ]) {
            case '1':
                return !$check;
            default:
                return $check;
        }
    }

}

?>