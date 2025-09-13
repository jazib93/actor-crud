# Actor CRUD Application

A Laravel application for managing actor information submissions.

## Features

- Actor information form submission
- Data validation and storage
- View submitted actor data
- RESTful API endpoint

## Installation

1. Clone the repository
2. Install dependencies: `composer install`
3. Copy environment file: `cp .env.example .env`
4. Generate app key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Start server: `php artisan serve`

## Usage

- Visit `/` to submit actor information
- Visit `/actors` to view submissions
- API endpoint: `GET /api/actors/prompt-validation`

## Testing

Run tests with: `php artisan test`

## Technology Stack

- Laravel 12.x
- Bootstrap 5
- SQLite
- PHPUnit