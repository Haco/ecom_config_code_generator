<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$translate = 'LLL:EXT:ecom_config_code_generator/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl'      => [
        'adminOnly'              => true,
        'title'                  => "{$translate}tx_ecomconfigcodegenerator_domain_model_dependency",
        'label'                  => 'mode',
        'label_alt'              => 'part',
        'label_alt_force'        => true,
        'tstamp'                 => 'tstamp',
        'crdate'                 => 'crdate',
        'cruser_id'              => 'cruser_id',
        'dividers2tabs'          => true,
        'versioningWS'           => 2,
        'versioning_followPages' => true,
        'delete'                 => 'deleted',
        'requestUpdate'          => 'mode',
        'typeicon_column'        => 'mode',
        'typeicon_classes'       => [
            'default' => 'extensions-ecom_config_code_generator-dependency-default',
            '1'       => 'extensions-ecom_config_code_generator-dependency-allow',
            '0'       => 'extensions-ecom_config_code_generator-dependency-deny'
        ],
        'enablecolumns'          => [
            'disabled' => 'hidden'
        ],
        'searchFields'           => 'mode,part_groups,parts,',
        'iconfile'               => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ecom_config_code_generator') . 'Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_dependency.png'
    ],
    'interface' => [
        'showRecordFieldList'  => 'hidden, mode, part_groups, parts',
        'maxSingleDBListItems' => 30
    ],
    'types'     => [
        '1' => ['showitem' => 'hidden;;1;;1-1-1, mode, part_groups, parts, part']
    ],
    'palettes'  => [
        '1' => ['showitem' => '']
    ],
    'columns'   => [

        't3ver_label' => [
            'label'  => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max'  => 255
            ]
        ],

        'hidden' => [
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config'  => [
                'type' => 'check'
            ]
        ],

        'mode'        => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_dependency.mode",
            'config'  => [
                'type'     => 'select',
                'items'    => [
                    ["{$translate}select.empty", ''],
                    ["{$translate}tx_ecomconfigcodegenerator_domain_model_dependency.mode.allow", 1],
                    ["{$translate}tx_ecomconfigcodegenerator_domain_model_dependency.mode.deny", 0]
                ],
                'size'     => 1,
                'minitems' => 1,
                'maxitems' => 1
            ]
        ],
        'part_groups' => [
            'displayCond' => 'REC:NEW:false',
            'exclude'     => 0,
            'label'       => "{$translate}tx_ecomconfigcodegenerator_domain_model_dependency.part_groups",
            'config'      => [
                'type'                => 'select',
                'foreign_table'       => 'tx_ecomconfigcodegenerator_domain_model_partgroup',
                'foreign_table_where' => ('
					AND tx_ecomconfigcodegenerator_domain_model_partgroup.pid=###CURRENT_PID###
					AND NOT tx_ecomconfigcodegenerator_domain_model_partgroup.deleted
					AND tx_ecomconfigcodegenerator_domain_model_partgroup.sys_language_uid IN(-1,0)
					AND tx_ecomconfigcodegenerator_domain_model_partgroup.sorting < (
						SELECT sorting FROM tx_ecomconfigcodegenerator_domain_model_partgroup WHERE uid=(
							SELECT part_group FROM tx_ecomconfigcodegenerator_domain_model_part WHERE uid=###REC_FIELD_part###
						)
					)
					AND tx_ecomconfigcodegenerator_domain_model_partgroup.settings & 1 = 1
				'),
                'MM'                  => 'tx_ecomconfigcodegenerator_dependency_partgroup_mm',
                'size'                => 10,
                'autoSizeMax'         => 30,
                'maxitems'            => 9999,
                'multiple'            => 0,
                'renderType'          => 'selectCheckBox'
            ]
        ],
        'parts'       => [
            'displayCond' => [
                'AND' => [
                    'REC:NEW:false',
                    'FIELD:part_groups:REQ:true'
                ]
            ],
            'exclude'     => 0,
            'label'       => "{$translate}tx_ecomconfigcodegenerator_domain_model_dependency.parts",
            'config'      => [
                'type'                => 'select',
                'foreign_table'       => 'tx_ecomconfigcodegenerator_domain_model_part',
                'foreign_table_where' => ('
					AND tx_ecomconfigcodegenerator_domain_model_part.pid=###CURRENT_PID###
					AND NOT tx_ecomconfigcodegenerator_domain_model_part.deleted
					AND tx_ecomconfigcodegenerator_domain_model_part.sys_language_uid IN (-1,0)
					AND tx_ecomconfigcodegenerator_domain_model_part.part_group IN (
						SELECT tx_ecomconfigcodegenerator_dependency_partgroup_mm.uid_foreign FROM tx_ecomconfigcodegenerator_dependency_partgroup_mm WHERE tx_ecomconfigcodegenerator_dependency_partgroup_mm.uid_local=###THIS_UID### ORDER BY tx_ecomconfigcodegenerator_dependency_partgroup_mm.sorting
					) ORDER BY tx_ecomconfigcodegenerator_domain_model_part.part_group, tx_ecomconfigcodegenerator_domain_model_part.title
				'),
                'MM'                  => 'tx_ecomconfigcodegenerator_dependency_part_mm',
                'itemsProcFunc'       => \S3b0\EcomConfigCodeGenerator\User\ModifyTCA\ModifyTCA::class . '->itemsProcFuncEcomConfigCodeGeneratorDomainModelDependencyParts',
                'size'                => 10,
                'autoSizeMax'         => 30,
                'maxitems'            => 9999,
                'multiple'            => 0,
                'renderType'          => 'selectSingleBox'
            ]
        ],
        'part'        => [
            'label'  => "{$translate}tx_ecomconfigcodegenerator_domain_model_part",
            'config' => [
                'type'          => 'select',
                'readOnly'      => 1,
                'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_part'
            ]
        ]

    ]
];
