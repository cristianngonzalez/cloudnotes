## 1 - Instalation dependencies
First you need to install composer and npm dependencies

```bash
composer install
```

```bash
npm install
```

## 2 Migrate database and load the seeders
This project has a migrations function to set the database easily, just you have to create a mysql database the name should be whatever you want (just should be the same than the .env file specified ). 

```bash
php artisan migrate
```
```bash
php artisan db:seed --class=users_seed
```
```bash
php artisan db:seed --class=events_seed
```

## 3 Compile static assets
This project is made with VueJS and Sass runing in Vite. This project needs compile the statics assets first.
```bash
npm run dev
```
```bash
npm run prod
```
