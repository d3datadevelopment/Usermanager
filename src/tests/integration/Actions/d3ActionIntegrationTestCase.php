<?php

/**
 * This Software is the property of Data Development and is protected
 * by copyright law - it is NOT Freeware.
 *
 * Any unauthorized use of this software without a valid license
 * is a violation of the license agreement and will be prosecuted by
 * civil and criminal law.
 *
 * https://www.d3data.de
 *
 * @copyright (C) D3 Data Development (Inh. Thomas Dartsch)
 * @author    D3 Data Development - Daniel Seifert <support@shopmodule.com>
 * @link      https://www.oxidmodule.com
 */
namespace D3\Usermanager\tests\integration\Actions;

use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\Application\Model\d3usermanager_execute;
use D3\Usermanager\Application\Model\d3usermanager_listgenerator;
use D3\Usermanager\Application\Model\d3usermanager_touserassignment;
use D3\Usermanager\tests\integration\d3IntegrationTestCase;
use Exception;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Model\ListModel;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit_Framework_MockObject_MockObject;

abstract class d3ActionIntegrationTestCase extends d3IntegrationTestCase
{
    /**
     * @param array $aUserIdList
     *
     * @return ListModel
     * @throws Exception
     */
    public function getResultList( $aUserIdList = array())
    {
        /** @var ListModel $oList */
        $oList = d3GetModCfgDIC()->get('d3ox.usermanager.'.ListModel::class);
        $oList->init(User::class);

        foreach ( $aUserIdList as $sId) {
            /** @var User $oUser */
            $oUser = d3GetModCfgDIC()->get('d3ox.usermanager.'.User::class);
            $oUser->load($sId);
            $oList->offsetSet($oUser->getId(), $oUser);
        }

        return $oList;
    }

    /**
     * @param d3usermanager $oManager
     * @return d3usermanager_listgenerator|PHPUnit_Framework_MockObject_MockObject
     */
    public function getListGenerator(d3usermanager $oManager)
    {
        /** @var d3usermanager_listgenerator|PHPUnit_Framework_MockObject_MockObject $oListGeneratorMock */
        $oListGeneratorMock = $this->getMockBuilder(d3usermanager_listgenerator::class)
            ->setMethods(['getConcernedItems'])
            ->setConstructorArgs([$oManager])
            ->getMock();
        $oListGeneratorMock->method('getConcernedItems')->willReturn($this->getFilledResultList());

        return $oListGeneratorMock;
    }

    abstract public function getFilledResultList();

    /**
     * @param d3usermanager $oManager
     * @return d3usermanager_touserassignment|MockObject
     */
    public function getManagerAssignmentMock(d3usermanager $oManager)
    {
        $oAssignmentMock = $this->getMockBuilder(d3usermanager_touserassignment::class)
            ->setMethods(['setAssignment'])
            ->setConstructorArgs([$oManager])
            ->getMock();
        $oAssignmentMock->method('setAssignment')->willReturn(true);

        return $oAssignmentMock;
    }

    /**
     * @param d3usermanager $oConfiguredManager
     * @return d3usermanager_execute|PHPUnit_Framework_MockObject_MockObject
     */
    public function getExecuteMock(d3usermanager $oConfiguredManager)
    {
        /** @var d3usermanager_execute|PHPUnit_Framework_MockObject_MockObject $oExecute */
        $oExecute = $this->getMockBuilder(d3usermanager_execute::class)
            ->setMethods(['getManagerAssignmentInstance'])
            ->setConstructorArgs([$oConfiguredManager])
            ->getMock();
        $oExecute->method('getManagerAssignmentInstance')->willReturn($this->getManagerAssignmentMock($oExecute->getManager()));

        return $oExecute;
    }
}
