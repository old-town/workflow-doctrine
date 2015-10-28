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



