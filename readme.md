# Installation
Step 1: Get the code

Step 2: Use Composer to install dependencies
```sh
$ cd /path/to/project
$ composer install
```
Step 3: Perform default commands for new projects
```sh
$ php -r "copy('.env.example', '.env');"
$ php artisan key:generate
```
Step 4: Configure your database
Check Laravel's Documentation for setting up the database configuration or use default sqlite
```sh
touch database/database.sqlite
```

Step 5: Migrate new tables to database
```sh
$ php artisan migrate
```

Step 6: Use PHP's built-in development server or use yours
```sh
$ php artisan serve
```

#Features

Commands
```
photos:import {--O|overwrite : Overwrite current photos by new data}
photos:update {ids* : Photos Ids}
album:assign {id : Album Id}
```

API endpoints 
```
http://localhost:8000/api/photos
http://localhost:8000/api/photo/{id}
http://localhost:8000/api/albums
http://localhost:8000/api/album/{id}
```
