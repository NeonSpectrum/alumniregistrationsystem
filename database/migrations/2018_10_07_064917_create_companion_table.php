<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanionTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('companions', function (Blueprint $table) {
      $table->unsignedInteger('id');
      $table->foreign('id')->references('id')->on('users');
      $table->string('reference_number')->unique();
      $table->string('email_address');
      $table->string('first_name');
      $table->string('middle_initial');
      $table->string('last_name');
      $table->string('company')->nullable();
      $table->string('job_title')->nullable();
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
    Schema::dropIfExists('companions');
  }
}
