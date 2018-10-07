<?php

namespace App\Http\Controllers;

class DashboardController extends Controller {
  protected function show() {

    $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

    $users = \DB::table('users')->get();

    $data = [];

    foreach ($users as $row) {
      $data[] = ['data' => $row, 'code' => $encrypter->encrypt($row->email_address)];
    }

    return view('dashboard', ['data' => $data]);
  }
}
