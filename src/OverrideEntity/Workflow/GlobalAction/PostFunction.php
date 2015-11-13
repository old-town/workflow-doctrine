<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\FunctionDescriptor;
use \OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction;

/**
 * Class PostFunction
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\GlobalAction
 */
class PostFunction extends FunctionDescriptor
{

    /**
     * @var GlobalAction
     */
    protected $globalAction;


}
