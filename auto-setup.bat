@echo off
setlocal

:: Set PATH untuk PHP dan Composer
set PATH=C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64;C:\laragon\bin\composer;%PATH%

echo ========================================
echo PixelNest - Auto Setup
echo ========================================
echo.

echo [1/7] Installing Composer Dependencies...
call composer install --no-interaction
if errorlevel 1 (
    echo ERROR: Composer install failed!
    pause
    exit /b 1
)
echo.

echo [2/7] Installing Midtrans Package...
call composer require midtrans/midtrans-php --no-interaction
echo.

echo [3/7] Setting up Environment File...
if not exist .env (
    copy .env.example .env
    echo .env file created!
) else (
    echo .env already exists, skipping...
)
echo.

echo [4/7] Generating Application Key...
php artisan key:generate --no-interaction
echo.

echo [5/7] Creating Storage Link...
php artisan storage:link
echo.

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo NEXT STEPS:
echo 1. Open phpMyAdmin or MySQL and create database 'pixelnest'
echo 2. Update .env file with your database credentials and Midtrans keys
echo 3. Run: php artisan migrate:fresh --seed
echo 4. Run: php artisan serve
echo.
echo Admin login: admin@pixelnest.com / password
echo ========================================
pause
