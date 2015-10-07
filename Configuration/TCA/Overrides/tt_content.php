<?php
	/**
	 * Created by PhpStorm.
	 * User: sebo
	 * Date: 25.11.14
	 * Time: 13:43
	 */

$extKey = 'ecom_config_code_generator';
$translate = "LLL:EXT:{$extKey}/Resources/Private/Language/locallang_db.xlf:";

$tempColumns = [
	'ccg_configuration' => [
		'l10n_mode' => 'exclude',
		'exclude' => 1,
		'label' => "{$translate}tx_ecomconfigcodegenerator_domain_model_content.ccg_configuration",
		'config' => [
			'type' => 'inline',
			'foreign_table' => 'tx_ecomconfigcodegenerator_domain_model_configuration',
			'foreign_field' => 'content_object',
			'minitems' => 0,
			'maxitems' => 1,
			'appearance' => [
				'collapseAll' => 0,
				'levelLinksPosition' => 'top',
				'showSynchronizationLink' => 0,
				'showPossibleLocalizationRecords' => 0,
				'showAllLocalizationLink' => 0
			]
		]
	]
];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $tempColumns, TRUE);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['ecomconfigcodegenerator_generator'] = ("
	ccg_configuration,
	--div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.extended, bodytext;{$translate}bodytext_formlabel;;richtext:rte_transform[flag=rte_enabled|mode=ts_css], rte_enabled
");