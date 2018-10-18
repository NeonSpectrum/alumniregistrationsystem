<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model {
  /**
   * @var array
   */
  protected $fillable = [
    'username', 'password'
  ];
}
