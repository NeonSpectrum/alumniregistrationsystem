<?php

namespace App\Http\Controllers;

use App\Common;
use App\Exports\DataExport;
use App\Exports\SentTicketExport;
use App\Logged;
use Illuminate\Http\Request;

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
      if ($row->sent == 1) {
        $row->status = 'sent';
      } else if ($row->paid == 1) {
        $row->status = 'paid';
      }

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

  protected function exportall() {
    Common::createLog('Export Data to Excel');
    return \Excel::download(new DataExport, date('F_d_Y_h_i_s_A') . ' Alumni Registration Report.xlsx');
  }

  protected function exportsentticket() {
    Common::createLog('Export Sent Ticket to Excel');
    return \Excel::download(new SentTicketExport, date('F_d_Y_h_i_s_A') . ' Alumni Registration Report.xlsx');
  }

  /**
   * @param Request $request
   */
  protected function scanner(Request $request) {
    $code  = $request->code;
    $image = $request->image;

    if ($request->type == 'qrcode') {
      $user = Common::getRowByReferenceNumber($code);

      if (!$user->first()) {
        return response()->json(['success' => false, 'error' => 'Invalid QR Code.']);
      } else if (Logged::where('reference_number', $code)->first()) {
        return response()->json(['success' => false, 'error' => 'Already Logged In.']);
      } else {
        $image = str_replace('data:image/webp;base64,', '', $image);

        $image = str_replace(' ', '+', $image);

        $image = base64_decode($image);

        $file = public_path('loggedusers') . '/' . $code . '-qrcode.webp';

        file_put_contents($file, $image);

        Logged::create(['reference_number' => $code]);

        return response()->json(['success' => true, 'name' => $user->first()->first_name . ' ' . $user->first()->last_name]);
      }
    } else if ($request->type == 'picture') {
      $image = str_replace('data:image/png;base64,', '', $image);

      $image = str_replace(' ', '+', $image);

      $image = base64_decode($image);

      $file = public_path('loggedusers') . '/' . $code . '-picture.png';

      file_put_contents($file, $image);

      return response()->json(['success' => true]);
    }
  }

  protected function loggedList() {
    $logged = Logged::all();

    $data = [];

    foreach ($logged as $i => $row) {
      $data[$i]            = \DB::select("SELECT * FROM (SELECT first_name, last_name, nickname, reference_number, batch FROM `users` UNION SELECT first_name, last_name, nickname, reference_number, batch FROM companions) AS U WHERE reference_number='" . $row->reference_number . "'")[0];
      $data[$i]->logged_at = $row->updated_at->format('F d, Y h:i:s A');
    }

    return response()->json($data);
  }

  protected function raffle() {
    $logged = Logged::where('winner', 0)->get();

    $data = [];

    foreach ($logged as $row) {
      $data[] = \DB::select("SELECT * FROM (SELECT first_name, last_name, nickname, reference_number FROM `users` UNION SELECT first_name, last_name, nickname, reference_number FROM companions) AS U WHERE reference_number='" . $row->reference_number . "'")[0];
    }

    // $data = \DB::select('SELECT * FROM (SELECT first_name, last_name, nickname, reference_number FROM `users` UNION SELECT first_name, last_name, nickname, reference_number FROM companions) AS U');

    return view('raffle', ['data' => $data]);
  }

  /**
   * @param Request $request
   */
  protected function raffleWinner(Request $request) {
    Logged::where('reference_number', $request->ref)->update([
      'winner' => 1
    ]);
  }
}
