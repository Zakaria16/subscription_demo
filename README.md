# Subscription Demo
> user authentication was not taken into consideration, so with some endpoint userid is being sent which not be
the case for when authentication was in place. With authenticatio in place the user id should be read from the
> autenticated user session.

## setup
make a copy of `.env.example` as `.env`

Modify the .env variables to suite your development environment
setup a database on your mysql server and change this fields in the env

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=larasub
DB_USERNAME=root
DB_PASSWORD=
```

A working mail host is required to send emails on new **post published** this can be set 
here in the `.env` file
```shell
MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

```


## Starting the project
run the following commands 
> Note db:seed may give warning when it detect the randomly generated new entry is a duplicate in subscription table, it is normal because the web_id and userid pair has a unique constraint.

```shell
composer install
php artisan migrate
php artisan db:seed

php artisan serve
```

## Testing the api
use postman
[Postman Api test](https://documenter.getpostman.com/view/3030788/UzQvtQjC)

