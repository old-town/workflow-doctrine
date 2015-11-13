<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Listener\Entity;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Events;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * Class FunctionDescriptor
 *
 * @package OldTown\Workflow\Spi\Doctrine\Listener\Entity
 */
class FunctionDescriptor implements EventSubscriber
{
    /**
     * @return array
     */
    public function getSubscribedEvents()
    {
        return [
            Events::loadClassMetadata
        ];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $args)
    {
        /** @var ClassMetadata $classMetadata */
        $classMetadata = $args->getClassMetadata();
        $name = $classMetadata->getName();
        //$class = $classMetadata->

       return;
    }
}
