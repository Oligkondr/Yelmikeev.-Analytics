### Получение данных из API

Выполнить команду:

```php artisan data:get {target} {--acc_id=1} {--yesterday}```

Команда выполняет запрос в API и сохраняет данные в БД.

Доступные значения target:

* sales
* incomes
* orders
* stocks

Пример:

```php artisan data:get sales --acc_id=1```

*Команда выполнит запрос на URL http://109.73.206.144:6969/api/sales и сохранит данные в таблицу sales.*

### Создание экземпляров сущностей в БД

```php artisan create:company``` - создаст новую компанию.\
```php artisan create:account``` - создаст новый аккаунт.\
```php artisan create:token-type``` - создаст новый тип токена.\
```php artisan create:api-service``` - создаст новый API сервис.\
```php artisan create:api-service-token-type``` - добавит токен в доступные для выбранного API сервиса.

### Доступ к БД

PMA: https://free29.beget.com/phpMyAdmin \
User: k92612db_data \
Password: 9jHxKx*rEjUp \
БД: k92612db_data

Таблицы:

* sales
* incomes
* orders
* stocks

описать комманды
Привести новый пример
Написать про существующий аккаунт
