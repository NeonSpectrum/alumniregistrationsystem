<?php

namespace App\Http\Controllers;

class DashboardController extends Controller {
  protected function showRegistered() {

    $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

    $total = 0;

    $users = \DB::table('users')->where('paid', 0)->get();

    $total += $users->count();

    $data = [];

    foreach ($users as $row) {
      $companions = \DB::table('companions')->where('id', $row->id)->get();

      $total += $companions->count();

      $companionList = [];

      foreach ($companions as $companion) {
        $companionList[] = $companion->first_name . ' ' . $companion->last_name . ' | ' . $companion->email_address . ' | ' . $companion->reference_number;
      }

      $data[] = ['data' => $row, 'code' => $encrypter->encrypt($row->reference_number), 'companion' => join('<br>', $companionList)];
    }

    return view('dashboard.registered', ['data' => $data, 'total' => $total]);
  }

  protected function showPaid() {

    $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

    $total = 0;

    $users = \DB::table('users')->where('paid', 1)->get();

    $total += $users->count();

    $data = [];

    foreach ($users as $row) {
      $companions = \DB::table('companions')->where('id', $row->id)->get();

      $total += $companions->count();

      $companionList = [];

      foreach ($companions as $companion) {
        $companionList[] = $companion->first_name . ' ' . $companion->last_name . ' | ' . $companion->email_address . ' | ' . $companion->reference_number;
      }

      $data[] = [
        'data'      => $row,
        'code'      => $encrypter->encrypt($row->reference_number),
        'companion' => join('<br>', $companionList)
      ];
    }

    return view('dashboard.paid', ['data' => $data, 'total' => $total]);
  }
}
