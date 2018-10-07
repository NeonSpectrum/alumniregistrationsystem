<?php

namespace App\Http\Controllers;

use App\Common;
use App\Mail\StepMail;
use App\Mail\TicketMail;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class MailController extends Controller {
  /**
   * @param Request $request
   */
  protected function sendSteps(Request $request) {
    $code = $request->query('code', null);

    if (!$code) {
      abort(404);
    }

    $email = Common::getEmail($code);

    $user = \DB::table('users')->where('email_address', $email)->first();

    if ($user) {
      $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

      $data = new \stdClass();

      $data->name = $user->first_name . ' ' . $user->last_name;
      $data->code = $encrypter->encrypt($email);

      \Mail::to($email)->send(new StepMail($data));

      return redirect('register');
    } else {
      abort(404);
    }
  }

  /**
   * @param Request $request
   * @return mixed
   */
  protected function sendTicket(Request $request) {
    $code = $request->query('code', null);

    if (!$code) {
      abort(404);
    }

    $email = Common::getEmail($code);

    $user = \DB::table('users')->where('email_address', $email)->first();

    $img = Image::make(asset('public/img/ticket.jpg'));

    $img->text(str_pad((int) $user->id, 5, '0', STR_PAD_LEFT), 108, 60, function ($font) {
      $font->file(2);
      $font->size(100);
    });

    $name  = $user->first_name . ' ' . $user->last_name;
    $image = $img->encode('png');

    try {
      \Mail::to($email)->send(new TicketMail($name, $image));
      return json_encode(['success' => true]);
    } catch (\Exception $e) {
      return json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
  }
}
