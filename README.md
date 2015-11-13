# Workflow

[![Build Status](https://secure.travis-ci.org/old-town/workflow-doctrine.svg?branch=dev)](https://secure.travis-ci.org/old-town/workflow-doctrine)
[![Coverage Status](https://coveralls.io/repos/old-town/workflow-doctrine/badge.svg?branch=dev&service=github)](https://coveralls.io/github/old-town/workflow-doctrine?branch=dev)

Сохранение состояния workflow в doctrine

Обсуждение проблем https://github.com/old-town/workflow-doctrine/issues


# Структуда директорий 
* config/doctrine/entity/BaseDescriptor/ - содержит метаданные для дескрипторов workflow из модуля [old-town/workflow](https://github.com/old-town/old-town-workflow) 
* config/doctrine/entity/Descriptor/ - содержит метаданные для дескрипторов которые были отнаследованы от дескрипторов
модуля [old-town/workflow](https://github.com/old-town/old-town-workflow). Такое наследование потребовалось, что бы
добавить обратные связи, для асоциаций типа one-to-many



* Сущности реализованные непосредственно в данном модуле
** src/Entity/Descriptor - путь до директории где находядтся классы сущностей с метаданными(анотации). 
    Здесь локализированы сущности реализованные непосредственно в данном модуле
* Перегруженные дескрипторы workflow из модуля [old-town/workflow](https://github.com/old-town/old-town-workflow)
** src/OverrideEntity - перегруженные классы дескрипторов
** config/doctrine/override-entity - метаданные для перегруженных классов дескрипторов
* Дескрипторы из модуля [old-town/workflow](https://github.com/old-town/old-town-workflow)
** config/doctrine/base-descriptor-entity - метаданные для дескрипторов из модуля [old-town/workflow](https://github.com/old-town/old-town-workflow)



