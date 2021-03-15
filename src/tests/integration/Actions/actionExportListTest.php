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

use D3\ModCfg\Application\Model\d3filesystem;
use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\Usermanager\Application\Model\d3usermanager;
use DateTime;
use Doctrine\DBAL\DBALException;
use Exception;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\ListModel;
use OxidEsales\Eshop\Core\Registry;

class actionExportListTest extends d3ActionIntegrationTestCase
{
    public $sManagerId = 'managerTestId';

    public $aUserIdList = array(
        'userTestIdNo1',
        'userTestIdNo2',
    );

    public $given    = 'CurrentCity';
    public $expected = 'TestCity';

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $this->createManager($this->sManagerId);

        $this->createUser(
            $this->aUserIdList[0],
            [
                'oxcity'   => $this->given,
                'oxlname'  => 'User1',
                'oxfname'  => __METHOD__
            ]
        );

        $this->createUser(
            $this->aUserIdList[1],
            [
                'oxcity'   => $this->given,
                'oxlname'  => 'User2',
                'oxfname'  => __METHOD__
            ]
        );
    }

    /**
     * @throws DBALException
     */
    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);
        $this->deleteUser($this->aUserIdList[0]);
        $this->deleteUser($this->aUserIdList[1]);
    }

    /**
     * @return d3usermanager
     * @throws Exception
     */
    public function getConfiguredManager()
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionExport_status', true);
        $oManager->setValue('aExportFieldList', ['oxid', 'oxlname']);
        $oManager->setValue('sExportListFromTheme', 'module');
        $oManager->setValue('sExportListFromModulePath', 'd3usermanager');
        $oManager->setValue('sExportTemplatename', 'Application/views/admin/tpl/export-templates/CSV-Vorlage.tpl');
        $oManager->setValue('sExportExtension', '.txt');
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @test
     * @throws DBALException
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     * @throws Exception
     */
    public function actionChangeConcernedUser()
    {
        $oExecute = $this->getExecuteMock($this->getConfiguredManager());
        $oExecute->startJobItemExecution();

        $time = new DateTime();
        /** @var d3filesystem $filesystem */
        $filesystem = d3GetModCfgDIC()->get(d3filesystem::class);
        foreach ([
            $time->format('Y-m-d_H-i-s'),
            $time->modify("-1 second")->format('Y-m-d_H-i-s'),
            $time->modify("-2 second")->format('Y-m-d_H-i-s')
        ] as $date) {
            $fileName = "d3usermananger_userManagerTestTitle_".$date.".txt";
            $fileName = $filesystem->filterFilename($fileName);
            $filePath = Registry::getConfig()->getConfigParam('sShopDir').'/export/'.$fileName;
            if (file_exists($filePath)) {
                $this->assertSame(
                    '"oxid","oxlname"'.PHP_EOL.'"userTestIdNo1","User1"'.PHP_EOL,
                    file_get_contents($filePath)
                );
                unlink($filePath);
                break;
            }
        }

    }

    /**
     * @return ListModel
     * @throws Exception
     */
    public function getFilledResultList()
    {
        return $this->getResultList(array($this->aUserIdList[0]));
    }
}
