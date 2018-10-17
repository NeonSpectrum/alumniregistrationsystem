<?php

namespace App\Http\Controllers;

class DashboardController extends Controller {
  protected function show() {

    $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

    $users = \DB::table('users')->get();

    $data = [];

    foreach ($users as $row) {
      $companions = \DB::table('companions')->where('id', $row->id)->get();

      $companionList = [];

      foreach ($companions as $companion) {
        $companionList[] = $companion->first_name . ' ' . $companion->last_name . ' (' . $companion->email_address . ')';
      }

      $data[] = ['data' => $row, 'code' => $encrypter->encrypt($row->reference_number), 'companion' => join('<br>', $companionList)];
    }

    return view('dashboard', ['data' => $data]);
  }
}
