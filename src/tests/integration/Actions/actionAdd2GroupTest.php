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

use D3\ModCfg\Application\Model\Exception\d3_cfg_mod_exception;
use D3\ModCfg\Application\Model\Exception\d3ShopCompatibilityAdapterException;
use D3\Usermanager\Application\Model\d3usermanager;
use Doctrine\DBAL\Exception as DoctrineException;
use Doctrine\DBAL\Query\QueryBuilder;
use Exception;
use OxidEsales\Eshop\Application\Model\Object2Group;
use OxidEsales\Eshop\Core\Exception\DatabaseConnectionException;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use OxidEsales\Eshop\Core\Exception\StandardException;
use OxidEsales\Eshop\Core\Model\ListModel;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;

class actionAdd2GroupTest extends d3ActionIntegrationTestCase
{
    public string $sManagerId = 'managerTestId';
    public array $aUserIdList = [
        'userTestIdNo1',
    ];
    public array $aO2GroupIdList = [
        'o2groupTestIdNo1',
    ];
    public array $aGroupsIdList = [
        'groupTestIdNo1',
        'groupTestIdNo2',
    ];

    /**
     * @throws Exception
     */
    public function createTestData()
    {
        $this->createManager($this->sManagerId);

        $this->createGroup($this->aGroupsIdList[0]);
        $this->createGroup($this->aGroupsIdList[1]);

        $this->createUser($this->aUserIdList[0]);
    }

    /**
     * @throws DoctrineException
     */
    public function cleanTestData()
    {
        $this->deleteManager($this->sManagerId);
        $this->deleteUser($this->aUserIdList[0]);
        $this->deleteObject('d3ox.usermanager.' . Object2Group::class, $this->aO2GroupIdList[0]);

        foreach ([$this->aGroupsIdList[0], $this->aGroupsIdList[1]] as $groupId) {
            /** @var QueryBuilder $queryBuilder */
            $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
            $queryBuilder->delete('oxobject2group')
                ->where(
                    $queryBuilder->expr()->and(
                        $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                        $queryBuilder->expr()->eq('oxgroupsid', $queryBuilder->createNamedParameter($groupId)),
                    )
                );
            $queryBuilder->execute();
        }
    }

    /**
     * @return d3usermanager
     */
    public function getConfiguredManagerSingleGroupsExists(): d3usermanager
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCust2Group_status', true);
        $oManager->setValue('aCustAddGroup', [$this->aGroupsIdList[0]]);
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return d3usermanager
     */
    public function getConfiguredManagerMultiGroupsExists(): d3usermanager
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCust2Group_status', true);
        $oManager->setValue('aCustAddGroup', [$this->aGroupsIdList[0], $this->aGroupsIdList[1]]);
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return d3usermanager
     */
    public function getConfiguredManagerSingleGroupsNotExistsNotAssigned(): d3usermanager
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCust2Group_status', true);
        $oManager->setValue('aCustAddGroup', ['unknownGroupId']);
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return d3usermanager
     */
    public function getConfiguredManagerNoGroups(): d3usermanager
    {
        $oManager = $this->getManagerMock($this->sManagerId);

        $oManager->setValue('blActionCust2Group_status', true);
        $oManager->setValue('aCustAddGroup', []);
        $oManager->setValue('blItemExecute', true);

        return $oManager;
    }

    /**
     * @return ListModel
     */
    public function getFilledResultList(): ListModel
    {
        return $this->getResultList([$this->aUserIdList[0]]);
    }

