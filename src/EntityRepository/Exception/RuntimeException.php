<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\EntityRepository\Exception;

use OldTown\Workflow\Spi\Doctrine\Exception\RuntimeException as Exception;

/**
 * Class RuntimeException
 *
 * @package OldTown\Workflow\Spi\Doctrine\EntityRepository\Exception
 */
class RuntimeException extends Exception implements
    ExceptionInterface
{
}
