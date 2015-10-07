<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$translate = 'LLL:EXT:ecom_config_code_generator/Resources/Private/Language/locallang_db.xlf:';

return [
	'ctrl' => [
		'adminOnly' => TRUE,
		'title'	=> "{$translate}tx_ecomconfigcodegenerator_domain_model_currency",
		'label' => 'title',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'rootLevel' => 1,
		'sortby' => 'sorting',
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden'
		],
		'searchFields' => 'title,iso_code,exchange,symbol,region,ll_reference,flag,settings,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::isLoaded('static_info_tables') ? \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('static_info_tables') . 'Resources/Public/Images/Icons/icon_static_currencies.gif' : ''
	],
	'interface' => [
		'showRecordFieldList' => 'hidden, title, iso_code, exchange, symbol, region, ll_reference, flag, settings'
	],
	'types' => [
		'1' => [ 'showitem' => "hidden;;1, title;;4, --palette--;{$translate}palettes.basic;2, --palette--;{$translate}palettes.region;3" ]
	],
	'palettes' => [
		'1' => [ 'showitem' => '' ],
		'2' => [ 'showitem' => 'iso_code, exchange, symbol', 'canNotCollapse' => TRUE ],
		'3' => [ 'showitem' => 'region, ll_reference, --linebreak--, flag', 'canNotCollapse' => TRUE ],
		'4' => [ 'showitem' => 'settings' ]
	],
	'columns' => [

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

		'title' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.title",
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			]
		],
		'iso_code' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.iso_code",
			'config' => [
				'type' => 'input',
				'size' => 5,
				'max' => 3,
				'eval' => 'trim,nospace,upper,unique,alpha,required'
			]
		],
		'exchange' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.exchange",
			'config' => [
				'type' => 'input',
				'size' => 5,
				'eval' => 'double2',
				'default' => '0.00'
			]
		],
		'symbol' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.symbol",
			'config' => [
				'type' => 'input',
				'size' => 7,
				'eval' => 'trim,required,nospace'
			]
		],
		'region' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.region",
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,required'
			]
		],
		'll_reference' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.ll_reference",
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim,nospace'
			]
		],
		'flag' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.flag",
			'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
				'flag',
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
						]
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
		'settings' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.settings",
			'config' => [
				'type' => 'check',
				'items' => [
					[ "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.settings.prepend_symbol" ],
					[ "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.settings.separate" ],
					[ "{$translate}tx_ecomconfigcodegenerator_domain_model_currency.settings.format_us" ]
				],
				'default' => 2
			]
		]

	]
];
