<?php

namespace App\Http\Controllers;

use App\User;
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
    // $validator = Validator::make($request->all(), [
    //   'last_name'      => 'required',
    //   'first_name'     => 'required',
    //   'middle_initial' => 'required',
    //   'email_address'  => 'required|email',
    //   'contact_number' => 'required',
    //   'company'        => 'required',
    //   'job_title'      => 'required'
    // ]);

    // if ($validator->fails()) {
    //   return json_encode(['success' => false, 'error' => $validator]);
    // }

    try {
      $user = User::create(request(['email_address', 'first_name', 'middle_initial', 'last_name', 'contact_number', 'company', 'job_title']));
    } catch (QueryException $e) {
      return json_encode(['success' => false, 'error' => $e]);
    }

    return json_encode(['success' => true]);
  }
}
