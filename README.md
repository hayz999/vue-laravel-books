# My Favorite Books App

## Video (if local setup instructions are not clear)
[Demo](https://drive.google.com/file/d/1zc5dA3ZH-xngeH-jHFowUToM3JeJhF24/view?usp=sharing)

## Local setup
```bash
# Cd into booksList directory

# Install Dependencies
composer install

# Run Migrations
php artisan migrate

# Import Books
php artisan db:seed

# Add virtual host if using Apache

# If you get an error about an encryption key
php artisan key:generate

# Start server
php artisan serve
```

## Tech

### BackEnd 
  - Laravel
  - XAMPP tech stack
  - MariaDB was used to locally host database
  - Composer

### FrontEnd
  - Vue through Laravel
  - Bootstrap for styling

## Areas for growth
  - writing unit tests for Laravel
  - deploying a Laravel application to the cloud

## Other things to note
  - there is seed date that comes from faker to quickly input fake "books"
  - pagination was also implemented as it comes with Laravel

## Resources used
  - Laravel and Vue docs
  - [Traversy Media on Youtube](https://www.youtube.com/watch?v=DJ6PD_jBtU0)