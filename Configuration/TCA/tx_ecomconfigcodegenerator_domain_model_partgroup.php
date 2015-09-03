<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$translate = 'LLL:EXT:ecom_config_code_generator/Resources/Private/Language/locallang_db.xlf:';

  // Set settings item array
$settings = [
	[ "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.settings.visibility.showInGenerator" ],
	[ "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.settings.visibility.showInSummary" ],
	[ "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.settings.visibility.showInNavigation" ],
	[ "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.settings.general.enableMultipleSelect" ],
	[ "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.settings.general.usePercentPricing" ]
];
  // Generate typeIconClasses (exclude bit 1)
$max = pow(2, count($settings));
$typeIconClasses['default'] = 'extensions-ecom_config_code_generator-package-default';
for ( $i = 0; $i < $max; $i += 2 ) {
	$typeIconClasses["$i"] = 'extensions-ecom_config_code_generator-package-hidden-fe';
}

return [
	'ctrl' => [
		'adminOnly' => TRUE,
		'title'	=> "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup",
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,

		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'requestUpdate' => 'settings',
		'typeicon_column' => 'settings',
		'typeicon_classes' => $typeIconClasses,
		'enablecolumns' => [
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
			'fe_group' => 'fe_group'
		],
		'searchFields' => 'title,icon,place_in_code,prompt,settings,parts,default_part,dependent_note',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ecom_config_code_generator') . 'Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_partgroup.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, title, icon, place_in_code, prompt, settings, parts, default_part, dependent_note'
	],
	'types' => [
		'1' => [ 'showitem' => "sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, title, prompt;;;wizards[t3editorHtml], dependent_note, configuration, --div--;{$translate}tabs.parts, parts, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.appearance, icon, --palette--;;2, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, --palette--;LLL:EXT:cms/locallang_tca.xlf:pages.palettes.access;access" ]
	],
	'palettes' => [
		'1' => [
			'showitem' => ''
		],
		'2' => [
			'showitem' => 'default_part, place_in_code, --linebreak--, settings',
			'canNotCollapse' => TRUE
		],
		'access' => [
			'showitem' => 'starttime;LLL:EXT:cms/locallang_tca.xlf:pages.starttime_formlabel, endtime;LLL:EXT:cms/locallang_tca.xlf:pages.endtime_formlabel, --linebreak--, fe_group;LLL:EXT:cms/locallang_tca.xlf:pages.fe_group_formlabel',
			'canNotCollapse' => TRUE
		]
	],
	'columns' => [

		'sys_language_uid' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.language',
			'config' => [
				'type' => 'select',
				'foreign_table' => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => [
					[ 'LLL:EXT:lang/locallang_general.xlf:LGL.allLanguages', -1 ],
					[ 'LLL:EXT:lang/locallang_general.xlf:LGL.default_value', 0 ]
				]
			]
		],
		'l10n_parent' => [
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.l18n_parent',
			'config' => [
				'type' => 'select',
				'items' => [
					[ '', 0 ],
				],
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_partgroup',
				'foreign_table_where' => 'AND tx_ecomconfigcodegenerator_domain_model_partgroup.pid=###CURRENT_PID### AND tx_ecomconfigcodegenerator_domain_model_partgroup.sys_language_uid IN (-1,0)'
			]
		],
		'l10n_diffsource' => [
			'config' => [
				'type' => 'passthrough'
			]
		],

		't3ver_label' => [
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
			'config' => [
				'type' => 'input',
				'size' => 30,
				'max' => 255
			]
		],

		'hidden' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
			'config' => [
				'type' => 'check'
			]
		],
		'starttime' => [
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				]
			]
		],
		'endtime' => [
			'exclude' => 1,
			'l10n_mode' => 'mergeIfNotBlank',
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
			'config' => [
				'type' => 'input',
				'size' => 13,
				'max' => 20,
				'eval' => 'datetime',
				'checkbox' => 0,
				'default' => 0,
				'range' => [
					'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
				]
			]
		],
		'fe_group' => [
			'exclude' => 1,
			'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.fe_group',
			'config' => [
				'type' => 'select',
				'size' => 7,
				'maxitems' => 20,
				'items' => [
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
				'exclusiveKeys' => '-1,-2',
				'foreign_table' => 'fe_groups',
				'foreign_table_where' => 'ORDER BY fe_groups.title'
			]
		],

		'title' => [
			'exclude' => 0,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.title",
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			]
		],
		'icon' => [
			'displayCond' => 'FIELD:settings:BIT:1',
			'l10n_mode' => 'exclude',
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.icon",
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'icon',
				[
					'maxitems' => 1,
					'appearance' => [
						'createNewRelationLinkTitle' => 'LLL:EXT:cms/locallang_ttc.xlf:images.addFileReference',
						'enabledControls' => [
							'localize' => 0
						]
					],
					'behaviour' => [
						'localizeChildrenAtParentLocalization' => 0
					],
					'foreign_types' => [
						\TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
							'showitem' => '--palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,--palette--;;filePalette'
						],
					],
					'filter' => [
						'0' => [
							'parameters' => [
								'allowedFileExtensions' => $GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
							]
						]
					]
				],
				$GLOBALS['TYPO3_CONF_VARS']['GFX']['imagefile_ext']
			)
		],
		'place_in_code' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.place_in_code",
			'config' => [
				'type' => 'input',
				'size' => 5,
				'eval' => 'trim,int',
				'range' => [
					'lower' => 0,
					'upper' => 999
				],
				'default' => 0,
				'wizards' => [
					'angle' => [
						'type' => 'slider',
						'step' => 1,
						'width' => 999
					]
				]
			]
		],
		'prompt' => [
			'exclude' => 0,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.prompt",
			'config' => [
				'type' => 'text',
				'cols' => 100,
				'rows' => 10,
				'eval' => 'trim',
				'wizards' => [
					't3editorHtml' => [
						'enableByTypeConfig' => 1,
						'type' => 'userFunc',
						'userFunc' => 'TYPO3\\CMS\\T3editor\\FormWizard->main',
						'params' => [
							'format' => 'html'
						]
					]
				]
			]
		],
		'settings' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.settings",
			'config' => [
				'type' => 'check',
				'items' => $settings,
				'default' => 7
			]
		],
		'parts' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.parts",
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_part',
				'foreign_field' => 'partgroup',
				'maxitems'      => 9999,
				'appearance' => [
					'collapseAll' => 1,
					'newRecordLinkAddTitle' => 0,
					'newRecordLinkTitle' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.parts.inlineElementAddTitle",
					'levelLinksPosition' => 'bottom',
					'showAllLocalizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showSynchronizationLink' => 1,
					'useSortable' => 1
				],
				'behaviour' => [
					'localizationMode' => 'select',
					'localizeChildrenAtParentLocalization' => 1,
					'disableMovingChildrenWithParent' => 0,
					'enableCascadingDelete' => 1
				]
			]
		],
		'default_part' => [
			'displayCond' => [
				'AND' => [
					'FIELD:settings:!BIT:1',
					'FIELD:parts:>:0'
				]
			],
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.default_part",
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_part',
				'foreign_table_where' => 'AND tx_ecomconfigcodegenerator_domain_model_part.pid=###CURRENT_PID### AND NOT tx_ecomconfigcodegenerator_domain_model_part.deleted AND tx_ecomconfigcodegenerator_domain_model_part.sys_language_uid IN (-1,0) AND tx_ecomconfigcodegenerator_domain_model_part.partgroup IN (###THIS_UID###,###REC_FIELD_l10n_parent###) ORDER BY tx_ecomconfigcodegenerator_domain_model_part.title',
				'items' => [
					[ "{$translate}select.empty", '' ]
				],
				'minitems' => 1,
				'maxitems' => 1
			]
		],
		'dependent_note' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.dependent_note",
			'config' => [
				'type' => 'inline',
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_dependentnote',
				'foreign_field' => 'partgroup',
				'maxitems'      => 9999,
				'appearance' => [
					'collapseAll' => 0,
					'newRecordLinkAddTitle' => 0,
					'newRecordLinkTitle' => "{$translate}tx_ecomconfigcodegenerator_domain_model_partgroup.dependent_note.inlineElementAddTitle",
					'levelLinksPosition' => 'bottom',
					'showAllLocalizationLink' => 1,
					'showPossibleLocalizationRecords' => 1,
					'showSynchronizationLink' => 1
				],
				'behaviour' => [
					'localizationMode' => 'select',
					'localizeChildrenAtParentLocalization' => 1,
					'disableMovingChildrenWithParent' => 0,
					'enableCascadingDelete' => 1
				]
			]
		],

		'configuration' => [
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration",
			'config' => [
				'type' => 'select',
				'readOnly' => 1,
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_configuration'
			]
		]

	]
];
