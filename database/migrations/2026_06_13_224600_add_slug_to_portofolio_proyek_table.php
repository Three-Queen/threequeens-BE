<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portofolio_proyek', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('id');
        });

        $portofolios = DB::table('portofolio_proyek')->get();
        foreach ($portofolios as $portofolio) {
            DB::table('portofolio_proyek')
                ->where('id', $portofolio->id)
                ->update(['slug' => Str::random(10)]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portofolio_proyek', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
