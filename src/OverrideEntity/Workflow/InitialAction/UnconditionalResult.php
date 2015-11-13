<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\InitialAction;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\ResultDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\InitialAction;

/**
 * Class UnconditionalResult
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\InitialAction
 */
class UnconditionalResult extends ResultDescriptor
{

    /**
     * @var InitialAction
     */
    protected $initialAction;

}
