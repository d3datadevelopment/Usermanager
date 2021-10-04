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
namespace D3\Usermanager\tests\integration;

use D3\ModCfg\Application\Model\d3database;
use D3\ModCfg\Application\Model\Log\d3log;
use D3\ModCfg\Tests\unit\d3ModCfgUnitTestCase;
use D3\Usermanager\Application\Model\d3usermanager as Manager;
use D3\Usermanager\Application\Model\d3usermanager_listgenerator as Manager_Listgenerator;
use D3\Usermanager\Modules\Application\Model\d3_user_usermanager;
use Doctrine\DBAL\Exception as DoctrineException;
use Exception;
use OxidEsales\Eshop\Application\Model\Article;
use OxidEsales\Eshop\Application\Model\Groups;
use OxidEsales\Eshop\Application\Model\Order;
use OxidEsales\Eshop\Application\Model\OrderArticle;
use OxidEsales\Eshop\Application\Model\User;
use OxidEsales\Eshop\Core\Model\BaseModel;
use OxidEsales\Eshop\Core\Registry;
use PHPUnit\Framework\MockObject\MockObject;

abstract class d3IntegrationTestCase extends d3ModCfgUnitTestCase
{
    /**
     * Set up fixture.
     */
    public function setUp() : void
    {
        parent::setUp();

        $this->createTestData();
    }

    /**
     * Tear down fixture.
     */
    public function tearDown() : void
    {
        $this->cleanTestData();

        parent::tearDown();
    }

    abstract public function createTestData();

    abstract public function cleanTestData();

    /**
     * @param $sClass
     * @param $sId
     * @param array $aFields
     */
    public function createObject($sClass, $sId, $aFields = array())
    {
        /** @var BaseModel $oObject */
        $oObject = d3GetModCfgDIC()->get($sClass);

        if ($oObject->exists($sId)) {
            $oObject->delete($sId);
        }

        $oObject->setId($sId);
        $oObject->assign($aFields);
        $oObject->save();
    }

    /**
     * @param $sTableName
     * @param $sId
     * @param array $aFields
     * @throws Exception
     */
    public function createBaseModelObject($sTableName, $sId, $aFields = array())
    {
        /** @var BaseModel $oObject */
        $oObject = d3GetModCfgDIC()->get('d3ox.usermanager.'.BaseModel::class);
        $oObject->init($sTableName);
        $oObject->setId($sId);
        $oObject->assign($aFields);
        $oObject->save();
    }

    /**
     * @param $sId
     * @param array $aFields
     * @throws Exception
     */
    public function createArticle($sId, $aFields = array())
    {
        $this->createObject(
            'd3ox.usermanager.'.Article::class,
            $sId,
            array_merge(
                array('oxprice' => 0),
                $aFields
            )
        );
    }

    /**
     * @param $sId
     * @throws Exception
     */
    public function createManager($sId)
    {
        $this->createObject(
            Manager::class,
            $sId,
            array(
                'OXSHOPID'          => 1,
                'OXACTIVE'          => true,
                'OXTITLE'           => 'userManagerTestTitle',
                'OXMODID'           => 'd3usermanager',
                'D3_UM_MARKUSER'    => false,
            )
        );
    }

    /**
     * @param $sId
     * @param array $aFields
     * @param array $aOrderArticles
     * @throws Exception
     */
    public function createOrder($sId, $aFields = array(), $aOrderArticles = array())
    {
        // prevent trigger action in test preparation
        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, true);

        $this->createObject('d3ox.usermanager.'.Order::class, $sId, $aFields);

        Registry::getSession()->setVariable(d3_user_usermanager::PREVENTION_SAVEUSER, false);

