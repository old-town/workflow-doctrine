<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\ConditionalResultDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction;

/**
 * Class Result
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction
 */
class Result extends ConditionalResultDescriptor
{

    /**
     * @var GlobalAction
     */
    protected $globalAction;
}
