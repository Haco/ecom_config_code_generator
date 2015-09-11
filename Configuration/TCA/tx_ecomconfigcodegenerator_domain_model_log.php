<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

$translate = 'LLL:EXT:ecom_config_code_generator/Resources/Private/Language/locallang_db.xlf:';

return [
	'ctrl' => [
		'title'	=> "{$translate}tx_ecomconfigcodegenerator_domain_model_log",
		'label' => 'tstamp',
		'label_alt' => 'configuration_code',
		'label_alt_force' => TRUE,
		'default_sortby' => 'ORDER BY tstamp',
		'tstamp' => 'tstamp',
		'dividers2tabs' => TRUE,
		'rootLevel' => 1,
		'readOnly' => TRUE,
#		'hideTable' => TRUE,
		'enablecolumns' => [ ],
		'searchFields' => 'session_id,configuration,configured_parts,pricing,ip_address,fe_user,',
		'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('belog') . 'ext_icon.gif'
	],
	'interface' => [
		'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, session_id, configuration, configured_parts, pricing, ip_address, fe_user'
	],
	'types' => [
		'1' => [ 'showitem' => 'session_id;;;;1-1-1, configuration, configured_parts, pricing, ip_address, fe_user' ]
	],
	'palettes' => [
		'1' => [ 'showitem' => '' ]
	],
	'columns' => [

		'session_id' => [
			'exclude' => 0,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.session_id",
			'config' => [
				'type' => 'input',
				'size' => 41,
				'eval' => 'trim,nospace,required'
			]
		],
		'configuration' => [
			'exclude' => 0,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.configuration",
			'config' => [
				'type' => 'input',
				'size' => 41,
				'eval' => 'trim,nospace,required'
			]
		],
		'pricing' => [
			'exclude' => 0,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.pricing",
			'config' => [
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			]
		],
		'ip_address' => [
			'exclude' => 0,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.ip_address",
			'config' => [
				'type' => 'input',
				'max' => 15,
				'eval' => 'trim,nospace,is_in',
				'is_in' => '0123456789.*'
			]
		],
		'fe_user' => [
			'exclude' => 0,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.fe_user",
			'config' => [
				'type' => 'select',
				'foreign_table' => 'fe_users',
				'items' => [
					[ '', 0 ]
				]
			]
		],
		'configured_parts' => [
			'exclude' => 1,
			'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_log.configured_parts",
			'config' => [
				'type' => 'select',
				'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_part',
				'foreign_table_where' => 'ORDER BY tx_ecomconfigcodegenerator_domain_model_part.part_group, tx_ecomconfigcodegenerator_domain_model_part.sorting',
				'size' => 20,
				'maxitems' => 9999,
				'readOnly' => 1
			]
		]

	]
];
