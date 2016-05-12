<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

$translate = 'LLL:EXT:ecom_config_code_generator/Resources/Private/Language/locallang_db.xlf:';

/** @var \TYPO3\CMS\Core\Database\DatabaseConnection $db */
$db = $GLOBALS[ 'TYPO3_DB' ];
$maxItemsPricing = $db->exec_SELECTcountRows('*', 'tx_ecomconfigcodegenerator_domain_model_currency');

return [
    'ctrl'      => [
        'title'                  => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration",
        'label'                  => 'title',
        'tstamp'                 => 'tstamp',
        'crdate'                 => 'crdate',
        'cruser_id'              => 'cruser_id',
        'dividers2tabs'          => true,
        'sortby'                 => 'sorting',
        'versioningWS'           => 2,
        'versioning_followPages' => true,
        'delete'                 => 'deleted',
        'requestUpdate'          => 'pricing_enabled',
        'enablecolumns'          => [
            'disabled'  => 'hidden',
            'starttime' => 'starttime',
            'endtime'   => 'endtime',
        ],
        'searchFields'           => 'title,prefix,suffix,part_groups,pricing_enabled,pricing',
        'iconfile'               => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ecom_config_code_generator') . 'Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_configuration.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'hidden, title, prefix, suffix, part_groups, pricing_enabled, pricing',
    ],
    'types'     => [
        '1' => ['showitem' => "hidden;;1;;1-1-1, title;;2, --div--;{$translate}tabs.referral, part_groups, --div--;{$translate}tabs.pricing, pricing_enabled, pricing, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, --palette--;LLL:EXT:cms/locallang_tca.xlf:pages.palettes.access;access"]
    ],
    'palettes'  => [
        '1'      => [
            'showitem' => ''
        ],
        '2'      => [
            'showitem'       => 'prefix, suffix, --linebreak--, content_object',
            'canNotCollapse' => true
        ],
        'access' => [
            'showitem'       => 'starttime;LLL:EXT:cms/locallang_tca.xlf:pages.starttime_formlabel, endtime;LLL:EXT:cms/locallang_tca.xlf:pages.endtime_formlabel',
            'canNotCollapse' => true
        ]
    ],
    'columns'   => [

        't3ver_label' => [
            'label'  => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max'  => 255,
            ]
        ],

        'hidden'    => [
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config'  => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude'   => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label'     => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config'    => [
                'type'     => 'input',
                'size'     => 13,
                'max'      => 20,
                'eval'     => 'datetime',
                'checkbox' => 0,
                'default'  => 0,
                'range'    => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime'   => [
            'exclude'   => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label'     => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config'    => [
                'type'     => 'input',
                'size'     => 13,
                'max'      => 20,
                'eval'     => 'datetime',
                'checkbox' => 0,
                'default'  => 0,
                'range'    => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],

        'title'           => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration.title",
            'config'  => [
                'type' => 'input',
                'size' => 41,
                'eval' => 'trim,required'
            ]
        ],
        'prefix'          => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration.prefix",
            'config'  => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim'
            ]
        ],
        'suffix'          => [
            'exclude' => 0,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration.suffix",
            'config'  => [
                'type' => 'input',
                'size' => 10,
                'eval' => 'trim'
            ]
        ],
        'part_groups'     => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration.part_groups",
            'config'  => [
                'type'           => 'inline',
                'foreign_table'  => 'tx_ecomconfigcodegenerator_domain_model_partgroup',
                'foreign_field'  => 'configuration',
                'foreign_sortby' => 'sorting',
                'maxitems'       => 9999,
                'appearance'     => [
                    'collapseAll'                     => 1,
                    'newRecordLinkAddTitle'           => 0,
                    'newRecordLinkTitle'              => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration.part_groups.inlineElementAddTitle",
                    'levelLinksPosition'              => 'bottom',
                    'showAllLocalizationLink'         => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showSynchronizationLink'         => 1
                ],
                'behaviour'      => [
                    'localizationMode'                     => 'select',
                    'localizeChildrenAtParentLocalization' => 1,
                    'disableMovingChildrenWithParent'      => 0,
                    'enableCascadingDelete'                => 1
                ]
            ],
        ],
        'pricing_enabled' => [
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration.pricing_enabled",
            'config'  => [
                'type' => 'check'
            ],
        ],
        'pricing'         => [
            'displayCond' => 'FIELD:pricing_enabled:REQ:TRUE',
            'exclude'     => 1,
            'label'       => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration.pricing",
            'config'      => [
                'type'          => 'inline',
                'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_price',
                'foreign_field' => 'configuration',
                'maxitems'      => $maxItemsPricing,
                'appearance'    => [
                    'collapseAll'           => 0,
                    'levelLinksPosition'    => 'bottom',
                    'newRecordLinkAddTitle' => 0,
                    'newRecordLinkTitle'    => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration.pricing.inlineElementAddTitle"
                ],
                'behaviour'     => [
                    'localizationMode'                     => 'keep',
                    'localizeChildrenAtParentLocalization' => 0,
                    'disableMovingChildrenWithParent'      => 0,
                    'enableCascadingDelete'                => 1
                ]
            ]
        ],

        'content_object' => [
            'label'  => "{$translate}tx_ecomconfigcodegenerator_domain_model_content",
            'config' => [
                'type'           => 'select',
                'readOnly'       => 1,
                'foreign_table'  => 'tt_content',
                'foreign_table_where' => 'AND tt_content.pid=###CURRENT_PID###'
            ]
        ]
    ]
];
