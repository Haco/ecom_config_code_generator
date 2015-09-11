<?php
namespace S3b0\EcomConfigCodeGenerator\Controller;


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
use TYPO3\CMS\Core\Utility\ArrayUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Extbase\Utility\LocalizationUtility;

/**
 * Class BaseController
 * @package S3b0\EcomConfigCodeGenerator\Controller
 */
class BaseController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Content
	 */
	protected $contentObject = NULL;

	/**
	 * feSession
	 *
	 * @var \Ecom\EcomToolbox\Domain\Session\FrontendSessionHandler
	 * @inject
	 */
	public $feSession;

	/**
	 * contentRepository
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\ContentRepository
	 * @inject
	 */
	protected $contentRepository;

	/**
	 * partGroupRepository
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\PartGroupRepository
	 * @inject
	 */
	protected $partGroupRepository;

	/**
	 * partRepository
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\PartRepository
	 * @inject
	 */
	protected $partRepository;

	/**
	 * currencyRepository
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\CurrencyRepository
	 * @inject
	 */
	protected $currencyRepository;

	/**
	 * logRepository
	 *
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Repository\LogRepository
	 * @inject
	 */
	protected $logRepository;

	/**
	 * frontendUserRepository
	 *
	 * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
	 * @inject
	 */
	protected $frontendUserRepository;

	/**
	 * @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration
	 */
	protected $configuration = NULL;

	/**
	 * @var boolean Indicate if pricing is active or not
	 */
	protected $pricing = FALSE;

	/**
	 * Initializes the controller before invoking an action method.
	 *
	 * Override this method to solve tasks which all actions have in
	 * common.
	 *
	 * @return void
	 * @api
	 *
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\UnsupportedRequestTypeException
	 */
	public function initializeAction() {
		// Fetch content object
		$this->contentObject = $this->contentObject ?: $this->contentRepository->findByUid($this->configurationManager->getContentObject()->data['uid']);
		if ( !$this->contentObject instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Content )
			$this->throwStatus(404, NULL, '<h1>' . LocalizationUtility::translate('404.noContentObject', $this->extensionName) . '</h1>' . LocalizationUtility::translate('404.message.noContentObject', $this->extensionName, [ "<a href=\"mailto:{$this->settings['webmasterEmail']}\">{$this->settings['webmasterEmail']}</a>" ]));
		// Fetch configuration
		$this->configuration = $this->contentObject->getCcgConfiguration();
		if ( !$this->configuration instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Configuration && !$this->configuration instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy )
			$this->throwStatus(404, NULL, '<h1>' . LocalizationUtility::translate('404.noConfiguration', $this->extensionName) . '</h1>' . LocalizationUtility::translate('404.message.noConfiguration', $this->extensionName, [ "<a href=\"mailto:{$this->settings['webmasterEmail']}\">{$this->settings['webmasterEmail']}</a>" ]));
		if ( !$this->configuration->getPartGroups()->count() )
			$this->throwStatus(404, NULL, '<h1>' . LocalizationUtility::translate('404.noPartGroups', $this->extensionName) . '</h1>' . LocalizationUtility::translate('404.message.noPartGroups', $this->extensionName, [ "<a href=\"mailto:{$this->settings['webmasterEmail']}\">{$this->settings['webmasterEmail']}</a>" ]));

		$this->pricing = $this->configuration->isPricingEnabled() && \Ecom\EcomToolbox\Security\Frontend::checkForUserRoles($this->settings['accessPricing']);

		// Frontend-Session
		$this->feSession->setStorageKey(Setup::getSessionStorageKey($this->contentObject));
		// On reset destroy config session data
		if ( $this->request->getControllerActionName() === 'reset' ) {
			$this->feSession->delete('config');
			$this->redirectToUri($this->uriBuilder->build());
		}
		// Set currency, if any
		if ( GeneralUtility::_GET('currency') && !$this->feSession->get('currency') )
			$this->feSession->store('currency', GeneralUtility::_GET('currency'));
		// Redirect to currency selection if pricing enabled
		if ( $this->pricing && $this->request->getControllerActionName() != 'currencySelect' && !$this->feSession->get('currency') )
			$this->forward('currencySelect');
	}

	/**
	 * Initializes the view before invoking an action method.
	 *
	 * Override this method to solve assign variables common for all actions
	 * or prepare the view in another way before the action is called.
	 *
	 * @param \TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view The view to be initialized
	 *
	 * @return void
	 * @api
	 */
	public function initializeView(\TYPO3\CMS\Extbase\Mvc\View\ViewInterface $view) {
		$this->view->assign('contentObject', $this->contentObject);
		$this->view->assign('pricingEnabled', $this->pricing);
		$this->view->assign('jsData', [
			'controller' => $this->request->getControllerName(),
			'pageId' => $GLOBALS['TSFE']->id,
			'contentObject' => $this->contentObject->_getProperty('_localizedUid'),
			'sysLanguage' => (int) $GLOBALS['TSFE']->sys_language_content
		]);
	}

	/**
	 * Initialize part groups
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage         $partGroups
	 * @param array                                                $configuration
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $current
	 * @param integer                                              $progress
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	protected function initializePartGroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $partGroups, array &$configuration, \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup &$current = NULL, &$progress = 0) {
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $current */
		$current = NULL;   // Current part group
		$previous = NULL;  // Previous part group (NEXT as of array_reverse)
		$cycle = 1;        // Count loop cycles
		$locked = 0;       // Count locked items, still visible!
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
		foreach ( array_reverse($partGroups->toArray()) as $partGroup ) {
			/**
			 * Handle locked part groups
			 * They might have a default part set (mostly used as code placeholder)
			 * If any, add them to configuration. Keep them as long as they are set visible.
			 * No further processing necessary, so continue!
			 */
			if ( $partGroup->isLocked() ) {
				if ( $partGroup->hasDefaultPart() ) {
					\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::addPartToConfiguration(
						$this,
						$partGroup->getDefaultPart() instanceof \TYPO3\CMS\Extbase\Persistence\Generic\LazyLoadingProxy ? $partGroup->getDefaultPart()->_loadRealInstance() : $partGroup->getDefaultPart(),
						$configuration
					);
					$locked++;
					$cycle++;
				} else {
					$partGroups->detach($partGroup);
				}
				continue;
			}
			/**
			 * Add dependent notes, if any.
			 * Dependent notes may appear if a trigger part has been added to configuration.
			 * Just like Modals, but displayed inline.
			 */
			if ( $partGroup->getDependentNotes() instanceof \Countable && $partGroup->getDependentNotes()->count() ) {
				/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\DependentNote $dependentNote */
				foreach ( $partGroup->getDependentNotes() as $dependentNote ) {
					if ( $dependentNote->getDependentParts()->count() ) {
						$logicalAnd = $dependentNote->isUseLogicalAnd();
						$addMessage = FALSE;
						/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $dependentPart */
						foreach ( $dependentNote->getDependentParts() as $dependentPart ) {
							if ( is_array($configuration[$partGroup->getUid()]) && in_array($dependentPart->getUid(), $configuration[$partGroup->getUid()]) ) {
								$addMessage = TRUE;
								if ( !$logicalAnd ) {
									break;
								}
							} else {
								if ( $logicalAnd ) {
									$addMessage = FALSE;
									break;
								}
							}
						}
						if ( $addMessage ) {
							$partGroup->addDependentNotesFluidParsedMessage($dependentNote->getNote());
						}
					}
				}
			}
			/**
			 * Check for active packages, set corresponding sate and fill ObjectStorage
			 */
			if ( array_key_exists($partGroup->getUid(), $configuration) && is_array($configuration[$partGroup->getUid()]) ) {
				// First of all check dependencies and unset parts, if not valid anymore
				foreach ( $configuration[$partGroup->getUid()] as $partUid ) {
					/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
					$part = $this->partRepository->findByUid($partUid);
					if ( self::checkForPartDependencies($this, $part, $configuration) ) {
						\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::addPartToConfiguration($this, $part, $configuration);
					} else {
						\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::removePartFromConfiguration($this, $part, $configuration);
					}
				}
				$originallyAvailablePartsAmount = $partGroup->getParts()->count();
				$this->initializeParts(
					$partGroup->getParts(),
					$configuration
				);
				/**
				 * Reset part if availability has been affected by dependencies
				 */
				if ( $partGroup->getParts()->count() !== $originallyAvailablePartsAmount && $partGroup->getParts()->count() === 1 ) {
					$partGroup->setSelectable(FALSE);
					\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::removePartGroupFromConfiguration($this, $partGroup, $configuration);
					\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::addPartToConfiguration($this, $partGroup->getParts()->toArray()[0], $configuration);
				}
				$partGroup->setUnlocked($partGroup->getParts()->count() > 1);
				if ( !$partGroup->isUidInParts($configuration[$partGroup->getUid()]) ) {
					$current = $partGroup;
				}
			} else {
				$current = $partGroup;
			}
			$partGroup->setNext($previous);
			/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $previous */
			$previous = $partGroup;
			$cycle++;
		}
		$cycle = 0;
		foreach ( $partGroups as $partGroup ) {
			$partGroup->setStepIndicator($partGroup->isVisibleInNavigation() ? ++$cycle : 0);
		}
		$this->feSession->store('config', $configuration);

		// Get progress state update (ratio of active to visible packages) => float from 0 to 1 (*100 = %)
		$progress = ( sizeof($configuration) - $locked ) / ( $partGroups->count() - $locked );

		// Initially use first package
		if ( $progress < 1 && !$current instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup ) {
			$current = $partGroup;
		}

		return $partGroups;
	}

	/**
	 * @param \S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller Ensure an Instance of extensions BaseController is given to provide necessary injections
	 * @param array                                                   $list
	 *
	 *@return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
	 */
	protected static function getAndSetActivePartsForPartGroup(\S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller, array $list) {
		$objectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		if ( $parts = $controller->partRepository->findByList($list) ) {
			/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
			foreach ( $parts as $part ) {
				$part->setActive(TRUE);
				$objectStorage->attach($part);
			}
		}

		return $objectStorage;
	}

	/**
	 * Initialize parts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage       $parts
	 * @param array                                              $configuration
	 * @return void
	 */
	public function initializeParts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage &$parts, array $configuration) {
		$partsToBeRemoved = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
		foreach ( $parts as $part ) {
			/** HANDLE DEPENDENCIES */
			if ( self::checkForPartDependencies($this, $part, $configuration) === FALSE ) {
				$partsToBeRemoved->attach($part);
			}
		}

		$parts->removeAll($partsToBeRemoved);
	}

	/**
	 * @param \S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller    Ensure an Instance of extensions BaseController is given to provide necessary injections
	 * @param \S3b0\EcomConfigCodeGenerator\Domain\Model\Part         $part
	 * @param array                                                   $configuration
	 * @return boolean                                                Returns FALSE if dependency check failed
	 */
	protected static function checkForPartDependencies(\S3b0\EcomConfigCodeGenerator\Controller\BaseController $controller, \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part, array $configuration) {
		$check = TRUE;
		if ( !$part->getDependency() instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency )
			return $check;

		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency $dependency */
		$dependency = $part->getDependency();
		if ( $dependency instanceof \S3b0\EcomConfigCodeGenerator\Domain\Model\Dependency ) {
			/** @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage $partGroups */
			$partGroups = $dependency->getPartGroups();
			if ( $partGroups instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $partGroups->count() ) {
				$dependencyCheck = [ ];
				/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
				foreach ( $partGroups as $partGroup ) {
					$partGroupCheck = [ ];
					// If part group has no part selected or dependency has no parts selected for current group
					if ( !array_key_exists($partGroup->getUid(), $configuration) || sizeof($dependency->getPartsByPartGroup($partGroup)) === 0 )
						continue;
					// Fetch selected parts for comparison
					$selectedParts = $controller->partRepository->findByList($configuration[$partGroup->getUid()]);
					// Start actual dependency check
					if ( $selectedParts instanceof \Countable && $selectedParts->count() ) {
						// Loop selected parts; fill $partGroupCheck array
						/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $selectedPart */
						foreach ( $selectedParts as $selectedPart ) {
							$partGroupCheck[] = $dependency->getPartsByPartGroup($partGroup)->contains($selectedPart);
						}
					}
					$dependencyCheck[] = in_array(TRUE, $partGroupCheck);
				}
				$check = $dependency->getMode() === 1 ? !in_array(FALSE, $dependencyCheck) : in_array(FALSE, $dependencyCheck);
			}
		}

		return $check;
	}

	/**
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\S3b0\EcomConfigCodeGenerator\Domain\Model\Part> $storage
	 * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
	 */
	protected function automaticallySetPartIfNoAlternativeExists(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $storage = NULL) {
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
		$part = $storage->toArray()[0];
		if ( $storage instanceof \TYPO3\CMS\Extbase\Persistence\ObjectStorage && $storage->count() === 1 ) {
			\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::removePartGroupFromConfiguration($this, $part->getPartGroup(), $this->feSession->get('config') ?: [ ]);
			\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::addPartToConfiguration($this, $part, $this->feSession->get('config') ?: [ ]);

			$arguments = $this->request->getArguments();
			ArrayUtility::mergeRecursiveWithOverrule($arguments, [ 'partGroup' => $part->getPartGroup()->getNext() ]);
			$this->forward('index', NULL, NULL, $arguments);
		}
	}

	/**
	 * @param array $configuration
	 * @return array
	 */
	protected function getConfigurationCode(array $configuration) {
		$summaryTableRows = [ ];
		$code = [ ];
		$blankCode = [ ];
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
		foreach ( $this->contentObject->getCcgConfiguration()->getPartGroups() as $partGroup ) {
			$parts = $configuration[$partGroup->getUid()];
			ksort($parts); // Order by sorting
			$segment = '';
			$partList = [ ];
			foreach ( $parts as $partUid ) {
				/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
				$part = $this->partRepository->findByUid($partUid);
				$partList[] = trim(($part->getTitle() !== "-" ? $part->getTitle() : "") . (strlen($part->getCodeSegment()) ? " [{$part->getCodeSegment()}]" : ""));
				$segment .= $part->getCodeSegment();
			}
			if ( $partGroup->getPlaceInCode() ) {
				$code[$partGroup->getPlaceInCode()] = "<span class=\"syntax-help\" title=\"{$partGroup->getTitle()}\">{$segment}</span>";
				$blankCode[$partGroup->getPlaceInCode()] = $segment;
			} else {
				$code[] = "<span class=\"syntax-help\" title=\"{$partGroup->getTitle()}\">{$segment}</span>";
				$blankCode[] = $segment;
			}
			if ( $partGroup->isVisibleInSummary() ) {
				/** @todo Add pricing information */
				$summaryTableRows[] = ("
					<td>{$partGroup->getStepIndicator()}</td>
					<td>{$partGroup->getTitle()}</td>
					<td>" . implode(', ', $partList) . "</td>
					<td>" . ($partGroup->isSelectable() ? "<a data-package=\"{$partGroup->getUid()}\" class=\"configurator-part-group-select\"><i class=\"fa fa-edit\"></i></a>" : "") . "</td>
				");
			}
		}
		ksort($code);
		ksort($blankCode);

		return [
			'code' => $this->contentObject->getCcgConfiguration()->getPrefix() . implode('', $code) . $this->contentObject->getCcgConfiguration()->getSuffix(),
			'blankCode' => $this->contentObject->getCcgConfiguration()->getPrefix() . implode('', $blankCode) . $this->contentObject->getCcgConfiguration()->getSuffix(),
			'summaryTable' => '<table><tr>' . implode('</tr><tr>', $summaryTableRows) . '</tr></table>'
		];
	}

	/**
	 * @param array $configuration
	 * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
	 */
	protected function addConfigurationLog(array $configuration) {
		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Log $log */
		$log = $this->objectManager->get(\S3b0\EcomConfigCodeGenerator\Domain\Model\Log::class);
		$ipLength = !MathUtility::canBeInterpretedAsInteger($this->settings['log']['ipLength']) || $this->settings['log']['ipLength'] > 4 ? 4 : $this->settings['log']['ipLength'];
		$code = [ ];

		/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\PartGroup $partGroup */
		foreach ( $this->contentObject->getCcgConfiguration()->getPartGroups() as $partGroup ) {
			$parts = $configuration[$partGroup->getUid()];
			ksort($parts); // Order by sorting
			$segment = '';
			foreach ( $parts as $partUid ) {
				/** @var \S3b0\EcomConfigCodeGenerator\Domain\Model\Part $part */
				$part = $this->partRepository->findByUid($partUid);
				$log->addConfiguredPart($part);
				$segment .= $part->getCodeSegment();
			}
			if ( $partGroup->getPlaceInCode() ) {
				$code[$partGroup->getPlaceInCode()] = $segment;
			} else {
				$code[] = $segment;
			}
		}
		ksort($code);

		$log->setConfiguration($this->contentObject->getCcgConfiguration()->getPrefix() . implode('', $code) . $this->contentObject->getCcgConfiguration()->getSuffix())
			->maskIpAddress($ipLength);
		if ( $GLOBALS['TSFE']->loginUser ) {
			/** @todo Add pricing */
			$log->setFeUser($this->frontendUserRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']));
		}

		// Write to DB and persist to obtain a uid for current log
		$this->logRepository->add($log);
		/** @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager $persistenceManager */
		$persistenceManager = $this->objectManager->get(\TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager::class);
		$persistenceManager->add($log);
		$persistenceManager->persistAll();

		\S3b0\EcomConfigCodeGenerator\Session\ManageConfiguration::resetConfiguration($this);
	}

	/**
	 * Minify All Output - based on the search and replace regexes.
	 * @param string $buffer Input string
	 * @return string
	 */
	protected function sanitize_output($buffer) {
		$search = [
			'/\>[^\S ]+/s', //strip whitespaces after tags, except space
			'/[^\S ]+\</s', //strip whitespaces before tags, except space
			'/(\s)+/s'  // shorten multiple whitespace sequences
		];
		$replace = [
			'>',
			'<',
			'\\1'
		];
		$buffer = preg_replace($search, $replace, $buffer);
		return $buffer;
	}

}