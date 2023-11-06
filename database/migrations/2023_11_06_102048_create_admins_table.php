<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        });

        
        DB::table('admins')->insert([
            'name' => 'Admin Name',
            'email' => 'admin@example.com',
            'password' => bcrypt('adminpassword'),
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
