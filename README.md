# Workflow

[![Build Status](https://secure.travis-ci.org/old-town/workflow-doctrine.svg?branch=dev)](https://secure.travis-ci.org/old-town/workflow-doctrine)
[![Coverage Status](https://coveralls.io/repos/old-town/workflow-doctrine/badge.svg?branch=dev&service=github)](https://coveralls.io/github/old-town/workflow-doctrine?branch=dev)

Сохранение состояния workflow в doctrine

Обсуждение проблем https://github.com/old-town/workflow-doctrine/issues

Реализаця хранилища - [\OldTown\Workflow\Spi\Doctrine\DoctrineWorkflowStory](./src/DoctrineWorkflowStory.php).

Пример инициализации:

```php
    $doctrineWorkflowStory = new DoctrineWorkflowStory();
    $doctrineWorkflowStory->init([
        DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY => [
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_NAME => 'имя класса фабрики, реализующей интерфейс \OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\EntityManagerFactoryInterface',
            DoctrineWorkflowStory::ENTITY_MANAGER_FACTORY_OPTIONS => [
                
            ]
        ]
    ]);


```
