@extends('admin.index')

@section('header', 'Sipariş Detayı')
@section('optional', 'No: '. $siparis->id)

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <div class="info" style="margin-bottom: 30px">
                        <div class="row">
                            <div class="col-md-6">
                                <b>Tarih:</b> {{ date('d.m.Y H:i', strtotime($siparis->tarih)) }} <br>
                                <b>Üye:</b> 
                                @if (is_numeric($siparis->uye_id))
                                <a href="{{ url('admin/uye/'. $siparis->uye_id) }}">
                                    {{ $siparis->isim }}
                                </a> 
                                @else
                                {{ $siparis->isim }}
                                @endif
                                <br>
                                <b>E-Posta:</b> 
                                <a href="mailto: {{ $siparis->mail }}">
                                    {{ $siparis->mail }}
                                </a>
                                <br>
                                <b>Gsm:</b> 
                                <a href="tel: {{ $siparis->tel }}">
                                    {{ $siparis->tel }}
                                </a>
                                <br>
                                <b>Ödeme:</b> {{ $siparis->odeme }}
                                @if ($siparis->odeme != 'Kart')
                                @if ($siparis->odeme != 'Kapıda Ödeme')
                                 - <?php echo $siparis->sekil ?>
                                @else
                                 - {{ floatval($siparis->sekil) }}₺
                                @endif
                                @endif
                            </div>
                            <div class="col-md-6">
                                <b>Fatura Adresi:</b> <br>
                                <?php echo $siparis->fatura ?> 
                                <br>
                                <b>Teslimat Adresi:</b> <br>
                                <?php echo $siparis->teslimat ?>
                            </div>
                        </div>
                    </div>
                    <div class="products">
                        <table class="table">
                            <tr>
                                <th colspan="2">Ürün</th>
                                <th>Fiyat</th>
                                <th>Adet</th>
                                <th>Toplam</th>
                            </tr>

                            <?php $toplam = 0 ?>

                            @foreach ($urunler as $i => $urun)
            
                            <?php $toplam += $urun->fiyat * $urun->adet ?>

                            <tr>
                                <td width="100"><img src="{{ asset('img/'. $urun->foto) }}"></td>
                                <td>{{ $urun->isim }}</td>
                                <td>{{ floatval($urun->fiyat) }}</td>
                                <td>{{ $urun->adet }}</td>
                                <td>{{ floatval($urun->fiyat * $urun->adet) }}</td>
                            </tr>
                            @endforeach
                            <tr>
                                <th colspan="3"></th>
                                <th>Ara Toplam</th>
                                <th>{{ floatval($toplam) }}</th>
                            </tr>
                            @if ($siparis->indirim > 0)
                            <tr>
                                <th colspan="3"></th>
                                <th>İndirim</th>
                                <th>{{ floatval($siparis->indirim) }}</th>
                            </tr>
                            @endif
                            
                            <?php $toplam += $siparis->kargo ?>

                            <tr>
                                <th colspan="3"></th>
                                <th>Kargo</th>
                                <th>{{ floatval($siparis->kargo) }}</th>
                            </tr>
                            @if ($siparis->odeme == 'Kapıda Ödeme')

                            <?php $toplam += $siparis->sekil ?>

                            <tr>
                                <th colspan="3"></th>
                                <th>Kapıda Ödeme</th>
                                <th>{{ floatval($siparis->sekil) }}</th>
                            </tr>
                            @endif

                            <tr>
                                <th colspan="3"></th>
                                <th>Toplam</th>
                                <th>{{ floatval($toplam - $siparis->indirim) }}</th>
                            </tr>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" style="margin: 30px 0 0 0">
                                <label>Sipariş Durumu</label>
                                <select name="durum" class="form-control">
                                    <option value="Onay Bekliyor">Onay Bekliyor</option>
                                    <option value="Onaylandı">Onaylandı</option>
                                    <option value="Kargoya Verildi">Kargoya Verildi</option>
                                    <option value="Tamamlandı">Tamamlandı</option>
                                    <option value="İptal Edildi">İptal Edildi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group" style="margin: 30px 0 0 0">
                                <label>Kargo No</label>
                                <input type="text" class="form-control" name="kargo_no">
                            </div>
                        </div>
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

<style type="text/css">
    
    .table
    {
        margin-bottom: 0;
    }

    .table img
    {
        width: 100px;
        height: 75px;
        object-fit: contain;
    }

    .table > tbody > tr > th,
    .table > tbody > tr > td
    {
        vertical-align: middle;
    }

</style>
@endsection

@section('script')

<script type="text/javascript">
    
    $('[name="durum"]').val('{{ $siparis->durum }}');

</script>

@endsection