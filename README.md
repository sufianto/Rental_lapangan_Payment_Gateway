<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Alternative installation is possible without local dependencies relying on [Docker](#docker). 

Clone the repository

    https://github.com/sufianto/Rental_lapangan_Payment_Gateway.git

Switch to the repo folder

    cd Gudang-Logistic

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (Set the database connection in .env before migrating)

    php artisan migrate

If you need to reset and refresh the database, run:

    php artisan migrate:fresh

Seed the database with initial data

    php artisan migrate --seed

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

## Export Database

The database schema and initial data can be found in the exported SQL file db_logistik_sufianto.sql. 

Import this file to your database to quickly set up the project.

## Login Credentials

To login, use the following credentials:

- Email: owner@gmail.com

- Password: P@55word


## credit
Matrix Admin is used as the admin template for the dashboard and UI components.
