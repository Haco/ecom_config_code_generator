<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$translate = 'LLL:EXT:ecom_config_code_generator/Resources/Private/Language/locallang_db.xlf:';

return [
	'ctrl' => [
		'adminOnly' => TRUE,
		'title'	=> "{$translate}tx_ecomconfigcodegenerator_domain_model_price",
		'label' => 'value',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,
		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'delete' => 'deleted',
		'enablecolumns' => [
			'disabled' => 'hidden'
		],
		'searchFields' => 'value,currency,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('ecom_config_code_generator') . 'Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_price.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'hidden, value, currency'
	],
	'types' => [
		'1' => [ 'showitem' => 'hidden;;1;;1-1-1, --palette--;;2' ]
	],
	'palettes' => [
		'1' => [ 'showitem' => '' ],
		'2' => [ 'showitem' => 'value, currency, --linebreak--, configuration, part', 'canNotCollapse' => TRUE ]
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

		'value' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_price.value",
			'config' => [
				'type' => 'input',
				'size' => 10,
				'eval' => 'double2,required'
			]
		],
		'currency' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_price.currency",
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_currency',
				'foreign_table_where' => ' AND NOT tx_ecomconfigcodegenerator_domain_model_currency.deleted',
				'minitems' => 1,
				'maxitems' => 1
			]
		],

		'configuration' => [
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_configuration",
			'config' => [
				'type' => 'select',
				'readOnly' => 1,
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_configuration'
			]
		],
		'part' => [
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_part",
			'config' => [
				'type' => 'select',
				'readOnly' => 1,
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_part'
			]
		]
	]
];
