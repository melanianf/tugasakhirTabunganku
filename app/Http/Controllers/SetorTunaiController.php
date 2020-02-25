<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Author;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class SetorTunaiController extends Controller
{
    //
    public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {

            $authors = Author::select(['id', 'name']);

            return Datatables::of($authors)
            ->addColumn('action', function($author) {
                return view('datatable._action', [
                    'model' => $author,
                    'form_url' => route('authors.destroy', $author->id),
                    'edit_url' => route('authors.edit', $author->id),
                    'confirm_message' => 'Yakin mau menghapus ' . $author->name . '?'
                ]);
            })->make(true);
        }

        $html = $htmlBuilder
        ->addColumn(['data' => 'name', 'name' => 'name', 'title' => 'Nama'])
        ->addColumn(['data' => 'action', 'name' => 'action', 'title' => '', 'orderable' => false, 'searchable' => false]);

        return view('setortunai.index')->with(compact('html'));
    }

}
