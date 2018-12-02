<?php

namespace App;

use App\Mail\StepMail;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class Common {

  /**
   * @param $email
   */
  public static function sendSteps($reference_number) {
    $user = \DB::table('users')->where('reference_number', $reference_number)->first();

    $companions = \DB::table('companions')->where('id', $user->id)->get();

    $data = new \stdClass();

    $data->user       = $user;
    $data->companions = $companions;
    $data->code       = Common::encrypt($user->reference_number);
    $data->date       = date('l, F d, Y', strtotime('+5 weekday'));

    \Mail::to($user->email_address)->send(new StepMail($data));
    \App\Common::createLog('Sent Steps to: ' . $user->email_address);
  }

  /**
   * @param $reference_number
   */
  public static function getRowByReferenceNumber($reference_number) {
    $user = \DB::table('users')->where('reference_number', $reference_number);

    if (count($user->get()) == 0) {
      $user = \DB::table('companions')->where('reference_number', $reference_number);
    }

    return $user;
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

  /**
   * @param $action
   */
  public static function createLog($action) {
    \App\Logs::create([
      'username' => Auth::user()->username ?? 'N/A',
      'action'   => $action
    ]);
  }

  /**
   * @return mixed
   */
  public static function getRealIpAddr() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
      $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }
}
