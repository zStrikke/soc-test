# ![Laravel SoC Test](logo.png)

----------

# Getting started

## Installation

Clone the repository

    git clone git@github.com:zStrikke/soc-test.git

Switch to the repo folder

    cd soc-test

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Laravel Sail

    composer require laravel/sail --dev
    php artisan sail:install
    [0] mysql
    sail up -d (detatched mode)

Run key generate

    sail php artisan key:generate

Run the database migrations

    sail php artisan migrate --seed (migrate and seed)

You can access the server at http://localhost

**Postman Requests**

    import the file: SoC_test.postmancollection.json
    The request test to see if you are logged and the logged user info is: Get user logged
