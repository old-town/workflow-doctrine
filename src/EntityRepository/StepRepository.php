<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\EntityRepository;

use Doctrine\ORM\EntityRepository;
use OldTown\Workflow\Spi\Doctrine\Entity\StepInterface;
use OldTown\Workflow\Spi\Doctrine\Entity\EntryInterface;

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

        /** @var StepInterface[] $steps */
        $steps = $query->getResult();

        if ($countListId !== count($steps)) {
            $errMsg = 'error search step';
            throw new Exception\RuntimeException($errMsg);
        }

        return $steps;
    }

    /**
     * Поиск текущих шагов
     *
     * @param EntryInterface $entry
     *
     * @return array
     */
    public function findCurrentSteps(EntryInterface $entry)
    {
        $dql = "
          SELECT
            step
          FROM {$this->_entityName} step
          JOIN step.entry entry
          WHERE
              entry.id = :entryId
                AND
              step.type = :stepType
          ";

        $query = $this->_em->createQuery($dql);
        $query->setParameter('entryId', $entry->getId());
        $query->setParameter('stepType', StepInterface::CURRENT_STEP);

        /** @var StepInterface[] $steps */
        return $query->getResult();
    }

    /**
     * Поиск шагов в истории
     *
     * @param EntryInterface $entry
     *
     * @return array
     */
    public function findHistorySteps(EntryInterface $entry)
    {
        $dql = "
          SELECT
            step
          FROM {$this->_entityName} step
          JOIN step.entry entry
          WHERE
              entry.id = :entryId
                AND
              step.type = :stepType
          ORDER BY step.finishDate ASC
          ";

        $query = $this->_em->createQuery($dql);
        $query->setParameter('entryId', $entry->getId());
        $query->setParameter('stepType', StepInterface::HISTORY_STEP);

        /** @var StepInterface[] $steps */
        return $query->getResult();
    }
}
