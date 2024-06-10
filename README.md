# Project Title

## Overview
    FATTO A MANO

Nama Kelompok : KhamsaNur

Anggota : 
1. Arvan Yudhistia Ardana
2. Riady Wiguna
3. Muhammad Zakki Islami
4. Dani Adrian
5. Senopati Fadhiilah Langit


This project is a web-based application that allows users to manage clothes, storages, and user accounts. It includes features for user authentication, clothes management, storage management, and admin functionalities. The application is built using Laravel, a PHP framework, and utilizes a MySQL database for data storage.

## Features

- User Authentication (Login, Register, Logout)
- Admin Dashboard
  - Manage Users (View, Add, Edit, Delete)
  - Manage Clothes (View, Add, Edit, Delete)
  - Manage Storages (View, Add, Edit, Delete)
  - View Analytics and Reports
- User Dashboard
  - View and Edit Profile
  - Change Password
  - View Purchased Clothe

## Installation

### Prerequisites

- PHP 7.4 or higher
- Laravel 
- Composer
- MySQL
- Node.js and NPM (for frontend dependencies)

### Steps

1. **Clone the repository**
    ```bash
    git clone https://github.com/arvardy184/fatto-a-mano.git
    cd fatto-a-mano
    ```

2. **Install PHP dependencies**
    ```bash
    composer install
    ```

3. **Install JavaScript dependencies**
    ```bash
    npm install
    ```

4. **Create a copy of your `.env` file**
    ```bash
    cp .env.example .env
    ```

5. **Generate an application key**
    ```bash
    php artisan key:generate
    ```

6. **Configure your `.env` file**
    Update your database credentials and other settings in the `.env` file.

7. **Run the migrations**
    ```bash
    php artisan migrate
    ```

8. **Seed the database (optional)**
    ```bash
    php artisan db:seed
    ```

9. **Run the development server**
    ```bash
    php artisan serve
    ```

10. **Compile assets**
    ```bash
    npm run dev
    ```

## Usage

### User Roles

- **Admin**: Has access to all features, including user management, clothes management, storage management, and analytics.
- **User**: Can view and edit their profile, view purchased clothes.

## Project Structure

```plaintext
.
├── app
│   ├── Console
│   ├── Exceptions
│   ├── Http
│   │   ├── Controllers
│   │   │   ├── AuthController.php
│   │   │   ├── BuyController.php
│   │   │   ├── ClothesController.php
│   │   │   ├── StorageController.php
│   │   │   └── UserController.php
│   │   ├── Middleware
│   │   └── Requests
│   ├── Models
│   └── Providers
├── bootstrap
├── config
├── database
│   ├── factories
│   ├── migrations
│   └── seeders
├── public
├── resources
│   ├── css
│   ├── js
│   ├── views
│   │   ├── Admin
│   │   │   ├── data_pengguna.blade.php
│   │   ├── Guest
│   │   ├── Storage
│   │   ├── User
│   │   └── clothes
├── routes
│   ├── api.php
│   ├── channels.php
│   ├── console.php
│   └── web.php
├── storage
├── tests
└── webpack.mix.js
