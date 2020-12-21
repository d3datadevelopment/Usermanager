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

namespace D3\Usermanager\tests\unit;

use D3\ModCfg\Application\Model\Configuration\d3_cfg_mod;
use D3\ModCfg\Application\Model\DependencyInjectionContainer\d3DicHandler;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Log\d3NullLogger;
use D3\ModCfg\Tests\unit\d3ModCfgUnitTestCase;
use D3\Usermanager\Application\Model\d3usermanager;
use Doctrine\DBAL\DBALException;
use Exception as ExceptionAlias;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use PHPUnit\Framework\MockObject\MockObject;
use Psr\Container\ContainerInterface;

abstract class d3UsermanagerUnitTestCase extends d3ModCfgUnitTestCase
{
    CONST D3CLI_COLOR_YELLOW    = "\033[33m";
    CONST D3CLI_COLOR_DEFAULT   = "\033[0m";

    protected $_sCurrentLicenseKeyBackup;

    public $sModId = 'd3usermanager';

    /**
     * setup basic requirements
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws ExceptionAlias
     */
    public function setUp()
    {
        parent::setUp();

        d3GetModCfgDIC()->set('d3.usermanager.log', d3GetModCfgDIC()->get(d3NullLogger::class));

        $this->_setLicenseKeyBackup(d3_cfg_mod::get($this->sModId)->getFieldData('oxserial'));
    }

    public function tearDown()
    {
        parent::tearDown();

        d3DicHandler::removeInstance();
    }

    /**
     * @param $sCurrKey
     */
    protected function _setLicenseKeyBackup($sCurrKey)
    {
        if (null === $this->_sCurrentLicenseKeyBackup) {
            $this->_sCurrentLicenseKeyBackup = $sCurrKey;
        }
    }

    /**
     * unvalid edition: testlicense, no feature bit set
     * @param d3usermanager|false $oManager
     * @return d3usermanager|null
     * @throws d3_cfg_mod_exception
     */
    protected function _setUnvalidEditionLicense($oManager = false)
    {
        return $this->_setModuleLicenseKey(
            '2G3v2==OWVsVXp5M0FrTDRZdW0rbUpGK1lRYUJDQnlBT1Vid1htYWE2NVZsMmR5Uk9QMmxYTFBZOUl4d
TVEUVVPMDZraG9FOG9BaGdkM2FBR3VYN3RJOWEyRTZmTks0cUV6aUVrSGxYL0diTlZjaU9TcmRSV1NHQ
mkrMDRsTmRvK2NYUnVySlhXV0xMczZnRHBiRXhYWVlBb1I0YVdnbDliL1NYd3FRQXhad09VQ1ZlL3pyR
DZrVDdRUzM0UHVsQStxaWQ2QzkxV0NON0ZvRGpPNkxIbGs4WHlIWG5LNmhzN0piR2RsN1p2RjYvWnJtZ
EswUHVJU3NzazhNVnRkdEJSVXpSL3puT01vNHpOQjJuTENHOXZGS0Z3RkxidzFlNGd5Z2xYZzROa2U4a
lZ3U2V5TG1qUFJVOU9NdGQ2S2pmRTJOWmxndDBZbEpRTW8vM25zODJoMXB2UDlyNFZaV2dPUlZGMmhBZ
UI0ZkxyQWJsV3JTVzlCTytYTGZHYUloTGUyeFd2WHNmekpSSVBvZVpZSDAzczZhNUxScmgrYVByRkt0c
EJTYTR2VEJBOXlIRlpvRVRrdWRGK3FGQjlrR3ZjelFET2g3eVdsUkl0ZHFWSG9RQjc3UVMrYnA1a3gzU
jVMRkZtcjc5T0dvb3RyNGNyV2FBNWhZWEdhU0VjZGdLSm1iN1dDeEZQb3NqZ3FFL2FyaC9aQkhKTXIyK
0N0UC96dHN3TlJvTURZbWl0ZS9sQzNBRWFvNzI4Rm1iNUplOWRtb01YTm1ISzJvKzdESXBsUUo5bjlKa
3RXdUlmVC8rQ0R3MVl4bU51ODE2SWRkTTVWMVdFUnZhcTZCVmNqUTlvMmtmSUVCbFEyOHZBd2NXRmFYY
TRTRytRdCtuVElZb3BMbGRTMTh1c0tiendJaTV4aTFDK2VFeUErWjJROGlRckhZczZUT3RQQ2V6V0g3N
WRON0srU1pPbUNQR2NWRWZhY3VDM2syWDVZTDJIOUMrN20vZkxoenNGcjJ3aEpqZGRMTWs2Z1VlMFdpR
zZ1K21sckxtUzh1aXNqVHROTHN5QXZzd2JTOHM1c0taQW8xbXN2QkYxeklQNnNtVXpNK3dDdW5CL2tNS
Hh4Wk1IaTg2OGZnaTV1dmFvUDhtNjMvZHJYYzcwMFpsL1JTL1dSRmxuRjN5UjJNeFlsZlRsS0QrS2I4R
FFEcDE3RjJVS3ZIdmVXMTNZS0JMeVJ4dmdNN1pkRUczcldaU1ZkZi9FRUxGeVhCVXgzUlc3MEdyOWNLc
0VmcXQx',
            $oManager
        );
    }

