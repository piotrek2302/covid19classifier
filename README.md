
## Running the clone on a local machine
clone this repo and copy .env.example to .env and configure the database name, username and password. You have to create the database manually. 
    
    git clone https://github.com/piotrek2302/covid19classifier.git
    cd covid19classifier
    composer install
    npm install
    php artisan key:generate
    php artisan ui bootstrap
    copy .env.example .env #copy the env template
    php artisan migrate   //or php artisan migrate:fresh
    php artisan db:seed   
    php artisan storage:link

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
