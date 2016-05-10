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
        'adminOnly'              => true,
        'title'                  => "{$translate}tx_ecomconfigcodegenerator_domain_model_part",
        'label'                  => 'title',
        'label_alt'              => 'code_segment',
        'label_alt_force'        => true,
        'label_userFunc'         => 'S3b0\EcomConfigCodeGenerator\User\ModifyTCA\ModifyTCA->getPartAccessoryLabel',
        'tstamp'                 => 'tstamp',
        'crdate'                 => 'crdate',
        'cruser_id'              => 'cruser_id',
        'dividers2tabs'          => true,
        'requestUpdate'          => 'is_empty_part, accessory',
        'default_sortby'         => 'ORDER BY part_group, sorting',
        'versioningWS'           => 2,
        'versioning_followPages' => true,

        'languageField'            => 'sys_language_uid',
        'transOrigPointerField'    => 'l10n_parent',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'delete'                   => 'deleted',
        'enablecolumns'            => [
            'disabled'  => 'hidden',
            'starttime' => 'starttime',
            'endtime'   => 'endtime',
            'fe_group'  => 'fe_group'
        ],
        'searchFields'             => 'title,accessory,code_segment,image,hint,dependency,pricing,pricing_percentage',
        'iconfile'                 => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ecom_config_code_generator') . 'Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_part.png',
        'typeicon_column' => 'accessory',
        'typeicon_classes' => [
            'default' => 'ccg-domain-model-part-accessory',
            'mask' => 'ccg-domain-model-part-no-accessory-###TYPE###',
        ]

    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, is_empty_part, accessory, code_segment, image, hint, dependency, pricing, pricing_percentage'
    ],
    'types'     => [
        '1' => ['showitem' => "sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, --palette--;Part;pTitle, accessory, code_segment, part_group, --div--;{$translate}tabs.referral, image, dependency, --div--;{$translate}tabs.pricing, pricing, pricing_percentage, --div--;LLL:EXT:cms/locallang_tca.xlf:pages.tabs.extended, hint;;;wizards[t3editorHtml], --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, --palette--;LLL:EXT:cms/locallang_tca.xlf:pages.palettes.access;access"]
    ],
    'palettes'  => [
        '1'      => [
            'showitem' => ''
        ],
        'access' => [
            'showitem'       => 'starttime;LLL:EXT:cms/locallang_tca.xlf:pages.starttime_formlabel, endtime;LLL:EXT:cms/locallang_tca.xlf:pages.endtime_formlabel, --linebreak--, fe_group;LLL:EXT:cms/locallang_tca.xlf:pages.fe_group_formlabel',
            'canNotCollapse' => true
        ],
        'pTitle' => [
            'showitem' => 'title, is_empty_part',
            'canNotCollapse' => true
        ]
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
                    ['', 0],
                ],
                'foreign_table'       => 'tx_ecomconfigcodegenerator_domain_model_part',
                'foreign_table_where' => 'AND tx_ecomconfigcodegenerator_domain_model_part.pid=###CURRENT_PID### AND tx_ecomconfigcodegenerator_domain_model_part.sys_language_uid IN (-1,0)',
                'suppress_icons'      => 1
            ]
        ],
        'l10n_diffsource'  => [
            'config' => [
                'type' => 'passthrough',
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

        'hidden'    => [
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config'  => [
                'type' => 'check'
            ]
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
                ]
            ]
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
                ]
            ]
        ],
        'fe_group'  => [
            'exclude' => 1,
            'label'   => 'LLL:EXT:lang/locallang_general.xlf:LGL.fe_group',
            'config'  => [
                'type'                => 'select',
                'size'                => 7,
                'maxitems'            => 20,
                'items'               => [
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.hide_at_login',
                        -1
                    ],
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.any_login',
                        -2
                    ],
                    [
                        'LLL:EXT:lang/locallang_general.xlf:LGL.usergroups',
                        '--div--'
                    ]
                ],
                'exclusiveKeys'       => '-1,-2',
                'foreign_table'       => 'fe_groups',
                'foreign_table_where' => 'ORDER BY fe_groups.title'
            ]
        ],
        'accessory'    => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'FIELD:is_empty_part:=:0',
            'exclude'     => 1,
            'label'       => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.accessory",
            'config'      => [
                'type' => 'select',
                'foreign_table' => 'tx_ecomproducttools_domain_model_accessory',
                'foreign_table_where' => ('
                    AND NOT tx_ecomproducttools_domain_model_accessory.deleted
                    AND tx_ecomproducttools_domain_model_accessory.sys_language_uid IN (-1,0)
                    ORDER BY tx_ecomproducttools_domain_model_accessory.title
                '),
                'maxitems' => 1,
                'renderType' => 'selectMultipleSideBySide',
                'wizards'             => [
                    '_POSITION' => 'top',
                    'suggest'   => [
                        'type'    => 'suggest',
                        'default' => ['searchWholePhrase' => 1]
                    ],
                    'edit' => [
                        'type' => 'popup',
                        'title' => 'Edit template',
                        'module' => [
                            'name' => 'wizard_edit',
                        ],
                        'popup_onlyOpenIfSelected' => 1,
                        'icon' => 'edit2.gif',
                        'JSopenParams' => 'height=350,width=580,status=0,menubar=0,scrollbars=1'
                    ],
                ],
            ]
        ],
        'title'              => [
            'l10n_mode' => 'prefixLangTitle',
            'exclude'   => 0,
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.title",
            'config'    => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim,required',
            ]
        ],
        'is_empty_part'    => [
            'l10n_mode' => 'exclude',
            'displayCond' => [
                'AND' => [
                    'FIELD:accessory:=:',
                    'USER:S3b0\\EcomConfigCodeGenerator\\User\\ModifyTCA\\ModifyTCA->checkIfMultipleSelectEnabledInPart:1'
                ]
            ],
            'exclude' => 1,
            'label'   => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.is_empty_part",
            'config'  => [
                'type' => 'check'
            ]
        ],
        'code_segment'       => [
            'l10n_mode' => 'exclude',
            'exclude'   => 0,
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.code_segment",
            'config'    => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ]
        ],
        'image'              => [
            'l10n_mode' => 'exclude',
            'displayCond' => 'FIELD:accessory:=:',
            'exclude'   => 1,
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.image",
            'config'    => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'image',
                [
                    'maxitems'      => 1,
                    'appearance'    => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
                        'enabledControls'            => [
                            'localize' => 0
                        ]
                    ],
                    'behaviour'     => [
                        'localizeChildrenAtParentLocalization' => false
                    ],
                    'foreign_types' => [
                        \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                            'showitem' => '--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,--palette--;;filePalette'
                        ]
                    ],
                    'filter'        => [
                        '0' => [
                            'parameters' => [
                                'allowedFileExtensions' => $GLOBALS[ 'TYPO3_CONF_VARS' ][ 'GFX' ][ 'imagefile_ext' ]
                            ]
                        ]
                    ]
                ],
                $GLOBALS[ 'TYPO3_CONF_VARS' ][ 'GFX' ][ 'imagefile_ext' ]
            )
        ],
        'hint'               => [
            'l10n_mode' => 'prefixLangTitle',
            'displayCond' => 'FIELD:accessory:=:',
            'exclude'   => 0,
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.hint",
            'config'    => [
                'type'    => 'text',
                'cols'    => 100,
                'rows'    => 10,
                'eval'    => 'trim',
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
        'dependency'         => [
            'l10n_mode' => 'exclude',
            'exclude'   => 1,
            'label'     => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.dependency",
            'config'    => [
                'type'          => 'inline',
                'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_dependency',
                'foreign_field' => 'part',
                'minitems'      => 0,
                'maxitems'      => 1,
                'appearance'    => [
                    'collapseAll'           => 0,
                    'levelLinksPosition'    => 'bottom',
                    'newRecordLinkAddTitle' => 0,
                    'newRecordLinkTitle'    => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.dependency.inlineElementAddTitle"
                ],
                'behaviour'     => [
                    'localizationMode'                     => 'keep',
                    'localizeChildrenAtParentLocalization' => 0,
                    'disableMovingChildrenWithParent'      => 0,
                    'enableCascadingDelete'                => 1
                ]
            ]
        ],
        'pricing'            => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'USER:S3b0\\EcomConfigCodeGenerator\\User\\ModifyTCA\\ModifyTCA->checkPriceHandling:1',
            'exclude'     => 1,
            'label'       => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.pricing",
            'config'      => [
                'type'          => 'inline',
                'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_price',
                'foreign_field' => 'part',
                'maxitems'      => $maxItemsPricing,
                'appearance'    => [
                    'collapseAll'           => 0,
                    'levelLinksPosition'    => 'bottom',
                    'newRecordLinkAddTitle' => 0,
                    'newRecordLinkTitle'    => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.pricing.inlineElementAddTitle"
                ],
                'behaviour'     => [
                    'localizationMode'                     => 'keep',
                    'localizeChildrenAtParentLocalization' => 0,
                    'disableMovingChildrenWithParent'      => 0,
                    'enableCascadingDelete'                => 1
                ]
            ]
        ],
        'pricing_percentage' => [
            'l10n_mode'   => 'exclude',
            'displayCond' => 'USER:S3b0\\EcomConfigCodeGenerator\\User\\ModifyTCA\\ModifyTCA->checkPriceHandling',
            'exclude'     => 1,
            'label'       => "{$translate}tx_ecomconfigcodegenerator_domain_model_part.pricing_percentage",
            'config'      => [
                'type'        => 'input',
                'size'        => 10,
                'placeholder' => '0.00',
                'eval'        => 'double2'
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
