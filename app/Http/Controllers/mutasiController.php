<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;

class mutasiController extends Controller
{
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $data = DB::table('transaksi')->get();
            return Datatables::of($data)->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'kode_transaksi', 'name' => 'kode_transaksi', 'title' => 'Kode Transaksi'])
            ->addColumn(['data' => 'nis', 'name' => 'nis', 'title' => 'NIS'])
            ->addColumn(['data' => 'jenis_tabungan', 'name' => 'jenis_tabungan', 'title' => 'Jenis Tabungan'])
            ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Tanggal Transaksi', 'orderable' => 'false', 'searchable' => false]);

        return view('mutasi.index')->with(compact('html'));
    }
}
