<?php

namespace App\Http\Controllers;

use App\Common;
use App\Exports\DataExport;

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

    $users = \DB::table('users')->where(['paid' => 1, 'sent' => 0])->get();

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

  protected function showSentTicket() {

    $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

    $total = 0;

    $users = \DB::table('users')->where('sent', 1)->get();

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

    return view('dashboard.sentticket', ['data' => $data, 'total' => $total]);
  }

  protected function showAll() {

    $encrypter = app('Illuminate\Contracts\Encryption\Encrypter');

    $total = 0;

    $users = \DB::table('users')->get();

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

    return view('dashboard.all', ['data' => $data, 'total' => $total]);
  }

  protected function export() {
    Common::createLog('Export Data to Excel');
    return \Excel::download(new DataExport, date('F_d_Y_h_i_s_A') . ' Alumni Registration Report.xlsx');
  }
}
