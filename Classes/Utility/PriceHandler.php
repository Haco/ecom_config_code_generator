<?php
	/**
	 * Created by PhpStorm.
	 * User: S3b0
	 * Date: 23/09/15
	 * Time: 3:30 PM
	 */

	namespace S3b0\EcomConfigCodeGenerator\Utility;

	/**
	 * Class PriceHandler
	 * @package S3b0\EcomConfigCodeGenerator\Utility
	 */
	class PriceHandler {

		/**
		 * @param \TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject     $model
		 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency|NULL $currency
		 * @param string                                                   $setStringField
		 * @param string                                                   $setNumberField
		 * @param string                                                   $pricingField
		 */
		public static function getPriceInCurrency(\TYPO3\CMS\Extbase\DomainObject\AbstractDomainObject $model, \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency = NULL, $setStringField = 'currencyPricing', $setNumberField = 'noCurrencyPricing', $pricingField = 'pricing') {
			if ( $currency instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency && $model->{$pricingField}->count() ) {
				$priceFound = FALSE;
				/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $default */
				$default = NULL;
				/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricing */
				foreach( $model->{$pricingField} as $pricing ) {
					$compareCurrency = $pricing->getCurrency() instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy ? $pricing->getCurrency()->_loadRealInstance() : $pricing->getCurrency();
					if ( $compareCurrency->isDefaultCurrency() ) {
						$default = $pricing;
					}
					if ( $compareCurrency === $currency ) {
						$priceFound = TRUE;
						$model->_setProperty($setNumberField, $pricing->getValue());
						$dec_point = $currency->isNumberSeparatorInUSFormat() ? '.' : ',';
						$thousands_sep = $currency->isNumberSeparatorInUSFormat() ? ',' : '.';
						$value = number_format($pricing->getValue(), 2, $dec_point, $thousands_sep);
						$whitespace = $currency->isWhitespaceBetweenCurrencyAndValue() ? ' ' : '';
						if ( $currency->isSymbolPrepended() ) {
							$model->{$setStringField} = "{$currency->getSymbol()}{$whitespace}{$value}";
						} else {
							$model->{$setStringField} = "{$value}{$whitespace}{$currency->getSymbol()}";
						}
					}
				}
				if ( !$priceFound && $default instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Price && $default->getCurrency() !== $currency ) {
					$dec_point = $currency->isNumberSeparatorInUSFormat() ? '.' : ',';
					$thousands_sep = $currency->isNumberSeparatorInUSFormat() ? ',' : '.';
					$value = $default->getValue() * $currency->getExchange();
					if ( $value ) {
						$model->_setProperty($setNumberField, $value);
						$value = number_format($value, 2, $dec_point, $thousands_sep);
						$whitespace = $currency->isWhitespaceBetweenCurrencyAndValue() ? ' ' : '';
						if ( $currency->isSymbolPrepended() ) {
							$model->{$setStringField} = "{$currency->getSymbol()}{$whitespace}{$value}";
						} else {
							$model->{$setStringField} = "{$value}{$whitespace}{$currency->getSymbol()}";
						}
					}
				}
			}
		}

	}