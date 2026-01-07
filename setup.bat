@echo off
echo ========================================
echo PixelNest - Setup Script
echo ========================================
echo.

echo [1/6] Installing Composer Dependencies...
call composer install
call composer require midtrans/midtrans-php
echo.

echo [2/6] Copying Environment File...
if not exist .env (
    copy .env.example .env
    echo .env file created! Please update database and Midtrans credentials.
) else (
    echo .env file already exists, skipping...
)
echo.

echo [3/6] Generating Application Key...
php artisan key:generate
echo.

echo [4/6] Running Migrations and Seeders...
echo WARNING: This will reset your database!
set /p confirm="Continue? (y/n): "
if /i "%confirm%"=="y" (
    php artisan migrate:fresh --seed
) else (
    echo Skipped database migration.
)
echo.

echo [5/6] Creating Storage Link...
php artisan storage:link
echo.

echo [6/6] Setup Complete!
echo.
echo ========================================
echo IMPORTANT: Next Steps
echo ========================================
echo 1. Update .env file with:
echo    - Database credentials (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
echo    - Midtrans API keys (MIDTRANS_SERVER_KEY, MIDTRANS_CLIENT_KEY)
echo.
echo 2. Create MySQL database named 'pixelnest'
echo.
echo 3. Run: php artisan serve
echo.
echo 4. Visit: http://localhost:8000
echo.
echo 5. Login as admin:
echo    Email: admin@pixelnest.com
echo    Password: password
echo ========================================
echo.
pause
