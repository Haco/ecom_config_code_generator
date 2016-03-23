<?php
namespace S3b0\EcomConfigCodeGenerator\Domain\Repository;


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
 * The repository for Currencies
 */
class CurrencyRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Set repository wide settings
     */
    public function initializeObject()
    {
        /** @var \TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface $querySettings */
        $querySettings = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\QuerySettingsInterface::class);
        $querySettings->setRespectStoragePage(false); // Disable storage pid
        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * @param array $settings
     *
     * @return \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency
     */
    public function getDefault(array $settings = [])
    {
        $currencies = $this->findAll();
        /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $default */
        $default = $currencies->getFirst();
        if (sizeof($currencies) > 1 && $settings[ 'defaultCurrency' ]) {
            /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Currency $currency */
            foreach ($currencies as $currency) {
                if ($currency->getUid() == $settings[ 'defaultCurrency' ]) {
                    $default = $currency;
                }
            }
        }

        return $default;
    }

}