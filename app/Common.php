<?php

namespace App;

use App\Mail\StepMail;
use Illuminate\Contracts\Encryption\DecryptException;

class Common {

  /**
   * @param $email
   */
  public static function sendSteps($reference_number) {
    $user = \DB::table('users')->where('reference_number', $reference_number)->first();

    $data = new \stdClass();

    $data->user = $user;
    $data->code = Common::encrypt($user->reference_number);

    \Mail::to($user->email_address)->send(new StepMail($data));
  }

  /**
   * @param $code
   * @return mixed
   */
  public static function decrypt($string) {
    try {
      $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
      return $encrypter->decrypt($string);
    } catch (DecryptException $e) {
      abort(404);
    }
  }
  /**
   * @param $string
   * @return mixed
   */
  public static function encrypt($string) {
    try {
      $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
      return $encrypter->encrypt($string);
    } catch (DecryptException $e) {
      abort(404);
    }
  }

  /**
   * @return mixed
   */
  public static function generateReferenceNumber() {
    do {
      $ref = Common::generateRandomString(10);
    } while (\DB::table('users')->select('reference_number')->union(\DB::table('companions')->select('reference_number'))->where('reference_number', $ref)->count() > 0);

    return $ref;
  }

  /**
   * @return mixed
   */
  public static function generateRandomString($length = 32) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string     = '';

    for ($i = 0; $i < $length; $i++) {
      $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
  }
}
