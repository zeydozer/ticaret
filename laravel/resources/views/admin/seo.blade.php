@extends('admin.index')

@section('header', 'Ayarlar')
@section('optional', 'Seo')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    @foreach ($seo as $name => $value)
                    <div class="form-group">
                        <label>{{ ucfirst($name) }}</label>
                        <input type="text" name="{{ $name }}" class="form-control" value="{{ $value }}" required>
                    </div>
                    @endforeach
                </div>
                <input type="hidden" name="yap">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit" value="Kaydet">Kaydet</button>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
<!-- /.content -->
@endsection