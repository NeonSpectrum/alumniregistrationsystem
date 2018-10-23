<?php

namespace App\Http\Controllers;

use App\Common;
use App\Mail\SendPictureMail;
use Illuminate\Http\Request;
use \Illuminate\Database\QueryException;

class UploadController extends Controller {
  /**
   * @param Request $request
   */
  protected function create(Request $request) {
    $code = $request->query('code', null);

    if (!$code) {
      abort(404);
    }

    $reference_number = Common::decrypt($code);

    $user = \DB::table('users')->where('reference_number', $reference_number)->first();

    if ($user) {
      return view('upload', ['code' => $code]);
    }

    abort(404);
  }

  /**
   * @param Request $request
   */
  protected function store(Request $request) {
    putenv('TMPDIR=/var/www/tmp');

    $filename = time() . '.' . $request->file->getClientOriginalExtension();

    $request->file->move(public_path('references'), $filename);

    $reference_number = Common::decrypt($request->code);

    try {
      \DB::table('users')->where('reference_number', $reference_number)->update([
        'reference_file_name' => $filename
      ]);

      $user = \DB::table('users')->where('reference_number', $reference_number)->first();

      \Mail::to('youngskymann@gmail.com')->send(new SendPictureMail($user->first_name . ' ' . $user->last_name, $request->file));
    } catch (QueryException $e) {
      return json_encode(['success' => false, 'error' => $e]);
    }

    return json_encode(['success' => true]);
  }
}
