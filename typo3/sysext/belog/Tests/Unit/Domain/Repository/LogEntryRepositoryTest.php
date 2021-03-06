<?php
namespace TYPO3\CMS\Belog\Tests\Unit\Domain\Repository;

/***************************************************************
 * Copyright notice
 *
 * (c) 2012-2013 Oliver Klee <typo3-coding@oliverklee.de>
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Test case
 */
class LogEntryRepositoryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @test
	 */
	public function initializeObjectSetsRespectStoragePidToFalse() {
		/** @var \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings $querySettings */
		$querySettings = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QuerySettingsInterface');
		$objectManager = $this->getMock('TYPO3\\CMS\\Extbase\\Object\\ObjectManagerInterface');
		$objectManager->expects($this->any())->method('get')->with('TYPO3\\CMS\\Extbase\\Persistence\\Generic\\QuerySettingsInterface')->will($this->returnValue($querySettings));
		$GLOBALS['TYPO3_DB'] = $this->getMock('TYPO3\\CMS\\Core\\Database\\DatabaseConnection', array(), array(), '', FALSE);
		$querySettings->expects($this->atLeastOnce())->method('setRespectStoragePage')->with(FALSE);
		/** @var \TYPO3\CMS\Belog\Domain\Repository\LogEntryRepository|\PHPUnit_Framework_MockObject_MockObject $subject */
		$subject = $this->getMock('TYPO3\\CMS\\Belog\\Domain\\Repository\\LogEntryRepository', array('setDefaultQuerySettings'), array($objectManager));
		$subject->expects($this->once())->method('setDefaultQuerySettings')->with($querySettings);
		$subject->initializeObject();
	}
}