    /**
     * unvalid license: domain is mydomain.de, valid from 2000-01-01 00:00:00 to 2000-01-01 00:00:01
     * free, standard and premium edition is set
     * @param d3usermanager|false $oManager
     * @return d3usermanager|null
     * @throws d3_cfg_mod_exception
     */
    protected function _setUnvalidLicense($oManager = false)
    {
        return $this->_setModuleLicenseKey(
            'Mrcv2==c2tPR0xYTk81dFRvQWdGK0hlUEtMVzZ1VWlOakJNeG05OC9iNGd2RFV2ZCtwNkFwSVoxYk5hc
nZDb0ZKVndQNDBhYTYxQnU1R296bEdvM1F2L1lpd1lzK0tqL1F2SElRczRWVEpoUXBMK1cvSE42Mk52S
VJrSnJPOFNpa1dSditBRkdWL3FJcFgxWDFpYXU1RGhWRE1zaFpWWE8wRmtTVzJpUmVNZ2FvVC9vU1BHe
Xg4MVFCM2FhN0VuNVFKSWRDa3M3SVdkTERiQzNPTWdPM1N3cWpaUDl3ZllXNWFlcTFsTEFxR0kxUEIrN
m9hbkV2L0pUaTJGRlJVVUdLYkd1dzllSWxBckE2RHpFUmFUbTBwVHV3enNTWXpKb0xvbXY5M1NLTkh6Q
lZoazVkVVBoRFNPdVF0d1JtbldRNk9BR1NhNS9JVXY3cjl0Q0gzbDJjZ010RVdZR1VacVlwKzZZemdyd
jArSEZkRU1nNXRLenM3RU1CUzZRd0tDK2hqdGJWVUVrZllIZ3ZUUjdmSVFKTHU5aUJLSjB2dE54UzJWa
StNNVg1U2plY3JFc1JQMnhqZ0xpaGFZQkZJUi9hQnh3NE9UMkZMMlhvRTYxbzYwNEFFWjBnZERFWTQrU
WlJRS9vTE5OSXpEdzcxTkZhQS80bXBEUE1XejFTdXpBdEZhbGE1anlUc1k3OXJQbGdLdkVZVUlRQjNMd
ktsT3VhRDd5VmZqQmJzelU0RWZwZ0ZBVmNqUFJNMXlLOTgzNy9BRlhMeGN4QzVCQ29oUWtLbC9nRHpDW
HFUblRSYk1MQjhPRzNtVC9SeW5yd3BjRHVkQjBRSlFOMkNoMzVUSithYVVhTDRBUDVDRzAzVXhZeVdBc
U4zVzNhMElhZEd0Vmk2SUVYOWhVN2pqbHRiMmxiQmE3aU9YUXZWRmR1ZWNFdDI0OHJsYjZYTS8zL0tra
3VUelhpVGl6Z2xJTzFaT1RUVFJwRklkZnlYREkzMkZyc3pJazljdXhVRFR2WXNFY1h4eFAyKzRLZTJEb
XU3N1VuRk5zbkVlYjJ4K3M3eE44RUhKM2NvRDJDVkJZbm96WFQ4bHRTcG9DRVJYeXg1YzVyNjB6dUE0T
nFZUHdzd1FJdGlzcXBQaEY5V0x1YjVINVRLeWNTS2tsUklmZkRVZTB6TjBheElrQ1ZrK0IvcnlCZmdZV
HJIaFZwdVU3R3lVRzcreSszdFFCaUI2YkFKenB1WlhYbW1icVJlWU5nYXI0cytRZmZZcHcvOUc1bG8xV
m8vK1kx',
            $oManager
        );
    }

