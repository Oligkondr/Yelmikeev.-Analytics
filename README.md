### Получение данных из API

Выполнить команду:

```php artisan data:get {target}```

Команда выполняет запрос в API и сохраняет данные в БД.

Доступные значения target:

* sales
* incomes
* orders
* stocks

Пример: 

```php artisan data:get sales``` 

*Команда выполнит запрос на URL http://109.73.206.144:6969/api/sales и сохранит данные в таблицу sales.*

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
