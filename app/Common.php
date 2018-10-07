<?php

namespace App;

use Illuminate\Contracts\Encryption\DecryptException;

class Common {

  /**
   * @param $code
   * @return mixed
   */
  public static function getEmail($code) {
    try {
      $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
      return $encrypter->decrypt($code);
    } catch (DecryptException $e) {
      abort(404);
    }
  }
}
