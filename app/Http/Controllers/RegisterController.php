<?php

namespace App\Http\Controllers;

use App\Common;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class RegisterController extends Controller {

  /**
   * @param array $data
   */
  protected function create() {
    return view('register');
  }

  /**
   * @param array $data
   */
  protected function store(Request $request) {
    try {
      $reference_number = Common::generateReferenceNumber();

      $id = \DB::table('users')->insertGetId([
        'reference_number' => $reference_number,
        'email_address'    => $request->email_address,
        'first_name'       => $request->first_name,
        'middle_initial'   => $request->middle_initial,
        'last_name'        => $request->last_name,
        'nickname'         => $request->nickname,
        'contact_number'   => $request->contact_number,
        'company'          => $request->company,
        'job_title'        => $request->job_title,
        'batch'            => $request->batch,
        'referrer'         => $request->referrer
      ]);

      if ($request->companion_email_address) {
        $length = count($request->companion_email_address);
        for ($i = 0; $i < $length; $i++) {
          \DB::table('companions')->insert([
            'id'               => $id,
            'reference_number' => Common::generateReferenceNumber(),
            'email_address'    => $request->companion_email_address[$i],
            'first_name'       => $request->companion_first_name[$i],
            'middle_initial'   => $request->companion_middle_initial[$i],
            'last_name'        => $request->companion_last_name[$i],
            'nickname'         => $request->companion_nickname[$i],
            'company'          => $request->companion_company[$i],
            'job_title'        => $request->companion_job_title[$i],
            'batch'            => $request->companion_batch[$i]
          ]);
        }
      }

      Common::sendSteps($reference_number);
    } catch (QueryException $e) {
      return json_encode(['success' => false, 'error' => $e]);
    }

    return json_encode(['success' => true]);
  }
}
