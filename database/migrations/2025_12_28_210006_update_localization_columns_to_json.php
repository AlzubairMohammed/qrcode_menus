<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Companies
        if (Schema::hasTable('companies')) {
            Schema::table('companies', function (Blueprint $table) {
                // Drop unique index first if it exists
                $res = DB::select("SHOW INDEX FROM companies WHERE Key_name = 'restorants_name_unique'");
                if (count($res) > 0) {
                    $table->dropUnique('restorants_name_unique');
                }
            });

            Schema::table('companies', function (Blueprint $table) {
                $table->text('name')->nullable()->change();
                $table->text('description')->nullable()->change();
                $table->text('address')->nullable()->change();
            });
        }

        // Categories
        if (Schema::hasTable('categories')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->text('name')->nullable()->change();
            });
        }

        // Extras
        if (Schema::hasTable('extras')) {
            Schema::table('extras', function (Blueprint $table) {
                $table->text('name')->nullable()->change();
            });
        }

        // Options
        if (Schema::hasTable('options')) {
            Schema::table('options', function (Blueprint $table) {
                $table->text('name')->nullable()->change();
            });
        }

        // Data migration
        $this->migrateToJSON('companies', ['name', 'description', 'address']);
        $this->migrateToJSON('categories', ['name']);
        $this->migrateToJSON('extras', ['name']);
        $this->migrateToJSON('options', ['name']);
        $this->migrateToJSON('items', ['name', 'description']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }

    private function migrateToJSON($table, $columns)
    {
        if (!Schema::hasTable($table)) {
            return;
        }
        foreach ($columns as $column) {
            DB::table($table)->whereNotNull($column)->where($column, 'not like', '{"%')->chunkById(100, function ($rows) use ($table, $column) {
                foreach ($rows as $row) {
                    $originalValue = $row->$column;
                    $jsonValue = json_encode(['en' => $originalValue]);
                    DB::table($table)->where('id', $row->id)->update([$column => $jsonValue]);
                }
            });
        }
    }
};
