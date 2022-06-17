@extends('admin.index')

@section('header', 'Üyeler')

<?php $tip = Request::has('tip') ? Request::get('tip') : 'hepsi' ?>

@section('optional', ucfirst($tip))

@section('content')
<!-- Main content -->
<section class="content container-fluid">

  <div class="row">
    <div class="col-md-8">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Toplam: {{ $toplam }}</h3>
          <div class="box-tools">
            <form class="input-group input-group-sm" style="width: 130px;" 
            method="get" action="/admin/uye" id="arama">
              <input type="hidden" name="tip" value="{{ $tip }}">
              <input type="text" name="aranan" class="form-control pull-right" required>
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
              </div>
              <input type="hidden" name="sira" value="{{ implode(' ', $sira) }}">
              <input type="hidden" name="sayfa" value="1">
            </form>
          </div>
        </div>
        <div class="box-body no-padding table-responsive">
          <table class="table">
            <tr>
              <th>#</th>
              <th sort="isim">Ad Soyad</th>
              <th sort="mail">E-Posta</th>
              <th sort="tel">Telefon</th>
              <th sort="onay">Aktivasyon</th>
              <th sort="sil">Arşiv</th>
              <td></td>
            </tr>
            @foreach ($uyeler as $i => $uye)
            <tr>
              <td><b>{{ $limit + $i + 1 }})</b></td>
              <td>{{ $uye->isim }}</td>
              <td><a href="mailto:{{ $uye->mail }}">{{ $uye->mail }}</a></td>
              <td><a href="tel:{{ $uye->tel }}">{{ $uye->tel }}</a></td>
              <td><i class="fa fa-{{ $uye->onay ? 'check' : 'minus' }}"></i></td>
              <td><i class="fa fa-{{ $uye->sil ? 'check' : 'minus' }}"></i></td>
              <td>
                <a href="/admin/uye/{{ $uye->id }}">
                  <i class="fa fa-pencil"></i>
                </a>
              </td>
            </tr>
            @endforeach
          </table>
        </div>
        @if ($toplam > $goster)
        <div class="box-footer clearfix">
          <?php echo $sayfala ?> &nbsp;&nbsp;&nbsp;
          {{ $sayfa_no = ceil($toplam / $goster) }} Sayfa
        </div>
        @endif
      </div>
    </div>
  </div>

  <style>
    tr td {
      vertical-align: middle !important
    }

    tr th {
      white-space: nowrap
    }

    tr th[sort] {
      cursor: pointer;
    }

    tr td img {
      width: 100px;
      display: block;
      object-fit: contain;
      margin-bottom: 10px;
    }

    .box-footer {
      color: #337ab7;
    }

    .box-footer select {
      display: inline-block;
      width: auto;
    }

    .box-footer a {
      cursor: pointer;
    }

    .box-footer a:first-child {
      margin-right: 10px;
    }

    .box-footer a:last-child {
      margin-left: 10px;
    }
  </style>

</section>
<!-- /.content -->
@endsection