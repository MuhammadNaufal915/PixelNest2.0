@echo off
setlocal

:: Set PATH untuk PHP dan Composer
set PATH=C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64;C:\laragon\bin\composer;%PATH%

echo Installing Midtrans package...
call composer require midtrans/midtrans-php --no-interaction

echo.
echo Midtrans package installed!
pause
