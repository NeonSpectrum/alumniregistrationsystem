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

    $reference_number = Common::decrypt($code);

    $user = \DB::table('users')->where('reference_number', $reference_number)->first();

    if ($user) {
      Common::sendSteps($reference_number);

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
    ini_set('max_execution_time', 300);

    $code = $request->query('code', null);

    if (!$code) {
      abort(404);
    }

    $reference_number = Common::decrypt($code);

    $user = \DB::table('users')->where('reference_number', $reference_number)->first();

    if (!$user) {
      abort(404);
    }

    $mails = [
      [
        'email'      => $user->email_address,
        'ref'        => $user->reference_number,
        'first_name' => $user->first_name,
        'last_name'  => $user->last_name
      ]
    ];

    $companions = \DB::table('companions')->where('id', $user->id)->get();

    foreach ($companions as $companion) {
      $mails[] = [
        'email'      => $companion->email_address,
        'ref'        => $companion->reference_number,
        'first_name' => $companion->first_name,
        'last_name'  => $companion->last_name
      ];
    }

    foreach ($mails as $mail) {
      $img = Image::make(public_path('img/ticket1.png'));

      // $img->text($mail['ref'], 20, 20, function ($font) {
      //   $font->file(public_path('font/Crimson-Roman.ttf'));
      //   $font->size(64);
      //   $font->color('#fdf6e3');
      //   $font->valign('top');
      // });

      $QRCode = \QrCode::format('png')->size(200)->margin(1)->generate($mail['ref']);

      $img->insert($QRCode, 'bottom-right', 20, 20);

      $name  = $mail->first_name . ' ' . $mail->last_name;
      $image = $img->encode('png');

      try {
        \Mail::to($mail['email'])->send(new TicketMail($name, $image));
      } catch (\Exception $e) {
        return json_encode(['success' => false, 'error' => $e->getMessage()]);
      }
    }

    return json_encode(['success' => true]);
  }

  /**
   * @return mixed
   */
  protected function display() {
    $img = Image::make(public_path('img/ticket1.png'));

    // $img->text(str_pad(1, 5, '0', STR_PAD_LEFT), 20, 20, function ($font) {
    //   $font->file(public_path('font/Crimson-Roman.ttf'));
    //   $font->size(64);
    //   $font->color('#fdf6e3');
    //   $font->valign('top');
    // });

    $QRCode = \QrCode::format('png')->size(200)->margin(1)->generate('QR Code Generator for Laravel!');

    $img->insert($QRCode, 'bottom-right', 20, 20);
    return $img->response('png');
  }
}
