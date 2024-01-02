# System Requirements
* PHP: 8.0
* Laravel: 9.5
<!-- * nodejs: 12.15.0 -->
* OS: macos, linux
* Docker

# Getting started

## Installation

Copy the example env file and make the required configuration changes in the .env file
    
    cp .env.example .env

Make db_mysql folder for docker mysql volume

    mkdir db_mysql

Modify hosts file
    
127.0.0.1 service.loc
127.0.0.1 company.service.loc
127.0.0.1 admin.service.loc

## Docker
    
    docker compose up -d
    docker compose exec app composer install
    docker compose exec app php artisan migrate
    docker compose exec app php artisan db:seed
    docker-compose exec app php artisan ziggy:generate
 **Run docker compose with worker service:**
 
    docker-compose --profile worker up -d
 **Connect to worker container:**
    
    docker exec -it gp_web_apps_worker_1 /bin/ash
    

# Frontend
- `yarn install`
- `yarn watch`
- `yarn prod`

# using node js
- `nvm use v16.16.0 `
