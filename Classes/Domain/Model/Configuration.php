<?php
namespace S3b0\EcomConfigCodeGenerator\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Sebastian Iffland <Sebastian.Iffland@ecom-ex.com>, ecom instruments GmbH
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Base record where the configuration starts!
 */
class Configuration extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * Work title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * Code prefix (will be prepended on finish)
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * Code suffix (will be appended on finish)
     *
     * @var string
     */
    protected $suffix = '';

    /**
     * partGroups
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup>
     * @cascade remove
     */
    protected $partGroups = null;

    /**
     * pricingEnabled
     *
     * @var bool
     */
    protected $pricingEnabled = false;

    /**
     * Configuration base pricing
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Price>
     * @cascade remove
     */
    public $pricing = null;

    /**
     * @var string
     */
    public $currencyPricing = '';

    /**
     * @var float
     */
    public $noCurrencyPricing = 0.0;

    /**
     * @var string
     */
    protected $configurationPricing = '';

    /**
     * @var float
     */
    protected $configurationPricingNumeric = 0.0;

    /**
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency
     */
    protected $currency;

    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }

    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->partGroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->pricing = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     *
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the prefix
     *
     * @return string $prefix
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * Sets the prefix
     *
     * @param string $prefix
     *
     * @return void
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * Returns the suffix
     *
     * @return string $suffix
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * Sets the suffix
     *
     * @param string $suffix
     *
     * @return void
     */
    public function setSuffix($suffix)
    {
        $this->suffix = $suffix;
    }

    /**
     * Adds a PartGroup
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
     *
     * @return void
     */
    public function addPartGroup(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup)
    {
        $this->partGroups->attach($partGroup);
    }

    /**
     * Removes a PartGroup
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroupToRemove The PartGroup to be removed
     *
     * @return void
     */
    public function removePartGroup(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroupToRemove)
    {
        $this->partGroups->detach($partGroupToRemove);
    }

    /**
     * Returns the partGroups
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup> $partGroups
     */
    public function getPartGroups()
    {
        return $this->partGroups;
    }

    /**
     * Sets the partGroups
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup> $partGroups
     *
     * @return void
     */
    public function setPartGroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $partGroups)
    {
        $this->partGroups = $partGroups;
    }

    /**
     * Returns the pricingEnabled
     *
     * @return bool $pricingEnabled
     */
    public function isPricingEnabled()
    {
        return $this->pricingEnabled;
    }

    /**
     * Sets the pricingEnabled
     *
     * @param bool $pricingEnabled
     *
     * @return void
     */
    public function setPricingEnabled($pricingEnabled)
    {
        $this->pricingEnabled = $pricingEnabled;
    }

    /**
     * Adds a Price
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricing
     *
     * @return void
     */
    public function addPricing(\S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricing)
    {
        $this->pricing->attach($pricing);
    }

    /**
     * Removes a Price
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricingToRemove The Price to be removed
     *
     * @return void
     */
    public function removePricing(\S3b0\EcomConfigCodeGenerator\Domain\Model\Price $pricingToRemove)
    {
        $this->pricing->detach($pricingToRemove);
    }

    /**
     * Returns the pricing
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Price> $pricing
     */
    public function getPricing()
    {
        return $this->pricing;
    }

    /**
     * Sets the pricing
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Price> $pricing
     *
     * @return void
     */
    public function setPricing(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $pricing)
    {
        $this->pricing = $pricing;
    }

    /**
     * @return string $currencyPricing
     */
    public function getCurrencyPricing()
    {
        return $this->currencyPricing;
    }

    /**
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency
     * @param array                                               $settings
     */
    public function setCurrencyPricing(\S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency = null, array $settings = [])
    {
        \S3b0\EcomConfigCodeGenerator\Utility\PriceHandler::setPriceInCurrency($this, $currency, $settings);
        $this->configurationPricingNumeric = $this->noCurrencyPricing;
        $this->currency = $currency;
    }

    /**
     * @return float $noCurrencyPricing
     */
    public function getNoCurrencyPricing()
    {
        return $this->noCurrencyPricing;
    }

    /**
     * @param float $noCurrencyPricing
     */
    public function setNoCurrencyPricing($noCurrencyPricing)
    {
        $this->noCurrencyPricing = $noCurrencyPricing;
    }

    /**
     * @return string
     */
    public function getConfigurationPricing()
    {
        return \S3b0\EcomConfigCodeGenerator\Utility\PriceHandler::getPriceInCurrency($this->configurationPricingNumeric, $this->currency) ?: $this->getCurrencyPricing();
    }

    /**
     * @param string $configurationPricing
     */
    public function setConfigurationPricing($configurationPricing)
    {
        $this->configurationPricing = $configurationPricing;
    }

    /**
     * @return float $configurationPricingNumeric
     */
    public function getConfigurationPricingNumeric()
    {
        return $this->configurationPricingNumeric;
    }

    /**
     * @param float $configurationPricingNumeric
     */
    public function setConfigurationPricingNumeric($configurationPricingNumeric)
    {
        $this->configurationPricingNumeric = $configurationPricingNumeric;
    }

    /**
     * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency
     */
    public function setCurrency(\S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency = null)
    {
        $this->currency = $currency;
    }

    /**
     * @param PartGroup $partGroup
     */
    public function summateConfigurationPricing(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup)
    {
        if ($partGroup->getActiveParts() instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $partGroup->getActiveParts()->count()) {
            /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
            foreach ($partGroup->getActiveParts() as $part) {
                $this->configurationPricingNumeric += $part->getNoCurrencyPricing();
            }
        }
    }

}