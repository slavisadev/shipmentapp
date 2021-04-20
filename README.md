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

Seeder will populate DB with shipment statuses, one instance of each category and 3 drivers. This will be enough for you to consume the API routes.

## Local server

If you have no server in place, you can run `php artisan serve` and API routes will be available on a route like this one: `http://127.0.0.1:8000`

## Creating shipments

Route: POST - http://127.0.0.1:8000/api/shipments  
Postman body sample:  
```
category_id:1
category_type:App\Models\Car
description:test description
amount:190.65
pickup_city:Beograd
delivery_city:Subotica
pickup_date:2015-10-10
delivery_date:2017-10-10

```
Note:  
From the above sample you will see that you need to provide category_id (polymorphic relationship) and category_type which are hardcoded for the purpose of this demo.
Description and amount are self-explanatory, but pickup_city and delivery_city are important fields. The route controller method will check for the existance of these cities and use them if available, but create them otherwise.

## Updating shipments

Route: POST - http://127.0.0.1:8000/api/shipments/1  
Postman body sample:
```
category_id:1
category_type:App\Models\Car
pickup_location_id:5
pickup_date:2015-12-12
delivery_date:2015-12-12
delivery_location_id:6
shipment_status_id:2
description:test23
amount:111
_method:put
```
Note: There is a custom request class ready to perform the validation. If the validation of the fields does not pass as expected, there will be a default Laravel 404 error.

## Bidding

Route: POST - http://127.0.0.1:8000/api/shipments/1/bids  
Postman body sample:
```
driver_id:1
amount:55
```
This route accepts driver_id and amount and validates the request. If successfull, a list of bids is returned. Otherwise, proper messages are displayed.

### Retracting bid
Route: POST - http://127.0.0.1:8000/api/shipments/1/bids/retract
Postman body sample:
```
driver_id:1
```
This route retracts the drivers bid so he could make another one.  


### Accepting bid
Route: POST - http://127.0.0.1:8000/api/shipments/1/bids/accept
Postman body sample:
```
driver_id:1
```
This route accepts the drivers bid and handles proper status changes.  
Proper messages are displayed. 
