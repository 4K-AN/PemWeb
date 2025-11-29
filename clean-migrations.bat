@echo off
echo Cleaning up duplicate migrations...

REM Hapus migration yang error
del "database\migrations\2025_01_29_add_fitur_to_tryouts_table.php" 2>nul
del "database\migrations\2025_01_29_add_interests_talents_to_users_table.php" 2>nul

REM Hapus migration dengan nama [timestamp]
for %%f in (database\migrations\[timestamp]*.php) do (
    if not "%%~nxf"=="[timestamp]_create_academic_events_table.php" (
        if not "%%~nxf"=="[timestamp]_create_tryouts_table_final.php" (
            if not "%%~nxf"=="[timestamp]_update_beasiswas_add_missing_columns.php" (
                del "%%f"
            )
        )
    )
)

REM Hapus migration duplikat 2025_01_XX
del "database\migrations\2025_01_XX_add_fields_to_users_table.php" 2>nul
del "database\migrations\2025_01_XX_create_tryouts_table.php" 2>nul
del "database\migrations\2025_01_XX_update_beasiswas_table.php" 2>nul

REM Hapus migration fix
del "database\migrations\2025_11_29_122649_add_new_columns_to_beasiswas_table_fix.php" 2>nul

echo Done! Now run: php artisan migrate:fresh --seed
pause
