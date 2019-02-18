# Super simple journeys api mock up

This is a simple mockup of a journeys application built on lumen 5.7.
Requires php > 7.1.3.
Swagger has been used to produce the api's specs.

You can find the specs online here: http://journeys.exasa.gr/api/documentation

## Installation

### With docker

- Clone the repo on your local machine
```git clone https://github.com/tania-pets/distance-api.git```
- Move to project's directory
```cd distance-api```
- Built the docker's composer
```docker-compose build```
- Launch the docker app
```docker-compose up -d```
- Install with composer
```docker-compose exec app composer install```
- copy .env.example  to .env
- Generate swagger docs
```docker-compose exec app php artisan swagger-lume:generate```

You should be able to access the api docs on http://localhost:8080/api/documentation

** NOTE: Uses port 8080 for apache . If port already in use, modify it in docker-compose.yml



### On your local machine

- Clone the repo on your local machine
```git clone https://github.com/tania-pets/distance-api.git```
- Move to project's directory
```cd distance-api```
- Install with composer
```composer install```
- copy .env.example  to .env
- Generate swagger docs
```php artisan swagger-lume:generate```
