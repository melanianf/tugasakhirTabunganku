<div class="box-body">
    <div class="form-group has-feedback{{ $errors->has('nama') ? ' has-error' : '' }}">
        {!! Form::label('nama', 'Nama Tabungan') !!}

        {!! Form::text('nama', null, ['class' => 'form-control', 'placeholder' => 'Nama Tabungan']) !!}
        {!! $errors->first('nama', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group has-feedback{{ $errors->has('deskripsi') ? ' has-error' : '' }}">
        {!! Form::label('deskripsi', 'Deskripsi') !!}

        {!! Form::text('deskripsi', null, ['class' => 'form-control', 'placeholder' => 'Deskripsi']) !!}
        {!! $errors->first('deksripsi', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="form-group row">
        <div class="col-sm-2"><b>Aktif</b></div>
            <div class="col-sm-10">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="gridCheck1">
                <!-- <label class="form-check-label" for="gridCheck1">
                    Example checkbox
                </label> -->
            </div>
        </div>
    </div>
    <!-- <div class="form-group has-feedback{{ $errors->has('aktif') ? ' has-error' : '' }}">
        {!! Form::label('aktif', 'Aktif') !!}

        {!! Form::text('aktif', null, ['class' => 'form-control', 'placeholder' => 'Aktif']) !!}
        {!! $errors->first('aktif', '<p class="help-block">:message</p>') !!}
    </div> -->
<!-- /.box-body -->

<div class="box-footer">
    {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
</div>
