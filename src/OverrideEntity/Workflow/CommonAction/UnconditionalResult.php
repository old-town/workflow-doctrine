<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\ResultDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction;

/**
 * Class UnconditionalResult
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction
 */
class UnconditionalResult extends ResultDescriptor
{

    /**
     * @var CommonAction
     */
    protected $commonAction;
}
