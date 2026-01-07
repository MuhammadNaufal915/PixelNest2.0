@echo off
setlocal

:: Set PATH untuk PHP dan Composer
set PATH=C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64;C:\laragon\bin\composer;%PATH%

echo ========================================
echo PixelNest - Database Setup
echo ========================================
echo.
echo This will reset your database and create fresh tables.
echo Make sure you have:
echo 1. Created database 'pixelnest' in MySQL
echo 2. Updated .env file with database credentials
echo.
set /p confirm="Continue? (y/n): "

if /i not "%confirm%"=="y" (
    echo Setup cancelled.
    pause
    exit /b 0
)

echo.
echo Running migrations and seeders...
php artisan migrate:fresh --seed

if errorlevel 1 (
    echo.
    echo ========================================
    echo ERROR: Migration failed!
    echo ========================================
    echo.
    echo Possible issues:
    echo 1. Database 'pixelnest' doesn't existecho 2. Wrong database credentials in .env
    echo 3. MySQL server is not running
    echo.
    echo Please fix the issue and try again.
    pause
    exit /b 1
)

echo.
echo ========================================
echo SUCCESS! Database setup complete!
echo ========================================
echo.
echo You can now start the server with:
echo   php artisan serve
echo.
echo Then visit: http://localhost:8000
echo.
echo Admin login:
echo   Email: admin@pixelnest.com
echo   Password: password
echo ========================================
pause
