@extends('layouts.app')

@section('dashboard')
    Siswa
    <small>Tambah Siswa</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="{{ url('/admin/siswa') }}">Siswa</a></li>
    <li class="active">Tambah Siswa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Isi Form</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => route('siswa.store'), 'method' => 'post', 'files' => 'true']) !!}
                    @include('siswa._form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col (left) -->
        <!-- <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Upload</h3>
                </div> -->
                <!-- /.box-header -->
                <!-- form start -->
                <!-- {!! Form::open(['url' => route('import.books'), 'method' => 'post', 'files' => 'true', 'class' => 'form-horizontal']) !!}
                    @include('books._import')
                {!! Form::close() !!}
            </div>
        </div> -->
        <!-- /.col (right)-->
    </div>
    <!-- /.row -->
@endsection
