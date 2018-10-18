<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model {

  /**
   * @var mixed
   */
  public $timestamps = false;

  /**
   * @var array
   */
  protected $fillable = [
    'username', 'action'
  ];
}
