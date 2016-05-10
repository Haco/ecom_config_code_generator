<?php
/**
 * Created by PhpStorm.
 * User: S3b0
 * Date: 09/09/15
 * Time: 8:45 AM
 */

namespace S3b0\EcomConfigCodeGenerator\Session;

/**
 * Class ManageConfiguration
 *
 * @package S3b0\EcomConfigCodeGenerator\Session
 */
class ManageConfiguration
{
    /**
     * @param \S3b0\EcomConfigCodeGenerator\Controller\BaseController                                                 $controller
     * @param \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy|\S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part
     * @param array                                                                                                   $configuration
     * @param bool                                                                                                    $setPartGroupActive
     *
     * @return void
     */
    public static function addPartToConfiguration(\S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller, &$part, array &$configuration, $setPartGroupActive = true)
    {
        $partIsNull = $part === null;
        if ($partIsNull) {
            $pseudoPartGroup = new \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup(1, $controller->configuration);
            $part            = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part(null, 0, $pseudoPartGroup);
        }

        $partGroup = $part->getPartGroup();
        $temp = &$configuration[ $partGroup->getUid() ];

        // If is_empty_part option is selected, remove all parts
        if ($partGroup->isMultipleSelectable()) {
            foreach ($partGroup->getParts() as $partOfPartGroup) {
                /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $singlePart */
                if ($partOfPartGroup->getIsEmptyPart()) {
                    $partGroupUidWithEmptyOption = $partOfPartGroup->getPartGroup()->getUid();
                    $emptyOptionPartUid = $partOfPartGroup->getUid();
                    $emptyOptionPartSorting = $partOfPartGroup->getSorting();
                    break;
                }
            }

            if ($part->getIsEmptyPart() && !$part->getAccessory()) {
                $temp = [];
            }
            
            // If the current partGroup is the one with an empty-part-option & the current selected part is NOT the empty option
            // Than clear the empty option by its sorting identifier
            if ($partGroup->getUid() === $partGroupUidWithEmptyOption && $part->getUid() !== $emptyOptionPartUid) {
                unset($temp[$emptyOptionPartSorting]);
            }
        }

        // On accessory (pseudo) part group do
        if ($partGroup->getUid() === -1) {
            // Empty corresponding part group configuration if empty option (none [-1]) was chosen
            if ($partIsNull) {
                $temp = [];
            // Clear empty option (none [-1]) if any other option was chosen
            } else {
                unset($temp[-1]);
            }
        }

        // Add part
        if ($partGroup->isMultipleSelectable() === false) {
            $temp = [];
        }
        $temp[ $part->getSorting() ] = $part->getUid() ?: $part->getCodeSegment();
        $part->setActive(true);
        $partGroup->setActive($setPartGroupActive);
        $partGroup->addActivePart($part);

        $controller->feSession->store('config', $configuration);
    }

    /**
     * @param \S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part|null    $part
     * @param array                                                   $configuration
     *
     * @return void
     */
    public static function removePartFromConfiguration(\S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller, &$part, array &$configuration)
    {
        if ($part === null) {
            $pseudoPartGroup = new \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup(1, $controller->configuration);
            $part            = new \S3b0\EcomConfigCodeGenerator\Domain\Model\Part(null, 0, $pseudoPartGroup);
        }

        $temp = &$configuration[ $part->getPartGroup()->getUid() ];

        if (is_array($temp)) {
            // Handle Accessory.
            if ($part->getPartGroup()->getUid() === -1) {
                if (($key = array_search($part->getCodeSegment(), $temp)) !== false) {
                    unset($temp[ $key ]);
                }
            } elseif (($key = array_search($part->getUid(), $temp)) !== false) {
                unset($temp[ $key ]);
            }
        }
        $part->getPartGroup()->removeActivePart($part);
        if (sizeof($temp) === 0) {
            unset($configuration[ $part->getPartGroup()->getUid() ]);
            $part->getPartGroup()->setActive(false);
        }
        $part->setActive(false);

        $controller->feSession->store('config', $configuration);
    }

    /**
     * @param \S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller
     * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup    $partGroup
     * @param array                                                   $configuration
     *
     * @return void
     */
    public static function removePartGroupFromConfiguration(\S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller, \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup &$partGroup, array &$configuration)
    {
        if ($partGroup->getActiveParts() instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $partGroup->getActiveParts()->count()) {
            /** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
            foreach ($partGroup->getActiveParts() as $part) {
                $part->setActive(false);
            }
        }
        unset($configuration[ $partGroup->getUid() ]);
        $partGroup->setActiveParts(new \TYPO3\CMS\Extbase\Persistence\ObjectStorage());
        $partGroup->setActive(false);
        $controller->feSession->store('config', $configuration);
    }

    /**
     * @param \S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller
     *
     * @return void
     */
    public static function resetConfiguration(\S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller)
    {
        $controller->feSession->store('config', []);
    }

}