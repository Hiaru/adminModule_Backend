<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('security')->create('security.users_databases', function (Blueprint $table) {

            // Charset / Collation
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // Table comments
            $table->comment('Tablas registadas de los sistemas a administrar');

            $table->id();
            $table->string('database_name',100)->unique();
            $table->string('title',100);
            $table->string('description',100);
            $table->string('model',100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('security')->dropIfExists('security.users_databases');
    }
};
