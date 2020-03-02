@extends('layouts.app')

@section('dashboard')
    Dashboard
    <small>Guru</small>
@endsection

@section('breadcrumb')
    <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
@endsection

@section('content')
    <!-- Welcome -->
    <div class="row">
        <div class="col-md-12">
            <div class="callout callout-success">
              <h4>Selamat Datang di TabunganKu</h4>

              <p>Sistem Tabungan Siswa Digital</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Tabungan Siswa</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    Sistem Tabungan Siswa Digital
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
