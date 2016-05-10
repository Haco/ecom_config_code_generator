<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

$extKey = 'ecom_config_code_generator';

// Register plugins
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin($extKey, 'Generator', 'ConfigCodeGen - Generator');
\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin($extKey, 'Resolver', 'ConfigCodeGen - Resolver');

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

// Add Sprite Icons for different record types
/** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
// Accessory Part
$iconRegistry->registerIcon(
    'ccg-domain-model-part-accessory',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => "{$extPath}Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_part_accessory.png"]
);
// Default Part Icon if no accessory is selected
$iconRegistry->registerIcon(
    'ccg-domain-model-part-no-accessory-0',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => "{$extPath}Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_part.png"]
);
// Dependency Icons
$iconRegistry->registerIcon(
    'ccg-domain-model-dependency-default',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => "{$extPath}Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_dependency.png"]
);
$iconRegistry->registerIcon(
    'ccg-domain-model-dependency-allow',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => "{$t3skinExtPath}images/icons/status/status-permission-granted.png"]
);
$iconRegistry->registerIcon(
    'ccg-domain-model-dependency-deny',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => "{$t3skinExtPath}images/icons/status/status-permission-denied.png"]
);
// PartGroups Icons
$iconRegistry->registerIcon(
    'ccg-domain-model-partgroup-default',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => "{$extPath}Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_partgroup.png"]
);
$iconRegistry->registerIcon(
    'ccg-domain-model-partgroup-hidden-fe',
    \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
    ['source' => "{$extPath}Resources/Public/Icons/tx_ecomconfigcodegenerator_domain_model_partgroup_hidden_fe.png"]
);