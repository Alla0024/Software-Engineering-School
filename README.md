# GSES BTC Application

This application provides an API to get the current USD to UAH exchange rate and to subscribe emails for daily rate notifications.

## Installation
1. Clone this repository to your local machine.
2. Navigate to the project directory.
3. Copy the `.env.example` file to `.env` and configure your environment variables, including database connection settings.
4. Run `docker-compose up -d` to start the Docker containers.
5. Run `docker-compose exec app composer install` to install PHP dependencies.
6. Run `docker-compose exec app php artisan key:generate` to generate an application key.
6. Run `docker-compose exec app php artisan migrate` to migrate the database schema.

## Testing
`docker-compose exec app php artisan test` to run the test.

## API Endpoints

- `GET /api/rate`: Get the current USD to UAH exchange rate.
- `POST /api/subscribe`: Subscribe an email for daily rate notifications.
