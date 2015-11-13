<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction;

use Doctrine\ORM\Mapping as ORM;
use OldTown\Workflow\Loader\ConditionalResultDescriptor;
use OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction;

/**
 * Class Result
 *
 * @package OldTown\Workflow\Spi\Doctrine\OverrideEntity\Workflow\CommonAction
 */
class Result extends ConditionalResultDescriptor
{

    /**
     * @var CommonAction
     */
    protected $commonAction;
}
