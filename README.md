## Basic Requirements
- PHP 7.x
- Composer

## Installation
- Go to the project directory
- Run the command ```composer install```

## Running the App in Command Line
- Go to the project directory
- Run ```php artisan quote:shout```
- Enter the requested inputs

## Running the App Through a HTTP Server
- Go to the project directory
- Run ```php -S localhost:8000 -t public```
- On the browser, visit http://localhost:8000/api/v1/shout/{author-name}?limit={limit-amount}
- Feel free to replace the author name into any author name, and the limit-amount into any amount as there are server side validations
- You can also CURL it from the command line.

## Unit Testing
- Go to the project directory
- Run ```vendor/bin/phpunit```
