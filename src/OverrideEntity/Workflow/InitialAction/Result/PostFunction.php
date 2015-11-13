<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\InitialAction\Result;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\FunctionDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\InitialAction\Result;

/**
 * Class PostFunction
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\InitialAction\Result
 */
class PostFunction extends FunctionDescriptor
{
    /**
     * @var Result
     */
    protected $result;
}
