<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction\UnconditionalResult;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\FunctionDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction\UnconditionalResult;

/**
 * Class PostFunction
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction\UnconditionalResult
 */
class PostFunction extends FunctionDescriptor
{

    /**
     * @var UnconditionalResult
     */
    protected $unconditionalResult;


}
