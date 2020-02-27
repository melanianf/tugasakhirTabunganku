@extends('layouts.app')

@section('dashboard')
   Kelas
   <small>Ubah Kelas</small>
@endsection

@section('breadcrumb')
   <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a></li>
   <li><a href="{{ url('/admin/kelas') }}">Kelas</a></li>
   <li class="active">Ubah Kelas</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Ubah Kelas</h3>
                </div>
                <!-- /.box-header -->
                {!! Form::model($data, ['url' => route('kelas.update', $data->id), 'method' => 'put']) !!}
                    @include('kelas._form')
                {!! Form::close() !!}
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
@endsection
