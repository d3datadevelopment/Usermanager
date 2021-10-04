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

namespace D3\Usermanager\tests\unit\Application\Controller\Admin;

use D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerlog;
use D3\Usermanager\Application\Model\d3usermanager;
use D3\Usermanager\tests\unit\d3UsermanagerUnitTestCase;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use ReflectionException;

class d3_cfg_usermanagerlogTest extends d3UsermanagerUnitTestCase
{
    /** @var d3_cfg_usermanagerlog */
    protected $_oController;

    /**
     * setup basic requirements
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws Exception
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->_oController = d3GetModCfgDIC()->get(d3_cfg_usermanagerlog::class);
    }

    public function tearDown() : void
    {
        parent::tearDown();

        unset($this->_oController);
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerlog::d3getAdditionalUrlParams
     * @test
     * @throws ReflectionException
     */
    public function additionalUrlParamsPass()
    {
        $this->assertIsString($this->callMethod($this->_oController, 'd3getAdditionalUrlParams')
        );
    }

    /**
     * @covers \D3\Usermanager\Application\Controller\Admin\d3_cfg_usermanagerlog::d3getAdditionalUrlParams
     * @test
     * @throws ReflectionException
     */
    public function additionalUrlParamsWithModIdPass()
    {
        $this->setValue($this->_oController, '_sModId', 'testid');
        $this->assertStringContainsStringIgnoringCase(
            'testid',
            $this->callMethod($this->_oController, 'd3getAdditionalUrlParams')
        );
    }

    /**
     * @param $sLicenseKey
     * @param d3usermanager $oManager
     * @return null
     */
    protected function _setModuleLicenseKey($sLicenseKey, $oManager = null)
    {
        return null;
    }
}