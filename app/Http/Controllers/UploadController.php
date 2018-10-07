<?php

namespace App\Http\Controllers;

use App\Common;
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

    $email = $this->getEmail($code);

    $user = \DB::table('users')->where('email_address', $email)->first();

    if ($user) {
      return view('upload', ['code' => $code]);
    }

    abort(404);
  }

  /**
   * @param Request $request
   */
  protected function store(Request $request) {
    $filename = time() . '.' . $request->file->getClientOriginalExtension();

    $request->file->move(public_path('references'), $filename);

    $email = Common::getEmail($request->code);

    try {
      \DB::table('users')->where('email_address', $email)->update([
        'reference_file_name' => $filename
      ]);
    } catch (QueryException $e) {
      return json_encode(['success' => false, 'error' => $e]);
    }

    return json_encode(['success' => true]);
  }
}
