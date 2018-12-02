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
      $table->string('nickname');
      $table->string('contact_number');
      $table->string('company');
      $table->string('job_title');
      $table->integer('batch');
      $table->string('referrer');
      $table->string('reference_file_name')->nullable();
      $table->tinyInteger('paid')->default(0);
      $table->tinyInteger('sent')->default(0);
      $table->string('remarks')->nullable();
      $table->timestamp('logged_at')->nullable();
      $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
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
