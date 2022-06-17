@extends('admin.index')

@section('header', 'Ayarlar')
@section('optional', 'Ödeme')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    @foreach ($odeme as $name => $value)
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="{{ $name }}" <?php if ($value == 1) { ?> checked <?php } ?>>
                                {{ ucfirst($name) }}
                            </label>
                        </div>
                    </div>
                    @endforeach
                    <hr>
                    <div class="form-group">
                        <label>İndirim Limiti</label>
                        <input type="number" name="a" min="0" step="0.01" 
                        class="form-control" value="{{ $indirim['a'] }}" required>
                    </div>
                    <div class="form-group">
                        <label>İndirim Tutarı</label>
                        <input type="number" name="b" min="0" step="0.01" 
                        class="form-control" value="{{ $indirim['b'] }}" required>
                    </div>
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