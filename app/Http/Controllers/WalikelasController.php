<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Book;
use App\Author;
use App\BorrowLog;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\BookException;
use Session;
use Excel;
use PDF;
use Validator;

class WalikelasController extends Controller
{
    //
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
            $data = DB::table('wali_kelas')->get();
            return Datatables::of($data)->make(true);
            //      ->addColumn('action', function($data) {
            //          return view('datatable._action', [
            //              'form_url'          => route('books.destroy', $data->id),
            //              'confirm_message'    => 'Yakin mau menghapus? '. $data->nama_lengkap . '?'
            //          ]);
            // })->make(true);
        }

        $html = $htmlBuilder
            ->addColumn(['data' => 'nip', 'name' => 'nip', 'title' => 'NIP'])
            ->addColumn(['data' => 'nama_lengkap', 'name' => 'nama_lengkap', 'title' => 'Nama Lengkap'])
            ->addColumn(['data' => 'alamat', 'name' => 'alamat', 'title' => 'Alamat'])
            ->addColumn(['data' => 'telepon', 'name' => 'telepon', 'title' => 'Telepon'])
            ->addColumn(['data' => 'email', 'name' => 'email', 'title' => 'Email'])
            ->addColumn(['data' => 'nama_pengguna', 'name' => 'nama_pengguna', 'title' => 'Nama Pengguna'])
            ->addColumn(['data' => 'katasandi', 'name' => 'katasandi', 'title' => 'Kata Sandi'])
            ->addColumn(['data' => 'aktif', 'name' => 'aktif', 'title' => 'Aktif']);
            //->addColumn(['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false]);

        return view('walikelas.index')->with(compact('html'));
    }

    // public function destroy($id)
    // {
    //     $data = DB::table('walikelas')->where('id',$id)->delete();

    //     // Handle hapus buku via ajax
    //     if ($request->ajax()) return response()->json(['id' => $id]);

    //     Session::flash("flash_notification", [
    //         "level" => "success",
    //         "icon" => "fa fa-check",
    //         "message" => "Data berhasil dihapus"
    //     ]);

    //     return redirect()->route('walikelas.index');
    // }
}