    /**
     * @test
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DoctrineException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function actionChangeConcernedUserSingleGroupsExistsNotAssigned()
    {
        $oExecute = $this->getExecuteMock($this->getConfiguredManagerSingleGroupsExists());
        $oExecute->startJobItemExecution();

        // check assignment pass
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->eq('oxgroupsid', $queryBuilder->createNamedParameter($this->aGroupsIdList[0]))
                )
            );
        $this->assertSame(
            1,
            (int)$queryBuilder->execute()->fetchOne()
        );

        // check other assignments
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->notIn('oxgroupsid', [$queryBuilder->createNamedParameter($this->aGroupsIdList[0])])
                )
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->neq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->in('oxgroupsid', [$queryBuilder->createNamedParameter($this->aGroupsIdList[0])])
                )
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );
    }

    /**
     * @test
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DoctrineException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function actionChangeConcernedUserMultiGroupsExistsNotAssigned()
    {
        $oExecute = $this->getExecuteMock($this->getConfiguredManagerMultiGroupsExists());
        $oExecute->startJobItemExecution();

        // check assignment pass
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->in('oxgroupsid', [
                        $queryBuilder->createNamedParameter($this->aGroupsIdList[0]),
                        $queryBuilder->createNamedParameter($this->aGroupsIdList[1]),
                    ])
                )
            );
        $this->assertSame(
            2,
            (int)$queryBuilder->execute()->fetchOne()
        );

        // check other assignments
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->notIn('oxgroupsid', [
                        $queryBuilder->createNamedParameter($this->aGroupsIdList[0]),
                        $queryBuilder->createNamedParameter($this->aGroupsIdList[1]),
                    ])
                )
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->neq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->in('oxgroupsid', [
                        $queryBuilder->createNamedParameter($this->aGroupsIdList[0]),
                        $queryBuilder->createNamedParameter($this->aGroupsIdList[1]),
                    ])
                )
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );
    }

    /**
     * @test
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DoctrineException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function actionChangeConcernedUserSingleGroupsExistsAlreadyAssigned()
    {
        $this->createObject(
            'd3ox.usermanager.' . Object2Group::class,
            $this->aO2GroupIdList[0],
            [
                'oxshopid' => 1,
                'oxobjectid' => $this->aUserIdList[0],
                'oxgroupsid' => $this->aGroupsIdList[0],
            ]
        );

        $oExecute = $this->getExecuteMock($this->getConfiguredManagerSingleGroupsExists());
        $oExecute->startJobItemExecution();

        // check assignment pass
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->in('oxgroupsid', [
                        $queryBuilder->createNamedParameter($this->aGroupsIdList[0])
                    ])
                )
            );
        $this->assertSame(
            1,
            (int)$queryBuilder->execute()->fetchOne()
        );

        // check other assignments
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->notIn('oxgroupsid', [
                        $queryBuilder->createNamedParameter($this->aGroupsIdList[0])
                    ])
                )
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->neq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->in('oxgroupsid', [
                        $queryBuilder->createNamedParameter($this->aGroupsIdList[0])
                    ])
                )
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );
    }

    /**
     * @test
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DoctrineException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function actionChangeConcernedUserSingleGroupsNotExistsNotAssigned()
    {
        $oExecute = $this->getExecuteMock($this->getConfiguredManagerSingleGroupsNotExistsNotAssigned());
        $oExecute->startJobItemExecution();

        // check assignment pass
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->in('oxgroupsid', [
                        $queryBuilder->createNamedParameter('unknownGroupId')
                    ])
                )
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );

        // check other assignments
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->notIn('oxgroupsid', [
                        $queryBuilder->createNamedParameter('unknownGroupId')
                    ])
                )
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );
        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->and(
                    $queryBuilder->expr()->neq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
                    $queryBuilder->expr()->in('oxgroupsid', [
                        $queryBuilder->createNamedParameter('unknownGroupId')
                    ])
                )
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );
    }

    /**
     * @test
     * @throws DatabaseConnectionException
     * @throws DatabaseErrorException
     * @throws DoctrineException
     * @throws StandardException
     * @throws d3ShopCompatibilityAdapterException
     * @throws d3_cfg_mod_exception
     */
    public function actionChangeConcernedUserNoGroups()
    {
        $oExecute = $this->getExecuteMock($this->getConfiguredManagerNoGroups());
        $oExecute->startJobItemExecution();

        /** @var QueryBuilder $queryBuilder */
        $queryBuilder = ContainerFactory::getInstance()->getContainer()->get(QueryBuilderFactoryInterface::class)->create();
        $queryBuilder->select('count(*)')
            ->from('oxobject2group')
            ->where(
                $queryBuilder->expr()->eq('oxobjectid', $queryBuilder->createNamedParameter($this->aUserIdList[0])),
            );
        $this->assertSame(
            0,
            (int)$queryBuilder->execute()->fetchOne()
        );
    }
}
