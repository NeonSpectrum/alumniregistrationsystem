<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DataExport implements FromView, ShouldAutoSize {
  /**
   * @return \Illuminate\Support\Collection
   */
  public function view(): View{
    $users = \DB::table('users')->get();

    $data = [];

    foreach ($users as $row) {
      $companions = \DB::table('companions')->where('id', $row->id)->get();

      $data[] = [
        'data'       => $row,
        'companions' => $companions
      ];
    }

    return view('exports.data', ['data' => $data]);
  }
}
