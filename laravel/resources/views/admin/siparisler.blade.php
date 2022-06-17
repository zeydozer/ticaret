@extends('admin.index')

@section('header', 'Siparişler')

<?php 
            
$tipler = 
[
  'hepsi' => null,
  'bekliyor' => 'Onay Bekleyen', 
  'onaylandı' => 'Onaylanan',
  'kargo' => 'Kargoya Verilen',
  'tamam' => 'Tamamlanan',
  'iptal' => 'İptal Olan',
];

$tip = Request::has('tip') ? Request::get('tip') : 'hepsi';

?>

@section('optional', $tipler[$tip])

@section('content')
<!-- Main content -->
<section class="content container-fluid">

  <div class="row">
    <div class="col-md-12">
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Toplam: {{ $toplam }}</h3>
          <div class="box-tools">
            <form class="input-group input-group-sm" style="width: 130px;" method="get" action="{{ url('admin/siparis') }}"
              id="arama">
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
              <th sort="siparis.tarih">Tarih</th>
              <th sort="siparis.id">No</th>
              <th sort="uye.isim">İsim</th>
              <th sort="uye.mail">E-Posta</th>
              <th sort="uye.tel_gsm">Telefon</th>
              <th sort="siparis.odeme">Ödeme</th>
              <th>Tutar</th>
              <th sort="siparis.durum">Durum</th>
              <th></th>
            </tr>
            @foreach ($siparisler as $i => $siparis)
            
            <?php 

            $tutar = App\Detay::selectRaw('sum(fiyat * adet) as toplam')->where('siparis_id', $siparis->id)->first()->toplam;

            $tutar += $siparis->kargo; if ($siparis->odeme == 'Kapıda Ödeme') $tutar += $siparis->kapi;

            ?>
            
            <tr>
              <td><b>{{ $limit + $i + 1 }})</b></td>
              <td>{{ date('d.m.Y', strtotime($siparis->tarih)) }}</td>
              <td>{{ $siparis->id }}</td>
              <td>
                @if (is_numeric($siparis->uye_id))
                <a href="{{ url('admin/uye/'. $siparis->uye_id) }}">
                  {{ $siparis->isim }}
                </a>
                @else
                {{ $siparis->isim }}
                @endif
              </td>
              <td><a href="mailto:{{ $siparis->mail }}">{{ $siparis->mail }}</a></td>
              <td><a href="tel:{{ $siparis->tel }}">{{ $siparis->tel }}</a></td>
              <td>{{ $siparis->odeme }}</td>              
              <td>{{ floatval($tutar - $siparis->indirim) }}</td>
              <td>{{ $siparis->durum }}</td>
              <td>
                <a href="{{ url('admin/siparis/'. $siparis->id) }}">
                  <i class="fa fa-eye"></i>
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