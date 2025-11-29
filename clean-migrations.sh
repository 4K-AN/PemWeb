#!/bin/bash

echo "🧹 Cleaning up migration conflicts..."

# Hapus migration yang error dari database
php artisan tinker << EOF
DB::table('migrations')->where('migration', 'like', '%add_fitur_to_tryouts%')->delete();
DB::table('migrations')->where('migration', 'like', '%create_fixations%')->delete();
exit
EOF

echo "✅ Migration cleanup complete!"
echo "Now run: php artisan migrate:fresh --seed"
