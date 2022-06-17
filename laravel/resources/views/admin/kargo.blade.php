@extends('admin.index')

@section('header', 'Ayarlar')
@section('optional', 'Kargo')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <div class="form-group">
                        <label>Kargo Ücreti</label>
                        <input type="number" name="kargo" min="0" step="0.01" 
                        class="form-control" value="{{ $ayar->kargo }}" required>
                    </div>
                    <div class="form-group">
                        <label>Kapıda Ödeme</label> - 
                        <small>Kargo ücretinin üzerine ilave şeklinde.</small>
                        <input type="number" name="kapi" min="0" step="0.01" 
                        class="form-control" value="{{ $ayar->kapi }}" required>
                    </div>
                    <div class="form-group">
                        <label>Ücresiz Kargo Limiti</label>
                        <input type="number" name="ucretsiz" min="0" step="0.01" 
                        class="form-control" value="{{ $ayar->ucretsiz }}" required>
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