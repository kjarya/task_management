# Task Management

This repository is a simple Laravel project of Task Management

## Getting Started

### Prerequisites

- Make sure you have [Composer](https://getcomposer.org/) installed.
- Make sure you have the latest [PHP](https://www.php.net/) installed.
- Make sure you have [MySQL](https://www.mysql.com/) installed.

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/kjarya/task_management.git

2. Install PHP dependencies

    ```bash
    composer install

3. Copy the ''.env.example' file to '.env' to configure your database settings

    ```bash
   cp .env.example .env

4. Generate application key
    
    ```bash
    php artisan key:generate

5. Run the migration 

    ```bash
    php artisan migrate

###Usage

1. Run the below command to visit the url in your browser
    
    ```bash
    php artisan serve

That's all!
