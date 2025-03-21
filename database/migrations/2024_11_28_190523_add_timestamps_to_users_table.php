<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->timestamps(); // Ajoute `created_at` et `updated_at`
        $table->unique('name');
    });

}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropTimestamps(); // Supprime `created_at` et `updated_at`
    });
}
};
