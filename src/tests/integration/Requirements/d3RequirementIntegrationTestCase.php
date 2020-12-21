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
namespace D3\Usermanager\tests\integration\Requirements;

use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\tests\integration\d3IntegrationTestCase;
use Doctrine\DBAL\DBALException;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use PHPUnit_Framework_MockObject_MockObject;

abstract class d3RequirementIntegrationTestCase extends d3IntegrationTestCase
{
    /**
     * @param $sManagerId
     * @return d3usermanager|PHPUnit_Framework_MockObject_MockObject
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     */
    public function getManagerMock($sManagerId)
    {
        /** @var d3usermanager|PHPUnit_Framework_MockObject_MockObject $oManager */
        $oManager = $this->getMockBuilder(d3usermanager::class)
            ->setMethods(['d3getLog'])
            ->getMock();
        $oManager->method('d3getLog')->willReturn($this->getD3LogMock());
        $oManager->load($sManagerId);

        $oManager->d3getModCfg()->setValue('iMaxUserCnt', 2000);

        return $oManager;
    }
}
