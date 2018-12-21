## First Laravel APP

## 1. first :

1. ```composer install```
2. rename .env.example -> .env
3. ```php artisan key:generate```

## 2. configuration file .env

```
DB_DATABASE=firstapp
DB_USERNAME=root
DB_PASSWORD=root
```

## 3. create database :
`database name = firstapp`

## 4. migrate table to database :
run this command on ```terminal``` or ```cmd``` if you use windows OS.

```bash
php artisan migrate
```

## 5. run server
```bash
php artisan serve
```

```http://localhost:8000```
