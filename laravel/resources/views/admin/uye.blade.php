@extends('admin.index')

@section('header', 'Üyeler')
@section('optional', 'Düzenle')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    @foreach (['isim' => 'Ad Soyad', 'mail' => 'Mail', 'tel' => 'Tel'] as $column => $name)
                    <div class="form-group">
                        <label for="{{ $column }}">{{ $name }}</label>
                        <input type="text" name="{{ $column }}" id="{{ $column }}" 
                        class="form-control" value="{{ $gelen->$column }}" required>
                    </div>
                    @endforeach
                    <div class="form-group">
                        <label for="sifre">@if ($gelen->id) Yeni @endif Şifre</label>
                        <input type="password" name="sifre" id="sifre" class="form-control">
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="onay" @if ($gelen->onay) checked @endif>
                                Aktivasyon
                            </label>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="yap">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit" value="Kaydet">Kaydet</button>
                    <button type="submit" class="btn btn-danger" value="{{ !$gelen->sil ? 'Sil' : 'Geri Al' }}" 
                        onclick="return confirm('Emin misiniz?')">
                        {{ !$gelen->sil ? 'Sil' : 'Geri Al' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
<!-- /.content -->
@endsection