        if (is_array($aOrderArticles) && count($aOrderArticles)) {
            foreach ($aOrderArticles as $sOArtId => $aOArtFields) {
                $this->createObject('d3ox.usermanager.'.OrderArticle::class, $sOArtId, array_merge(array('oxorderid' => $sId), $aOArtFields));
            }
        }
    }

    /**
     * @param $sId
     * @param array $aFields
     * @throws Exception
     */
    public function createUser($sId, $aFields = array())
    {
        $this->createObject(
            'd3ox.usermanager.'.User::class,
            $sId,
            array_merge(array('oxusername'   => $sId), $aFields)
        );
    }

    /**
     * @param $sId
     * @param array $aFields
     * @throws Exception
     */
    public function createGroup($sId, $aFields = array())
    {
        $this->createObject('d3ox.usermanager.'.Groups::class, $sId, $aFields);
    }

    /**
     * @param $sClass
     * @param $sId
     */
    public function deleteObject($sClass, $sId)
    {
        try {
            /** @var BaseModel $oObject */
            $oObject = d3GetModCfgDIC()->get($sClass);
            if (method_exists($oObject, 'setRights')) {
                $oObject->setRights(null);
            }
            if ($oObject->exists($sId)) {
                $oObject->delete($sId);
            }
        } catch (Exception $ex) {}
    }

    /**
     * @param $sTableName
     * @param $sId
     */
    public function deleteBaseModelObject($sTableName, $sId)
    {
        try {
            /** @var BaseModel $oObject */
            $oObject = d3GetModCfgDIC()->get('d3ox.usermanager.' . BaseModel::class);
            $oObject->init($sTableName);
            if (method_exists($oObject, 'setRights')) {
                $oObject->setRights(null);
            }
            if ($oObject->exists($sId)) {
                $oObject->delete($sId);
            }
        } catch (Exception $ex) {}
    }

    /**
     * @param $sId
     * @throws DoctrineException
     */
    public function deleteManager($sId)
    {
        $this->deleteObject(Manager::class, $sId);
        $qb = d3database::getInstance()->getQueryBuilder();
        $qb->select('oxid')
            ->from('d3user2usermanager')
            ->where('oxusermanagerid = '.$qb->createNamedParameter($sId));

        foreach ((array) $qb->execute()->fetchAllAssociative() as $aId) {
            $aId = array_change_key_case($aId, CASE_UPPER);
            $this->deleteBaseModelObject('d3user2usermanager', $aId['OXID']);
        }
    }

    /**
     * @param $sId
     */
    public function deleteArticle($sId)
    {
        $this->deleteObject('d3ox.usermanager.'.Article::class, $sId);
    }

    /**
     * @param $sId
     */
    public function deleteOrder($sId)
    {
        $this->deleteObject('d3ox.usermanager.'.Order::class, $sId);
    }

    /**
     * @param $sId
     */
    public function deleteUser($sId)
    {
        $this->deleteObject('d3ox.usermanager.'.User::class, $sId);
    }

    /**
     * @return d3log|MockObject
     */
    public function getD3LogMock()
    {
        /** @var d3log|MockObject $oD3LogMock */
        $oD3LogMock = $this->getMockBuilder(d3log::class)
            ->onlyMethods(['log'])
            ->getMock();
        $oD3LogMock->method('log')->willReturnSelf();

        return $oD3LogMock;
    }

    /**
     * @param $sManagerId
     * @return Manager|MockObject
     */
    public function getManagerMock($sManagerId)
    {
        /** @var Manager|MockObject $oManager */
        $oManager = $this->getMockBuilder(Manager::class)
            ->onlyMethods([
                'd3getLog',
                'getListGenerator'
            ])
            ->getMock();
        $oManager->method('d3getLog')->willReturn($this->getD3LogMock());
        $oManager->method('getListGenerator')->willReturn($this->getListGenerator($oManager));
        $oManager->load($sManagerId);

        return $oManager;
    }

    /**
     * @param Manager $oManager
     * @return Manager_Listgenerator|MockObject
     */
    public function getListGenerator(Manager $oManager)
    {
        d3GetModCfgDIC()->set(
            Manager_Listgenerator::class.'.args.usermanager',
            $oManager
        );

        /** @var Manager_Listgenerator $object */
        $object = d3GetModCfgDIC()->get(Manager_Listgenerator::class);

        return $object;
    }
}
