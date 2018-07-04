# Template kit

Bộ kit để xây dựng các website cho thương mại điện tử, giới thiệu công ty... dựa trên laravel, vuejs và theme UBold bản quyền.

# Install

```
$ composer install
$ cp .env.example .env
$ php artisan key:generate
$ php artisan migrate
$ php artisan db:seed
$ php artisan passport:install --force
$ chmod -R 777 /storage /bootstrap
```

# Admin

```
Email: admin@nht.com
Password: admin
```

# Start development

`npm run hot`

# Testing

`./vendor/bin/phpunit`
