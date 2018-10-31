<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller {
  /**
   * @return mixed
   */
  protected function show() {
    $users = \DB::table('users')->where('sent', 1)->get();

    foreach ($users as $user) {
      $companions = \DB::table('companions')->where('id', $user->id)->get();

      $names = [];

      foreach ($companions as $companion) {
        $names[] = $companion->first_name . ' ' . $companion->last_name;
      }

      $user->companions = [
        'count' => $companions->count(),
        'names' => join('<br>', $names)
      ];

      $user->date_sent = \DB::table('logs')->whereRaw('action LIKE "%Ticket%' . $user->email_address . '%"')->first()->created_at;
    }

    $pdf = \PDF::loadView('pdf.report', ['data' => $users]);

    return $pdf->stream();
  }
}
