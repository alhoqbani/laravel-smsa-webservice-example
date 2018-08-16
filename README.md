# laravel-smsa-webservice-example


This is an example app built with Laravel to demonstrate the usage of SMSA WebSerivce [library](https://github.com/alhoqbani/smsa-webservice)


# Live demo:
This application is hosted on heroku, and you can view a live demo at [http://laravel-smsa-webservice.herokuapp.com/](http://laravel-smsa-webservice.herokuapp.com/)

# Install:
Make sure you have php and composer installed on your machine
```bash
git clone https://github.com/alhoqbani/laravel-smsa-webservice-example.git
cd laravel-smsa-webservice-example
cp .env.example .env

# Edit .env file:
## with your SMSAWebservice passKey
## Add database confugration
# You need google maps javascript api key, to run the map.

composer install
php artisan migrate --seed
php artisan serve
```

User details for login:
- email: user@example.com
- password: secret


## Using docker:
```bash
git clone https://github.com/alhoqbani/laravel-smsa-webservice-example.git
cd laravel-smsa-webservice-example
cp .env.example .env

# Edit .env file:
## with your SMSAWebservice passKey
# You need google maps javascript api key, to run the map.

./vessel start
./vessel art migrate --seed
```
Form more information on vessel check https://vessel.shippingdocker.com/
