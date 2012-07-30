<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2012
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *  A copy is found in the textfile GPL.txt and important notices to the license
 *  from the author is found in LICENSE.txt distributed with these scripts.
 *
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/


/**
 * action controller.
 *
 * @author Susanne Moog <typo3@susannemoog.de>
 * @package Extension Manager
 * @subpackage Controller
 */
class Tx_Extensionmanager_Controller_UpdateFromTerController extends Tx_Extensionmanager_Controller_AbstractController {

	/**
	 * @var Tx_Extensionmanager_Utility_Repository_Helper
	 */
	protected $repositoryHelper;

	/**
	 * @var Tx_Extensionmanager_Domain_Repository_RepositoryRepository
	 */
	protected $repositoryRepository;

	/**
	 * Dependency injection of the Repository Helper Utility
	 *
	 * @param Tx_Extensionmanager_Utility_Repository_Helper $repositoryHelper
	 * @return void
	 */
	public function injectExtensionRepository(Tx_Extensionmanager_Utility_Repository_Helper $repositoryHelper) {
		$this->repositoryHelper = $repositoryHelper;
	}

	/**
	 * @param Tx_Extensionmanager_Domain_Repository_RepositoryRepository $repositoryRepository
	 * @return void
	 */
	public function injectRepositoryRepository(Tx_Extensionmanager_Domain_Repository_RepositoryRepository $repositoryRepository) {
		$this->repositoryRepository = $repositoryRepository;
	}

	/**
	 * Update extension list from TER
	 *
	 * @return void
	 */
	public function updateExtensionListFromTerAction() {
		$updated = FALSE;
		$forceUpdateCheck = FALSE;
		if ($this->request->hasArgument('forceUpdateCheck') && (int)$this->request->getArgument('forceUpdateCheck') == 1) {
			$forceUpdateCheck = TRUE;
		}
		/** @var $repository Tx_Extensionmanager_Domain_Model_Repository */
		$repository = $this->repositoryRepository->findOneByUid((int)$this->settings['repositoryUid']);
		//if ($repository->getLastUpdate() < ($GLOBALS['EXEC_TIME'] - 24 * 60 * 60) || $forceUpdateCheck) {
		if ($repository->getLastUpdate() < ($GLOBALS['EXEC_TIME'] - 24 * 60 * 60)) {
			$updated = $this->repositoryHelper->updateExtList();
		}
		$this->view->assign('updated', $updated)
			->assign('repository', $repository);
	}




}