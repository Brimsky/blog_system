# TechBlog

Laravel blog with auth, posts, categories, comments. Simple setup, works everywhere.

## Quick Start

```bash
git clone <repo-url>
cd techblog
composer install && npm install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

Open `http://localhost:8000` - done.

## Requirements

- PHP 8.2+
- Composer
- Node.js 18+

## Setup

### 1. Install
```bash
composer install
npm install
```

### 2. Config
```bash
cp .env.example .env
php artisan key:generate
```

### 3. Database
```bash
# SQLite (easy)
touch database/database.sqlite

# MySQL (if you want)
# Create database, update .env
```

### 4. Run
```bash
php artisan migrate
php artisan serve
npm run dev
```

## Commands

```bash
# Dev
php artisan serve
npm run dev

# Production
npm run build
php artisan config:cache

# Fix stuff
php artisan cache:clear
chmod -R 775 storage
```

## Create Admin User

```bash
php artisan tinker
```
```php
User::create(['name'=>'Admin','email'=>'admin@blog.com','password'=>bcrypt('password')]);
```

## Categories (Required)

```php
// In tinker
Category::create(['name'=>'Tech','slug'=>'tech','description'=>'Tech stuff']);
Category::create(['name'=>'Laravel','slug'=>'laravel','description'=>'Laravel things']);
```

## Env File

```bash
APP_NAME=TechBlog
APP_ENV=local
APP_KEY="php artisan key:generate" use this command to generate a new key
APP_DEBUG=true
APP_URL=http://localhost

APP_LOCALE=en
APP_FALLBACK_LOCALE=en
APP_FAKER_LOCALE=en_US

APP_MAINTENANCE_DRIVER=file
# APP_MAINTENANCE_STORE=database

PHP_CLI_SERVER_WORKERS=4

BCRYPT_ROUNDS=12

LOG_CHANNEL=stack
LOG_STACK=single
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=sqlite

# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

BROADCAST_CONNECTION=log
FILESYSTEM_DISK=local
QUEUE_CONNECTION=database

CACHE_STORE=database
# CACHE_PREFIX=

MEMCACHED_HOST=127.0.0.1

REDIS_CLIENT=phpredis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=log
MAIL_SCHEME=null
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

VITE_APP_NAME="${APP_NAME}"
```

## Fixes

**Permissions**: `chmod -R 775 storage bootstrap/cache`  
**Cache**: `php artisan cache:clear`  
**Assets**: `npm run dev`  
**DB**: Check `.env` database path is absolute

## Production

```bash
APP_ENV=production
APP_DEBUG=false
php artisan config:cache
php artisan route:cache
```

## That's it

Works on Mac/Linux/Windows. SQLite = zero config. Questions? Check Laravel docs.
