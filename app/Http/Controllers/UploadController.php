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
    $filename = time() . '.' . $request->file->getClientOriginalExtension();

    $mime = $request->file->getMimeType();

    $request->file->move(public_path('references'), $filename);

    $reference_number = Common::decrypt($request->code);

    try {
      \DB::table('users')->where('reference_number', $reference_number)->update([
        'reference_file_name' => $filename
      ]);

      $user = \DB::table('users')->where('reference_number', $reference_number)->first();

      \Mail::to('aseret_f@yahoo.com')->send(new SendPictureMail($user->first_name . ' ' . $user->last_name, public_path('references') . '/' . $filename, $mime));
      Common::createLog("Deposit slip of {$reference_number} has been sent to aseret_f@yahoo.com");
    } catch (QueryException $e) {
      return json_encode(['success' => false, 'error' => $e]);
    } catch (\Exception $e) {
      return json_encode(['success' => false, 'error' => $e->getMessage()]);
    }

    return json_encode(['success' => true]);
  }
}
