<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.' . $_EXTKEY,
	'Generator',
	[ 'Generator' => 'index, currencySelect, request, reset, setPart' ],
	// non-cacheable actions
	[ 'Generator' => 'index, request, reset, setPart' ]
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'S3b0.' . $_EXTKEY,
	'Resolver',
	[ 'Resolver' => 'list, show' ],
	// non-cacheable actions
	[ 'Resolver' => 'list, show' ]
);
