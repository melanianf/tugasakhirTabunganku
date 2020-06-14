@extends('layouts.app')

@section('dashboard')
    Konfirmasi Status
    <small>Konfirmasi Status Siswa</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Konfirmasi Status</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Konfirmasi Status Siswa</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                {!! Form::open(['url' => route('siswa.perbarui'), 'method' => 'post']) !!}
                    @include('siswa.formkonfirm')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col (left) -->
        <!-- /.col (right)-->
    </div>
    <!-- /.row -->
@endsection
