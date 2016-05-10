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
use S3b0\EcomConfigCodeGenerator\Setup;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * A part available to configuration
 */
class Part extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * @var integer
     */
    protected $sorting = 0;

    /**
     * The part title
     *
     * @var string
     * @validate NotEmpty
     */
    protected $title = '';

    /**
     * Is an empty part option?
     *
     * @var bool
     */
    protected $isEmptyPart = false;

    /**
     * The accessory UID
     *
     * @var int
     */
    protected $accessory = 0;

    /**
     * The accessory Title
     *
     * @var string
     */
    protected $accessoryTitle = '';

    /**
     * The accessory ArtNo
     *
     * @var string
     * @validate NotEmpty
     */
    protected $accessoryArtNo = '';

    /**
     * Representation of part as segment in code!
     *
     * @var string
     * @validate NotEmpty
     */
    protected $codeSegment = '';

    /**
     * A part image
     *
     * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
     */
    protected $image = null;

    /**
     * Give user a hint
     *
     * @var string
     */
    protected $hint = '';

    /**
     * Set a dependency on other parts
     *
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency
     */
    protected $dependency = null;

    /**
     * Part pricing
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Price>
     * @cascade remove
     */
    public $pricing = null;

    /**
     * Part pricing (percentage)
     *
     * @var float
     */
    public $pricingPercentage = 0.0;

    /**
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Price
     */
    public $currencyPricing = null;

    /**
     * @var float
     */
    public $noCurrencyPricing = 0.0;

    /**
     * @var string
     */
    public $differencePricing = '';

    /**
     * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup
     */
    protected $partGroup = null;

    /**
     * @var boolean
     */
    protected $active = false;

    /**
     * @var integer
     */
    protected $modalTrigger = 0;

    /**
     * @var string
     */
    protected $shortDescription;

    /**
     * Part constructor.
     *
     * @param \S3b0\EcomProductTools\Domain\Model\Accessory|null $object
     * @param integer                                            $articleNumber
     * @param PartGroup|null                                     $partGroup
     * @param array                                              $configuration
     */
    public function __construct($object = null, $articleNumber = 0, \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup = null, array $configuration = [])
    {
        /**
         * Handle accessory, if any.
         * Requires new pseudo part group, @see \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup
         * Part group requires (pseudo) parts, initialized in this place
         */
        if ($partGroup instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup) {
            $this->partGroup   = $partGroup;
            if ($object instanceof \S3b0\EcomProductTools\Domain\Model\Accessory) {
                preg_match('/^[a-z0-9]+/i', $object->getArticleNumbers()[$articleNumber], $matches);
                $this->title            = $object->getTitle();
                $this->shortDescription = $object->getShortDescription();
                $this->codeSegment      = $matches[0];
                $this->sorting          = $object->getSorting();
                if (in_array($matches[0], (array)$configuration[ -1 ])) {
                    $this->active  = true;
                    $this->partGroup->addActivePart($this);
                    $this->partGroup->setActive(true);
                }
            } else {
                $this->title   = LocalizationUtility::translate('part.none', Setup::EXT_KEY);
                $this->sorting = -1;
                if (in_array('', (array)$configuration[ -1 ])) {
                    $this->active  = true;
                    $this->partGroup->addActivePart($this);
                    $this->partGroup->setActive(true);
                }
            }
        }
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
        $this->pricing = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }

    /**
     * @return integer $sorting
     */
    public function getSorting()
    {
        return $this->sorting;
    }

    /**
     * Returns the title
     *
     * @return string
     */
    public function getTitle()
    {
        // Get the title of accessory (Will be set in BaseController->initializeParts)
        // And add Art. No if available
        if (strlen($this->getAccessoryTitle())) {
            $accessoryTitle = $this->accessoryTitle;
            $accessoryTitle .= (strlen($this->accessoryArtNo)) ? ' (Art. No: ' . $this->getAccessoryArtNo() . ')' : '';
            return $accessoryTitle;
        }
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
     * Returns Is empty part option
     *
     * @return bool $isEmptyPart
     */
    public function getIsEmptyPart()
    {
        return $this->isEmptyPart;
    }

    /**
     * Sets the is Empty Part Option
     *
     * @param bool $isEmptyPart
     *
     * @return void
     */
    public function setIsEmptyPart($isEmptyPart)
    {
        $this->isEmptyPart= $isEmptyPart;
    }

    /**
     * Returns the accessory
     *
     * @return int $accessory
     */
    public function getAccessory()
    {
        return $this->accessory;
    }

    /**
     * Sets the accessory
     *
     * @param int $accessory
     *
     * @return void
     */
    public function setAccessory($accessory)
    {
        $this->accessory = $accessory;
    }

    /**
     * Returns the accessory title
     *
     * @return string
     */
    public function getAccessoryTitle()
    {
        return $this->accessoryTitle;
    }

    /**
     * Sets the accessory title
     *
     * @param string $accessoryTitle
     *
     * @return void
     */
    public function setAccessoryTitle($accessoryTitle)
    {
        $this->accessoryTitle = $accessoryTitle;
    }

    /**
     * Returns the accessory Articles No
     *
     * @return string
     */
    public function getAccessoryArtNo()
    {
        return $this->accessoryArtNo;
    }

    /**
     * Sets the accessoryArtNo
     *
     * @param string $accessoryArtNo
     * @return void
     */
    public function setAccessoryArtNo($accessoryArtNo)
    {
        $this->accessoryArtNo = $accessoryArtNo;
    }

    /**
     * Returns the codeSegment
     *
     * @return string $codeSegment
     */
    public function getCodeSegment()
    {
        return $this->codeSegment;
    }

    /**
     * Sets the codeSegment
     *
     * @param string $codeSegment
     *
     * @return void
     */
    public function setCodeSegment($codeSegment)
    {
        $this->codeSegment = $codeSegment;
    }

    /**
     * Returns the image
     *
     * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Sets the image
     *
     * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $image
     *
     * @return void
     */
    public function setImage(\TYPO3\CMS\Extbase\Domain\Model\FileReference $image)
    {
        $this->image = $image;
    }

    /**
     * Returns the hint
     *
     * @return string $hint
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * Sets the hint
     *
     * @param string $hint
     *
     * @return void
     */
    public function setHint($hint)
    {
        $this->hint = $hint;
    }

    /**
     * Returns the dependency
     *
     * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency $dependency
     */
    public function getDependency()
    {
        return $this->dependency;
    }

    /**
     * Sets the dependency
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency $dependency
     *
     * @return void
     */
    public function setDependency(\S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency $dependency)
    {
        $this->dependency = $dependency;
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
     * Returns the pricingPercentage
     *
     * @return float $pricingPercentage
     */
    public function getPricingPercentage()
    {
        return $this->pricingPercentage;
    }

    /**
     * Sets the pricingPercentage
     *
     * @param float $pricingPercentage
     */
    public function setPricingPercentage($pricingPercentage)
    {
        $this->pricingPercentage = $pricingPercentage;
    }

    /**
     * Returns the currencyPricing
     *
     * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Price $currencyPricing
     */
    public function getCurrencyPricing()
    {
        return $this->currencyPricing;
    }

    /**
     * Sets the currencyPricing
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency
     * @param array                                               $settings
     */
    public function setCurrencyPricing(\S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency = null, array $settings = [])
    {
        if ($currency instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency) {
            \S3b0\EcomConfigCodeGenerator\Utility\PriceHandler::setPriceInCurrency($this, $currency, $settings);
        }
    }

    /**
     * Returns the noCurrencyPricing
     *
     * @return float $noCurrencyPricing
     */
    public function getNoCurrencyPricing()
    {
        return $this->noCurrencyPricing;
    }

    /**
     * Sets the noCurrencyPricing
     *
     * @param float $noCurrencyPricing
     */
    public function setNoCurrencyPricing($noCurrencyPricing)
    {
        $this->noCurrencyPricing = $noCurrencyPricing;
    }

    /**
     * Returns the differencePricing
     *
     * @return string $differencePricing
     */
    public function getDifferencePricing()
    {
        if ($this->partGroup->isMultipleSelectable()) {
            $value = $this->noCurrencyPricing * ($this->active ? -1 : 1);
        } else {
            if ($this->active) {
                $value = $this->noCurrencyPricing * -1;
            } else {
                $value = $this->noCurrencyPricing - $this->partGroup->getPricingNumeric();
            }
        }
        $value = \S3b0\EcomConfigCodeGenerator\Utility\PriceHandler::getPriceInCurrency($value, $this->partGroup->getConfiguration()->getCurrency(), true);

        return $value;
    }

    /**
     * Sets the differencePricing
     *
     * @param string $differencePricing
     */
    public function setDifferencePricing($differencePricing)
    {
        $this->differencePricing = $differencePricing;
    }

    /**
     * Returns the part group
     *
     * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
     */
    public function getPartGroup()
    {
        return $this->partGroup;
    }

    /**
     * Sets the part group
     *
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup
     *
     * @return void
     */
    public function setPartGroup(\S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup)
    {
        $this->partGroup = $partGroup;
    }

    /**
     * @return boolean $active
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @param boolean $active
     */
    public function setActive($active)
    {
        $this->active = $active;
    }

    /**
     * @return integer $modalTrigger
     */
    public function getModalTrigger()
    {
        return $this->modalTrigger;
    }

    /**
     * @param integer $modalTrigger
     */
    public function setModalTrigger($modalTrigger)
    {
        $this->modalTrigger = $modalTrigger;
    }

    /**
     * @return string
     */
    public function getShortDescription()
    {
        return $this->shortDescription;
    }

    /**
     * @param string $shortDescription
     */
    public function setShortDescription($shortDescription)
    {
        $this->shortDescription = $shortDescription;
    }

}