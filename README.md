# Workflow

[![Build Status](https://secure.travis-ci.org/old-town/workflow-doctrine.svg?branch=dev)](https://secure.travis-ci.org/old-town/workflow-doctrine)
[![Coverage Status](https://coveralls.io/repos/old-town/workflow-doctrine/badge.svg?branch=dev&service=github)](https://coveralls.io/github/old-town/workflow-doctrine?branch=dev)

Сохранение состояния workflow в doctrine

Обсуждение проблем https://github.com/old-town/workflow-doctrine/issues

Реализаця хранилища - [DoctrineWorkflowStory](./src/DoctrineWorkflowStory.php).

Пример инициализации:

```php
    use \OldTown\Workflow\Spi\Doctrine\DoctrineWorkflowStory;

    $doctrineWorkflowStory = new DoctrineWorkflowStory();
    $doctrineWorkflowStory->init([
        DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => [
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_NAME => 'имя класса фабрики, реализующей интерфейс \OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\EntityManagerFactoryInterface',
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_OPTIONS => [
                
            ]
        ]
    ]);


```

Хранилище для работы, должно получить инициализированный и настроенный экземпляр \Doctrine\ORM\EntityManagerInterface.
Получение менеджера сущностей доктрины делегированно фабрике которая должна реализовывать интерфейс [EntityManagerFactoryInterface](./src/EntityManagerFactory/EntityManagerFactoryInterface.php).

В модуль входит [SimpleEntityManagerFactory](./src/EntityManagerFactory/SimpleEntityManagerFactory.php) - простая фабрика,
позволяющая заранее установить менеджер сущностей доктрины. 

