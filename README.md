## Shipment App

This is a simple app that lets you handle shipment for different categories.
Shipments can be bid on by drivers and there is a status handling system in place.

## Getting started

First, you need to clone this repo somewhere and run `composer install`  

Secondly, you need to copy .env.example file to .env and provide a MySQL database, user and password for that database.   

Find this portion:  
```

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

```

And replace DB_DATABASE, DB_USERNAME and DB_PASSWORD with your values.  

After that, perform `php artisan cache:config` to make sure environment variables are in place.  

## Migrations

Migrations are run via `php artisan migrate` command.  
There are several seeds in place as well. Run them via `php artisan db:seed`

