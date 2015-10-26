<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.EcomConfigCodeGenerator',
	'Generator',
	[
		'Generator' => 'index, currencySelect, setCurrency, reset',
		'Log' => 'new, create, confirmation'
	],
	// non-cacheable actions
	[
		'Generator' => 'index, setCurrency, reset',
		'Log' => 'create'
	]
);

$GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include']['EcomConfigCodeGenerator'] = 'EXT:ecom_config_code_generator/Classes/AjaxDispatcher.php';