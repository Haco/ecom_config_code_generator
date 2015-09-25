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
			if ( $currency instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency ) {
				$value = '0.00';
				$priceFound = FALSE;
				$numberValue = 0;
				/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $default */
				$default = NULL;
				$dec_point = $currency->isNumberSeparatorInUSFormat() ? '.' : ',';
				$thousands_sep = $currency->isNumberSeparatorInUSFormat() ? ',' : '.';
				if ( !($model instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Part && $model->getPartGroup()->isPricePercentage()) && $model->{$pricingField}->count() ) {
					/**
					 * Step 1: Get price in current currency if set >>
					 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricing
					 */
					foreach( $model->{$pricingField} as $pricing ) {
						$compareCurrency = $pricing->getCurrency() instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy ? $pricing->getCurrency()->_loadRealInstance() : $pricing->getCurrency();
						if ( $compareCurrency->isDefaultCurrency() ) {
							$default = $pricing;
						}
						if ( $compareCurrency === $currency ) {
							$priceFound = TRUE;
							$numberValue = $pricing->getValue();
							$value = number_format($pricing->getValue(), 2, $dec_point, $thousands_sep);
						}
					}
					/**
					 * Step 2: Get price by calculation using default price and exchange rate >>
					 */
					if ( !$priceFound && $default instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Price && $default->getCurrency() !== $currency ) {
						$calculatedValue = $default->getValue() * $currency->getExchange();
						if ( $calculatedValue ) {
							$numberValue = $calculatedValue;
							$value = number_format($calculatedValue, 2, $dec_point, $thousands_sep);
						}
					}
				}
				/**
				 * Step 3: If still no price is available, set 'em to zero
				 */
				$model->_setProperty($setNumberField, $numberValue);
				$whitespace = $currency->isWhitespaceBetweenCurrencyAndValue() ? ' ' : '';
				if ( $currency->isSymbolPrepended() ) {
					$model->{$setStringField} = "{$currency->getSymbol()}{$whitespace}{$value}";
				} else {
					$model->{$setStringField} = "{$value}{$whitespace}{$currency->getSymbol()}";
				}
			} else {
				$model->_setProperty($setNumberField, 0);
				$model->{$setStringField} = '0';
			}
		}

	}