# Плагин CakeD для фреймворка CakePHP
### Описание
CakeD - плагин, предназначенный для запланированной отправки файлов.

### Установка
Установка через composer:
- Из корневого каталога проекта выполнить в командной строке:
```
php composer.phar require denvolj/caked<br>
bin/cake plugin load denvolj/caked
```
- Для миграции таблиц, из корневого каталога выполнить `bin/cake migrations migrate -p CakeD`

### Эксплуатация
#### Оболочка TaskShell
- Создание задачи:
```
bin/cake CakeD.Task add "<path_to_directory>" "<METHOD>" "<hh:mm dd.mm.yyyy>"

// Пример:
bin/cake CakeD.Task add "/home/user/" "DROPBOX" "11:30 10.07.2016"
```
- Добавление файлов к задаче:
```
bin/cake CakeD.Task addfile <task_id> "<file_path_mask>"

// Пример:
bin/cake CakeD.Task add "Downloads/*" // Добавит все файлы, содержащиеся в папке "/home/user/Downloads".
					 Файлы добавляются к последней задаче, если task_id не указан.
```

- Исполнение задач:
```
bin/cake CakeD.Task
```

- Получение ссылки на файл:
```
bin/cake CakeD.Task url "<file_name>"

// Пример:
bin/cake CakeD.Task url "index.html" // Возвращает ссылку на файл с сервиса,
					Либо возвращает путь: "/home/user/Downloads/index.html"
```

#### Компонента плагина TaskManager
##### Описание
Данная компонента предоставляет API для планирования, конфигурирования задач, а так же, добавления файлов к задачам.

##### Методы:
- `public function createTask($config, $exec_time = null)`<br>
В качестве аргументов метод принимает два параметра:<br>
`$config` - путь до файла конфигурации (обязательный параметр)<br>
`$exec_time` - время, в которое нужно начать исполнение задачи

Метод возвращает задачу - объект, у которого имеется свой перечень методов.

- `public function addfile($task, $files)`<br>
В качестве аргументов метод принимает два параметра:<br>
`$task` - объект задачи<br>
`$files` - строка или массив строк, содержащих путь до файлов.

Метод возвращает подзадачу - объект, у которого имеется свой перечень методов.

### Оболочка плагина
#### Task
##### Описание
Оболочка предоставляет метод 'main()' для анализа и исполнения задач.

##### Использование
- Для запуска анализа и исполнения задач из консоли нужно выполнить команду `bin/cake CakeD.Task`.

##### Пример использования с crontab
1) В консоли вписать `crontab -e` для редактирования списка cron-задач.<br>
2) Добавить в конец файла <br>
`* * * * * cd <путь до корневой директории проекта> && bin/cake CakeD.Task`
