@extends('admin.index')

@section('header', 'Ayarlar')
@section('optional', 'Banka')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <div class="form-group">
                        <select name="id" class="form-control" onchange="location.href = '/admin/ayar/banka/'+ value">
                            <option value="" selected>+ Yeni</option>
                            @if (count($bankalar) > 0)
                            @foreach ($bankalar as $banka)
                            
                            <?php $select = $gelen->id == $banka->id ? 'selected' : ''; ?>
                            
                            <option value="{{ $banka->id }}" {{ $select }}>{{ json_decode($banka->data)->isim }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>İsim</label>
                                <input type="text" name="isim" class="form-control" value="{{ $temp->isim }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Şube</label>
                                <input type="text" name="sube" class="form-control" value="{{ $temp->sube }}" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Şube Kodu</label>
                                <input type="number" name="kod" class="form-control" value="{{ $temp->kod }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>IBAN</label>
                        <input type="text" name="iban" class="form-control" value="{{ $temp->iban }}" required>
                    </div>
                    @if ($temp->foto)
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/img/{{ $temp->foto }}" data-fancybox>
                                <img src="/img/{{ $temp->foto }}" height="150">
                            </a>
                        </div>
                    </div>
                    <hr>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Fotoğraf</label>
                                <input type="file" name="foto" id="foto" class="form-control" @if (!$gelen->id) required @endif>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Sıra</label>
                                <input type="number" name="sira" class="form-control" value="{{ $gelen->data_2 }}" required>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="yap">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit" value="Kaydet">Kaydet</button>
                    @if ($gelen->id)
                    <button type="submit" class="btn btn-danger" value="Sil" onclick="return confirm('Emin misiniz?')">Sil</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

</section>
<!-- /.content -->

<style>

    img
    {
        width: 80%;
        object-fit: contain;
        object-position: left;
    }

    @media (min-width: 992px)
    {
        .col-md-6:first-child,
        .col-md-4:first-child
        {
            padding-right: 7.5px;
        }

        .col-md-6:last-child,
        .col-md-4:last-child
        {
            padding-left: 7.5px;
        }

        .col-md-4:nth-child(2)
        {
            padding-left: 7.5px;
            padding-right: 7.5px;
        }
    }
    
    @media (max-width: 991px)
    {
        .col-md-6, 
        .col-md-4
        {
            padding-right: 15px;
            padding-left: 15px;
        }
    }

</style>
@endsection