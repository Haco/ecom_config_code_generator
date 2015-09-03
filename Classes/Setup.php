<?php

namespace S3b0\EcomConfigCodeGenerator;

/**
 * Class Setup
 * @package S3b0\EcomConfigCodeGenerator
 */
class Setup {

	const BIT_CURRENCY_IS_DEFAULT = 1;
	const BIT_CURRENCY_PREPEND_SYMBOL = 2;
	const BIT_CURRENCY_ADD_WHITEPACE_BETWEEN_CURRENCY_AND_VALUE = 4;
	const BIT_CURRENCY_NUMBER_SEPARATORS_IN_US_FORMAT = 8;

	/**
	 * @param boolean $isDevelopment
	 */
	public static function setEnvironment($isDevelopment = FALSE) {
		if ( $isDevelopment ) {
			$GLOBALS['TYPO3_CONF_VARS']['BE']['debug'] = 1;
			$GLOBALS['TYPO3_CONF_VARS']['FE']['debug'] = 1;
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['devIPmask'] = '*';
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['displayErrors'] = '1';
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['enableDeprecationLog'] = 'file';
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['sqlDebug'] = '1';
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['systemLogLevel'] = '0';
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['exceptionalErrors'] = '28674';
			$GLOBALS['TYPO3_CONF_VARS']['SYS']['clearCacheSystem'] = '1';
		}
	}

}