# Workflow Doctrine

Сохранение состояния запущенного процесса workflow в doctrine

Обсуждение проблем https://github.com/old-town/workflow-doctrine/issues

Реализаця хранилища - \OldTown\Workflow\Spi\Doctrine\DoctrineWorkflowStory.

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
Получение менеджера сущностей доктрины делегированно фабрике которая должна реализовывать интерфейс \OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\EntityManagerFactoryInterface.

В модуль входит \OldTown\Workflow\Spi\Doctrine\EntityManagerFactory\SimpleEntityManagerFactory - простая фабрика,
позволяющая заранее установить менеджер сущностей доктрины. 


