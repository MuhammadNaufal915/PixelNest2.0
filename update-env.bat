@echo off
setlocal

echo Updating .env file for PixelNest database...

:: Backup original .env
copy .env .env.backup

:: Update database name using PowerShell
powershell -Command "(Get-Content .env) -replace 'DB_DATABASE=laravel', 'DB_DATABASE=pixelnest' | Set-Content .env"

echo .env file updated!
echo Database name changed from 'laravel' to 'pixelnest'
echo.
echo Backup saved as .env.backup
pause
