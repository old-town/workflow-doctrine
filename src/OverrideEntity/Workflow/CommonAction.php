<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\ActionDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow;

/**
 * Class CommonAction
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow
 */
class CommonAction extends ActionDescriptor
{

    /**
     * @var Workflow
     */
    protected $workflow;


}
