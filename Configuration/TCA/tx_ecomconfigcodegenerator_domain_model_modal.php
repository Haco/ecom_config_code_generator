<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$translate = 'LLL:EXT:ecom_config_code_generator/Resources/Private/Language/locallang_db.xlf:';

return [
    'ctrl'      => [
        'adminOnly'                => true,
        'title'                    => "{$translate}tx_ecomconfigcodegenerator_domain_model_modal",
        'label'                    => 'title',
        'tstamp'                   => 'tstamp',
        'crdate'                   => 'crdate',
        'cruser_id'                => 'cruser_id',
        'dividers2tabs'            => true,
        'versioningWS'             => 2,
        'versioning_followPages'   => true,
        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete'                   => 'deleted',
        'hideTable'                => true,
        'enablecolumns'            => [
            'disabled' => 'hidden'
        ],
        'searchFields'             => 'title,text,trigger_part,dependent_parts',
        'iconfile'                 => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ecom_config_code_generator') . 'Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_modal.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, text, trigger_part, dependent_parts',
    ],
    'types'     => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, text;;2;wizards[t3editorHtml]']
    ],
    'palettes'  => [
        '1' => ['showitem' => ''],
        '2' => ['showitem' => 'dependent_parts, --linebreak--, trigger_part, part_group', 'canNotCollapse' => true]
    ],
    'columns'   => [

        'sys_language_uid' => [
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
            'config'  => [
                'type'                => 'select',
                'foreign_table'       => 'sys_language',
                'foreign_table_where' => 'ORDER BY sys_language.title',
                'items'               => [
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1],
                    ['LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0]
                ]
            ]
        ],
        'l10n_parent'      => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'exclude'     => 1,
            'label'       => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
            'config'      => [
                'type'                => 'select',
                'items'               => [
                    ['', 0]
                ],
                'foreign_table'       => 'tx_ecomconfigcodegenerator_domain_model_modal',
                'foreign_table_where' => 'AND tx_ecomconfigcodegenerator_domain_model_modal.pid=###CURRENT_PID### AND tx_ecomconfigcodegenerator_domain_model_modal.sys_language_uid IN (-1,0)',
                'suppress_icons'      => 1
            ]
        ],
        'l10n_diffsource'  => [
            'config' => [
                'type' => 'passthrough'
            ]
        ],

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

        'title'           => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude'   => 0,
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_modal.title",
            'config'    => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'text'            => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude'   => 0,
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_modal.text",
            'config'    => [
                'type'    => 'text',
                'cols'    => 100,
                'rows'    => 10,
                'eval'    => 'trim,required',
                'wizards' => [
                    't3editorHtml' => [
                        'enableByTypeConfig' => 1,
                        'type'               => 'userFunc',
                        'userFunc'           => 'TYPO3\\CMS\\T3editor\\FormWizard->main',
                        'params'             => [
                            'format' => 'html'
                        ]
                    ]
                ]
            ]
        ],
        'dependent_parts' => [
            'l10n_mode' => 'exclude',
            'exclude'   => 1,
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_modal.dependent_parts",
            'config'    => [
                'type'                          => 'select',
                'foreign_table'                 => 'tx_ecomconfigcodegenerator_domain_model_part',
                'foreign_table_where'           => ('
					AND tx_ecomconfigcodegenerator_domain_model_part.pid=###CURRENT_PID###
					AND NOT tx_ecomconfigcodegenerator_domain_model_part.deleted
					AND tx_ecomconfigcodegenerator_domain_model_part.sys_language_uid IN (-1,0)
					AND ( SELECT sorting FROM tx_ecomconfigcodegenerator_domain_model_partgroup WHERE tx_ecomconfigcodegenerator_domain_model_partgroup.uid=tx_ecomconfigcodegenerator_domain_model_part.part_group ) < ( SELECT sorting FROM tx_ecomconfigcodegenerator_domain_model_partgroup WHERE tx_ecomconfigcodegenerator_domain_model_partgroup.uid=###REC_FIELD_part_group### )
					AND ( SELECT settings FROM tx_ecomconfigcodegenerator_domain_model_partgroup WHERE tx_ecomconfigcodegenerator_domain_model_partgroup.uid=tx_ecomconfigcodegenerator_domain_model_part.part_group ) & ' . \S3b0\EcomConfigCodeGenerator\Setup::BIT_PARTGROUP_IS_LOCKED . ' = ' . \S3b0\EcomConfigCodeGenerator\Setup::BIT_PARTGROUP_IS_LOCKED . '
					ORDER BY tx_ecomconfigcodegenerator_domain_model_part.part_group, tx_ecomconfigcodegenerator_domain_model_part.title
				'),
                'MM'                            => 'tx_ecomconfigcodegenerator_modal_part_mm',
                'itemsProcFunc'                 => 'S3b0\\EcomConfigCodeGenerator\\User\\ModifyTCA\\ModifyTCA->itemsProcFuncEcomConfigCodeGeneratorDomainModelDependentNoteDependentParts',
                'size'                          => 10,
                'autoSizeMax'                   => 30,
                'minitems'                      => 1,
                'maxitems'                      => 9999,
                'multiple'                      => 0,
                'renderMode'                    => 'checkbox',
                'disableNoMatchingValueElement' => 1
            ]
        ],
        'trigger_part'    => [
            'l10n_mode' => 'exclude',
            'exclude'   => 1,
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_modal.trigger_part",
            'config'    => [
                'type'                => 'select',
                'foreign_table'       => 'tx_ecomconfigcodegenerator_domain_model_part',
                'foreign_table_where' => 'AND tx_ecomconfigcodegenerator_domain_model_part.pid=###CURRENT_PID### AND NOT tx_ecomconfigcodegenerator_domain_model_part.deleted AND tx_ecomconfigcodegenerator_domain_model_part.sys_language_uid IN (-1,0) AND tx_ecomconfigcodegenerator_domain_model_part.part_group=###REC_FIELD_part_group### ORDER BY tx_ecomconfigcodegenerator_domain_model_part.title',
                'items'               => [
                    ["{$translate}select.empty", '']
                ],
                'minitems'            => 1,
                'maxitems'            => 1,
                'suppress_icons'      => 1
            ]
        ],

        'part_group' => [
            'l10n_mode' => 'exclude',
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup",
            'config'    => [
                'type'          => 'select',
                'readOnly'      => 1,
                'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_partgroup'
            ]
        ]
    ]
];
