<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->string('reference_number')->unique();
      $table->string('email_address')->unique();
      $table->string('first_name');
      $table->string('middle_initial');
      $table->string('last_name');
      $table->string('contact_number');
      $table->string('company');
      $table->string('job_title');
      $table->string('reference_file_name')->nullable();
      $table->tinyint('paid')->default(0);
      $table->tinyint('sent')->default(0);
      $table->string('remarks')->nullable();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('users');
  }
}
