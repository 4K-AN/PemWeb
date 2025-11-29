@echo off
echo ========================================
echo   EDVIZO - Project Cleanup
echo ========================================
echo.

echo [INFO] Cleaning up unnecessary files...

REM Hapus welcome.blade.php (UI Test)
if exist "resources\views\welcome.blade.php" (
    del "resources\views\welcome.blade.php"
    echo [OK] Deleted: welcome.blade.php
)

REM Hapus routes/channels.php
if exist "routes\channels.php" (
    del "routes\channels.php"
    echo [OK] Deleted: channels.php
)

REM Hapus migration lama yang konflik
for %%f in (
    "database\migrations\2025_01_29_add_fitur_to_tryouts_table.php"
    "database\migrations\2025_01_29_add_interests_talents_to_users_table.php"
    "database\migrations\2025_01_XX_add_fields_to_users_table.php"
    "database\migrations\2025_01_XX_create_tryouts_table.php"
    "database\migrations\2025_01_XX_update_beasiswas_table.php"
    "database\migrations\2025_11_29_122649_add_new_columns_to_beasiswas_table_fix.php"
) do (
    if exist %%f (
        del %%f
        echo [OK] Deleted: %%~nxf
    )
)

REM Hapus migration dengan prefix [timestamp]
for %%f in (database\migrations\[timestamp]*.php) do (
    REM Keep yang penting saja
    if not "%%~nxf"=="[timestamp]_create_academic_events_table.php" (
        if not "%%~nxf"=="[timestamp]_create_tryouts_table_final.php" (
            if not "%%~nxf"=="[timestamp]_update_beasiswas_add_missing_columns.php" (
                del "%%f"
                echo [OK] Deleted: %%~nxf
            )
        )
    )
)

REM Hapus page kalender statis
for %%f in (
    "resources\views\akademik\Kalender\page1.blade.php"
    "resources\views\akademik\Kalender\page2.blade.php"
    "resources\views\akademik\Kalender\page15.blade.php"
    "resources\views\akademik\Kalender\page20.blade.php"
    "resources\views\akademik\Kalender\page28.blade.php"
    "resources\views\akademik\Kalender\page30.blade.php"
) do (
    if exist %%f (
        del %%f
        echo [OK] Deleted: %%~nxf
    )
)

echo.
echo [SUCCESS] Cleanup complete!
echo.
echo Deleted files:
echo - welcome.blade.php (UI Test)
echo - channels.php (Unused routes)
echo - Old/duplicate migrations
echo - Static calendar pages
echo.
pause
