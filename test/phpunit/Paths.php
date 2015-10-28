<?php
/**
 * @link https://github.com/old-town/workflow-doctrine
 * @author  Malofeykin Andrey  <and-rey2@yandex.ru>
 */
namespace OldTown\Workflow\Spi\Doctrine\PhpUnit\Test;

/**
 * Class Paths
 *
 * @package OldTown\Workflow\PhpUnit\Test
 */
class Paths
{
    /**
     * Путь до директории с данными для тестов
     *
     * @var string|null
     */
    protected static $pathToDataDir;

    /**
     * Путь до временной директории, куда могу записывать свои файлы тесты
     *
     * @var string|null
     */
    protected static $pathToTestDataDir;

    /**
     * Путь до директории где храняться конфиги с метаданными сущностей
     *
     * @var string
     */
    protected static $pathToDoctrineMetadata;


    /**
     * Путь до директории где храняться конфиги с метаданными сущностей дескриптора
     *
     * @var string
     */
    protected static $pathToDescriptorDoctrineMetadata;

    /**
     * Путь до директории где создаются прокси классы для тестов
     *
     * @var string
     */
    protected static $pathToTestDoctrineProxies;

    /**
     * Возвращает путь до директории где создаются прокси классы для тестов
     *
     * @return string
     */
    public static function getPathToDescriptorDoctrineMetadata()
    {
        if (static::$pathToDescriptorDoctrineMetadata) {
            return static::$pathToDescriptorDoctrineMetadata;
        }

        static::$pathToDescriptorDoctrineMetadata = __DIR__ . '/../../config/doctrine/entity/BaseDescriptor';

        return static::$pathToDescriptorDoctrineMetadata;
    }

    /**
     * Возвращает путь до директории где создаются прокси классы для тестов
     *
     * @return string
     */
    public static function getPathToTestDoctrineProxies()
    {
        if (static::$pathToTestDoctrineProxies) {
            return static::$pathToTestDoctrineProxies;
        }

        static::$pathToTestDoctrineProxies = __DIR__ . '/../../data/test/Proxies';

        return static::$pathToTestDoctrineProxies;
    }

    /**
     * Возвращает путь до директории где храняться конфиги с метаданными для сущностей проекта
     *
     * @return string
     */
    public static function getPathToDoctrineMetadata()
    {
        if (static::$pathToDoctrineMetadata) {
            return static::$pathToDoctrineMetadata;
        }

        static::$pathToDoctrineMetadata = __DIR__ . '/../../src/Entity';

        return static::$pathToDoctrineMetadata;
    }

    /**
     * Возвращает путь до директории с данными для тестов
     *
     * @return string
     */
    public static function getPathToDataDir()
    {
        if (static::$pathToDataDir) {
            return static::$pathToDataDir;
        }

        static::$pathToDataDir = __DIR__ . '/_files';

        return static::$pathToDataDir;
    }

    /**
     * Возвращает путь до директории с данными для тестов
     *
     * @return string
     */
    public static function getPathToTestDataDir()
    {
        if (static::$pathToTestDataDir) {
            return static::$pathToTestDataDir;
        }

        static::$pathToTestDataDir = __DIR__ . '/../../data/test';

        return static::$pathToTestDataDir;
    }
}
