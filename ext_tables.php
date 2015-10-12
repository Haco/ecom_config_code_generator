<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

$extKey = 'ecom_config_code_generator';

  // Register plugins
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin( $extKey, 'Generator', 'ConfigCodeGen - Generator' );
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin( $extKey, 'Resolver', 'ConfigCodeGen - Resolver' );

  // Add static templates
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($extKey, 'Resources/Private/TypoScript', 'Config code generator');

  // Tables allowed on regular TYPO3 pages
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ecomconfigcodegenerator_domain_model_configuration');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ecomconfigcodegenerator_domain_model_currency');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ecomconfigcodegenerator_domain_model_dependency');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ecomconfigcodegenerator_domain_model_dependentnote');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ecomconfigcodegenerator_domain_model_log');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ecomconfigcodegenerator_domain_model_modal');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ecomconfigcodegenerator_domain_model_part');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ecomconfigcodegenerator_domain_model_partgroup');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_ecomconfigcodegenerator_domain_model_price');

  // Add context sensitive help
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ecomconfigcodegenerator_domain_model_configuration', 'EXT:ecom_config_code_generator/Resources/Private/Language/locallang_csh_tx_ecomconfigcodegenerator_domain_model_configuration.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ecomconfigcodegenerator_domain_model_currency', 'EXT:ecom_config_code_generator/Resources/Private/Language/locallang_csh_tx_ecomconfigcodegenerator_domain_model_currency.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ecomconfigcodegenerator_domain_model_dependency', 'EXT:ecom_config_code_generator/Resources/Private/Language/locallang_csh_tx_ecomconfigcodegenerator_domain_model_dependency.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ecomconfigcodegenerator_domain_model_dependentnote', 'EXT:ecom_config_code_generator/Resources/Private/Language/locallang_csh_tx_ecomconfigcodegenerator_domain_model_dependentnote.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ecomconfigcodegenerator_domain_model_log', 'EXT:ecom_config_code_generator/Resources/Private/Language/locallang_csh_tx_ecomconfigcodegenerator_domain_model_log.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ecomconfigcodegenerator_domain_model_modal', 'EXT:ecom_config_code_generator/Resources/Private/Language/locallang_csh_tx_ecomconfigcodegenerator_domain_model_modal.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ecomconfigcodegenerator_domain_model_part', 'EXT:ecom_config_code_generator/Resources/Private/Language/locallang_csh_tx_ecomconfigcodegenerator_domain_model_part.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ecomconfigcodegenerator_domain_model_partgroup', 'EXT:ecom_config_code_generator/Resources/Private/Language/locallang_csh_tx_ecomconfigcodegenerator_domain_model_partgroup.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_ecomconfigcodegenerator_domain_model_price', 'EXT:ecom_config_code_generator/Resources/Private/Language/locallang_csh_tx_ecomconfigcodegenerator_domain_model_price.xlf');

$extPath = version_compare(TYPO3_branch, '7.5', '<') ? \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($extKey) : \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($extKey);
$t3skinExtPath = version_compare(TYPO3_branch, '7.5', '<') ? \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('t3skin') : \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('t3skin');
  // Add Sprite Icons for different record types (visual distinction)
\TYPO3\CMS\Backend\Sprite\SpriteManager::addSingleIcons(
	[
		'dependency-default' => "{$extPath}Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_dependency.png",
		'dependency-allow'   => "{$t3skinExtPath}images/icons/status/status-permission-granted.png",
		'dependency-deny'    => "{$t3skinExtPath}images/icons/status/status-permission-denied.png",
		'package-default'    => "{$extPath}Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_partgroup.png",
		'package-hidden-fe'  => "{$extPath}Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_partgroup_hidden_fe.png"
	],
	$extKey
);