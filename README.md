# todolist

## Development env

```
git clone https://github.com/nicosomb/todolist.git
composer install
bin/console doctrine:database:create
bin/console doctrine:schema:update --force 
bin/console server:run
```

## Test env

```
bin/console doctrine:database:create --env=test
bin/console doctrine:schema:update --env=test --force 
bin/phpunit
```

## Done

* Category CRUD
* Tag CRUD
* Authentication
* Assign task to user
* list tasks for each category

## Todo

* Repository
* REST API
* materializeCSS
* list tasks for each tag
* list day tasks (week, month)
* calendar
* categories color
* Sort tasks