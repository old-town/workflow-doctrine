<?php
/**
 * @link    https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\Entity\Exception;

use OldTown\Workflow\Spi\Doctrine\Exception\InvalidArgumentException as Exception;

/**
 * Class InvalidArgumentException
 *
 * @package OldTown\Workflow\Spi\Doctrine\Entity\Exception
 */
class InvalidArgumentException extends Exception implements
    ExceptionInterface
{
}
