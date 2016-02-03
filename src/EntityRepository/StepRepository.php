<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\EntityRepository;

use Doctrine\ORM\EntityRepository;
use \OldTown\Workflow\Spi\Doctrine\Entity\AbstractStep;

class StepRepository extends EntityRepository
{

    /**
     * @param array $listId
     *
     * @return array
     *
     * @throws Exception\RuntimeException
     */
    public function findByIds(array $listId = [])
    {
        $countListId = count($listId);
        if (0 === $countListId) {
            return [];
        }

        $dql = sprintf(
            'SELECT s FROM %s s WHERE s.id IN (:stepIds)',
            $this->_entityName
        );

        $query = $this->_em->createQuery($dql);
        $query->setParameter('stepIds', $listId);

        /** @var AbstractStep[] $steps */
        $steps = $query->getResult();

        if ($countListId !== count($steps)) {
            $errMsg = 'error search step';
            throw new Exception\RuntimeException($errMsg);
        }

        return $steps;
    }
}
