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
        Schema::connection('security')->create('security.root', function (Blueprint $table) {
            // Charset / Collation
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_unicode_ci';

            // Table comments
            $table->comment('Usuarios admin para el manejo de usuarios');

            $table->id();
            $table->string('username',10)->unique();
            $table->string('name',50);
            $table->string('lastname',50);
            $table->string('password');
            $table->boolean('accAuthorized');
            $table->rememberToken();
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
        Schema::connection('security')->dropIfExists('security.root');
    }
};