    /**
     * license is restricted to 1 executable job, all other restrictions are disabled
     * @param d3usermanager|false $oManager
     * @return d3usermanager|null
     * @throws d3_cfg_mod_exception
     */
    protected function _setJobRestrictedLicense($oManager = false)
    {
        return $this->_setModuleLicenseKey(
            'icjv2==ZHU5NFdxaVZnaXRtQktxR2pURW43TGZ4dkxabVFJNWJqTWkrTlpOR2VodDRvQlc3NHE1YUdqb
1VOSDhmVXIxNW0rQVF6UFR1Wk1rMDA1aVg4dCs2RUM2SGJ1ZzhCcjQwSytJSTFPWDQzZ2tjMFY4U2ZNQ
TJNRjIveitTL1lYZ0tIT0FjOWN2RTQ5WWZ0VHQydmFrc2YyM050TXdFdkFpVVBpSVlqOTh2QXYzdnBsc
VpNRlNDVXI0U2dDR2N6RXNsTi9jSU91QXdiVHRZeG01Kzd3N3dCY1owdlQzSlp6eDIvOVFkbmpkL1dMT
2RiR1E3V05uZWMwN1AwdC9PWGQwZ21rSGIyWjBGNzcweGgyU3ViZ1F2WkJrcTFxdk9oN2ZsaFFSVVV3c
0tpaEgzc2FDZDhlcHZTZi9YNkllZ3ZqMFEyVWh3b0ZqYjk1S295VGw1R1Y5TUZWYnNLT1JHdVFoamE5c
nZBWkVMcnJvdmxuWjA3WHhoKytZL21VdXp0dndYY1RjVG5LdmVUUUNTaGZZdzZZMWNMYUduUTNIa0dHO
HpobkZmdjVhZFIrYW9kVlBzL1JuN0F4cGVOQXJTTmVLdWFqN1NScDNicTNGS2xxZThFUjRSRmpKYmROS
HNIQWdlQVZwV3lXY0JrYVJ4NE42VDFGenBSc0pGUkk3UXBUOEhBdWZ2SWxvS2IyaEZCbU56OHI0OE5sb
i85MkhGYktEcGVJb0xNa0xTUEF0cExmNmR6ZHp4a3lyKzRzWkFEcURnNkRTSk52aWd1UlVKWkt3V2JIQ
W9oY1VkQTlabDROaHM3QXRYd1V1WjR4Q2RPRTNsMTVpYVd4c2MrUTUybHN4OGhIYXJ1ZHlSMGMzUm1mS
lNFL0tTZjhCRFVTc0JuRnNBVFRxNGtTSU1ubzlHcTlWbjIxeC9YUm4xQ3JKOXhGdlkyTmlYa2kxYk00U
3BsSjk1R04rWlhURnVhaTFRbjBLellYcTBiUGxRM2p3S0VBSWhsOGFuSFJUZXp0QTJYK1VPYkhaMnRYb
2dJSSsvRHVmSmJIM2VJQktZeGpTc3JIREp3QmpZczZCeHpNK0h4NzA3b3RENEpjMHpRZXFGNTRpbzZTR
VpyQVIvQnVtUFJab0VhTlNBOWxvK0VnVnB4emhiZkpzWFZpMWRrZWUyMXRnckYrcFRQVWk5NHNJa3dOd
S9VMnBRNENKZkF2WmVPZnNzNkV6TmZrTkRob0VNWjdUMklFWU0zU1ZEUkJaeTVUSXR6a0JtbHNkVk0we
WIyZ2Nk',
            $oManager
        );
    }

    /**
     * @param null $oManager
     * @return d3usermanager|null
     * @throws d3_cfg_mod_exception
     */
    protected function _setCustomerLicense($oManager = null)
    {
        if ($this->_sCurrentLicenseKeyBackup) {
            $oReturnManager = $this->_setModuleLicenseKey($this->_sCurrentLicenseKeyBackup, $oManager);

            if ($oManager) {
                return $oReturnManager;
            }
        }

        return null;
    }

    /**
     * @param $sLicenseKey
     * @param d3usermanager|null $oManager
     * @return d3usermanager|null
     * @throws d3_cfg_mod_exception
     */
    abstract protected function _setModuleLicenseKey($sLicenseKey, $oManager = null);

    /**
     * @param $serviceName
     * @param $serviceMock
     *
     * @return MockObject
     */
    protected function getContainerMock($serviceName, $serviceMock)
    {
        $container = $this->getMockBuilder(ContainerInterface::class)
                          ->setMethods(['get', 'has'])
                          ->getMock();
        $container->expects($this->any())
                  ->method('get')
                  ->with($this->equalTo($serviceName))
                  ->will($this->returnValue($serviceMock));

        return $container;
    }
}
