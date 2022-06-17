@extends('admin.index')

@section('header', 'Ürünler')
@section('optional', 'Düzenle')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-lg-10">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    
                    <div class="row">
                        <div class="col-sm-{{ $set ? 3 : 6 }}">
                            <div class="form-group">
                                <label>İsim</label>
                                <input type="text" name="isim" class="form-control" 
                                value="{{ $gelen->isim }}" required>
                            </div>
                        </div>
                        <div class="col-sm-{{ $set ? 3 : 6 }}">
                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="kat_id" class="form-control">
                                    <option value="">- Yok</option>
                                    @if (count($kategoriler) > 0)
                                    @foreach ($kategoriler as $kat_id => $kategori)
                                    
                                    <?php $select = $gelen->kat_id == $kat_id ? 'selected' : ''; ?>
                                    
                                    <option value="{{ $kat_id }}" {{ $select }}>{{ $kategori }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        @if ($set)
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Fiyat</label>
                                <input type="number" name="fiyat" class="form-control" 
                                value="{{ $gelen->fiyat }}" required min="1" step="0.01"
                                readonly>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>İndirim</label>
                                <input type="number" name="indirim" class="form-control" 
                                value="{{ $gelen->indirim }}" min="0" step="0.01"
                                readonly>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if (!$set)
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Stok Kodu</label>
                                <input type="text" name="kod" class="form-control" value="{{ $gelen->kod }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Stok</label>
                                <input type="number" name="stok" class="form-control" 
                                value="{{ $gelen->stok }}" min="0" step="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Fiyat</label>
                                <input type="number" name="fiyat" class="form-control" 
                                value="{{ $gelen->fiyat }}" required min="1" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>İndirim</label>
                                <input type="number" name="indirim" class="form-control" 
                                value="{{ $gelen->indirim }}" min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Marka</label>
                                <input type="text" name="marka" class="form-control" value="{{ $gelen->marka }}">
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- # set -->
                    <hr> 
                    <div class="form-group">
                        <label style="margin-bottom: 15px">Set Ürünleri</label>
						<div id="urun">
                            @foreach ($set_urun as $urun_id)
                            <div class="form-group">	
								<div class="row">
                                    <div class="col-sm-10">
                                        <select name="set[]" class="form-control select2">
                                            <option value="">- Seçin</option>
                                            @if (count($urunler) > 0)
                                            @foreach ($urunler as $urun)

                                            <?php $select = $urun->id == (int) $urun_id ? 'selected' : '' ?>

                                            <option value="{{ $urun->id }}" {{ $select }}>{{ $urun->isim }}</option>
                                            @endforeach
                                            @endif
                                        </select>
									</div>
									<div class="col-sm-2 ekle-sil">
										<a class="btn btn-primary ekle urun-ekle"><i class="fa fa-plus"></i></a>
										<a class="btn btn-danger sil urun-sil"><i class="fa fa-times"></i></a>
									</div>
								</div>
                            </div>
                            @endforeach
						</div>
                    </div>
                    <!-- set # -->
                    @endif
                    <!-- # özellik -->
                    <hr>
                    <div class="form-group">
                        <label style="margin-bottom: 15px">Başlıca Özellikler</label>
						<div id="ozellik">
                            @foreach ($ozellik as $deger)
                            <div class="form-group">	
								<div class="row">
                                    <div class="col-sm-10">
                                        <input type="text" name="ozellik[]" class="form-control" 
                                        placeholder="Özellik" value="{{ $deger }}">
									</div>
									<div class="col-sm-2 ekle-sil">
										<a class="btn btn-primary ekle ozellik-ekle"><i class="fa fa-plus"></i></a>
										<a class="btn btn-danger sil ozellik-sil"><i class="fa fa-times"></i></a>
									</div>
								</div>
                            </div>
                            @endforeach
						</div>
                    </div>
                    <!-- özellik # -->
                    <!-- # açıklama -->
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Ön Açıklama</label>
                                <textarea name="on_aciklama" rows="5" class="form-control aciklama"><?php echo $gelen->on_aciklama ?></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Açıklama</label>
                                <textarea name="aciklama" rows="5" class="form-control aciklama"><?php echo $gelen->aciklama ?></textarea>
                            </div>
                        </div>
                    </div>
                    @if (count($fotolar_a) > 0)
                    <div class="galeri-container-a">
                        <div class="row galeri-a">
                            @foreach ($fotolar_a as $i => $foto)
                            <div class="col-md-3 col-sm-4" id="{{ $foto }}">
                                <a href="/img/{{ $foto }}" data-fancybox="qwe-a">
                                    <img src="/img/{{ $foto }}" class="one-img">
                                </a>
                                <div class="checkbox text-center">
                                    <label>
                                        <input type="checkbox" name="foto-sil-a[]" value="{{ $foto }}">
                                        Fotoğrafı Kaldır
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="foto">Açıklama Fotoğrafı Ekle</label>
                        <input type="file" name="foto-a[]" id="foto" multiple class="form-control">
                    </div>
                    <hr>
                    <!-- açıklama # -->
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="vitrin" @if ($gelen->vitrin) checked @endif>
                                        Öne Çıkan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="yeni" @if ($gelen->yeni) checked @endif>
                                        Yeni Gelen
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="ana" @if ($gelen->ana) checked @endif>
                                        Anasayfa
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="paket" @if ($gelen->paket) checked @endif>
                                        Pakete Özel
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- # fotolar -->
                    <hr>
                    @if (count($fotolar) > 0)
                    <div class="galeri-container">
                        <div class="row galeri">
                            @foreach ($fotolar as $i => $foto)
                            <div class="col-md-3 col-sm-4" id="{{ $foto->id }}">
                                <a href="/img/{{ $foto->deger }}" data-fancybox="qwe">
                                    <img src="/img/{{ $foto->deger }}" class="one-img">
                                </a>
                                <div class="checkbox text-center">
                                    <label>
                                        <input type="checkbox" name="foto-sil[]" value="{{ $foto->deger }}">
                                        Fotoğrafı Kaldır
                                    </label>
                                </div>
                                <div class="radio text-center">
                                    @php $checked = $foto->profil == 1 ? 'checked' : '' @endphp
                                    <label>
                                        <input type="radio" name="profil-sec" value="{{ $foto->deger }}" {{ $checked }}> 
                                        Profil Fotoğrafı
                                    </label>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="profil">Profil Fotoğrafı</label>
                                <input type="file" name="profil" id="profil" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto">Fotoğraf Ekle</label>
                                <input type="file" name="foto[]" id="foto" multiple class="form-control"
                                @if ($set) disabled @endif>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <?php if ($gelen->video) : $temp = explode('/watch?v=', $gelen->video); ?>

                    <iframe src="https://www.youtube.com/embed/{{ $temp[1] }}?rel=0&showinfo=0" 
                    style="width: 100%; height: 300px; border: none; margin-bottom: 10px" allowfullscreen></iframe>
                    @endif
                    <div class="form-group">
                        <label>Video (Youtube)</label>
                        <input type="url" name="video" class="form-control" value="{{ $gelen->video }}">
                    </div>
                    <hr>
                    <!-- fotolar # -->
                    <!-- # teknik -->
                    <div class="form-group">
                        <label style="margin-bottom: 15px">Teknik Özellikler</label>
						<div id="teknik">
                            @foreach ($teknik as $ozel => $deger)
                            <div class="form-group">	
								<div class="row">
                                    <div class="col-sm-5">
                                        <input type="text" name="ozel[]" class="form-control" 
                                        placeholder="Özellik" value="{{ $ozel }}">
									</div>
									<div class="col-sm-5">
                                        <input type="text" name="deger[]" class="form-control" 
                                        placeholder="Değer" value="{{ $deger }}">
									</div>
									<div class="col-sm-2 ekle-sil">
										<a class="btn btn-primary ekle teknik-ekle"><i class="fa fa-plus"></i></a>
										<a class="btn btn-danger sil teknik-sil"><i class="fa fa-times"></i></a>
									</div>
								</div>
                            </div>
                            @endforeach
						</div>
                    </div>
                    <!-- teknik # -->
                </div>
                <input type="hidden" name="yap">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="box-footer">
                    <button class="btn btn-primary" type="submit" value="Kaydet">Kaydet</button>
                    <button type="submit" class="btn btn-danger" value="{{ !$gelen->sil ? 'Arşive At' : 'Geri Al' }}" 
                        onclick="return confirm('Emin misiniz?')">
                        {{ !$gelen->sil ? 'Arşive At' : 'Geri Al' }}
                    </button>
                    <button type="submit" class="btn btn-warning" value="Sil" onclick="return confirm('Emin misiniz?')">
                        Sil
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</section>
<!-- /.content -->

<style>

    .one-img 
    { 
        width: 100%; 
        height: 150px; 
        object-fit: cover; 
        object-position: center;
    }

    [class^="galeri"] .col-md-3 
    { 
        margin-bottom: 15px; 
    }

    hr
    {
        margin-top: 0;
        margin-bottom: 15px;
    }

    @media (min-width: 992px)
    {
        .col-md-6:first-child

        {
            padding-right: 7.5px;
        }

        .col-md-6:last-child
        {
            padding-left: 7.5px;
        }
    }

    @media(min-width: 768px)
    {
        .col-sm-6:first-child,
        .col-sm-4:first-child,
        .col-sm-3:first-child,
        #teknik .col-sm-5:first-child,
        #ozellik .col-sm-10:first-child,
        #urun .col-sm-10:first-child
        {
            padding-right: 7.5px;
        }

        .col-sm-6:last-child,
        .col-sm-4:last-child,
        .col-sm-3:last-child,
        #teknik .ekle-sil,
        #ozellik .ekle-sil,
        #urun .ekle-sil
        {
            padding-left: 7.5px;
        }

        .col-sm-4:nth-child(2),
        .col-sm-3:nth-child(2),
        .col-sm-3:nth-child(3),
        #teknik .col-sm-5:nth-child(2)
        {
            padding-left: 7.5px;
            padding-right: 7.5px;
        }

        .galeri,
        .galeri-a
        {
            margin-left: -7.5px;
            margin-right: -7.5px;
        }

        .galeri .col-md-3,
        .galeri-a .col-md-3
        {
            padding-left: 7.5px;
            padding-right: 7.5px;
        }

        .galeri .checkbox,
        .galeri .radio,
        .galeri-a .checkbox
        {
            margin-bottom: 0;
        }

        .galeri .radio
        {
            margin-top: 0;
        }
    }

    #teknik .ekle, #teknik .sil,
    #ozellik .ekle, #ozellik .sil,
    #urun .ekle, #urun .sil
    {
    	vertical-align: top;
        width: calc(50% - 7.5px);
    }

    #teknik .ekle,
    #ozellik .ekle,
    #urun .ekle
    {
        float: left;
    }

    #teknik .sil,
    #ozellik .sil,
    #urun .sil
    {
    	margin-left: 15px;
        float: right;
    }

    #teknik .ekle-sil,
    #ozellik .ekle-sil,
    #urun .ekle-sil
    {
    	text-align: right;
    }

    @media (max-width: 991px)
    {
        #teknik .ekle, #teknik .sil,
        #ozellik .ekle, #ozellik .sil,
        #urun .ekle, #urun .sil
        {
            width: calc(50% - 1.5px);
        }

        #teknik .sil,
        #ozellik .sil,
        #urun .sil
        {
            margin-left: 3px;
        }
    }

    @media (max-width: 767px)
    {
        #teknik a,
        #ozellik a,
        #urun a
        {
            width: 100% !important;
            margin-left: 0 !important;
            margin-top: 5px !important;
            margin-bottom: 0;
        }

        #teknik .col-sm-2,
        #teknik .col-sm-5:nth-child(2),
        #ozellik .col-sm-2,
        #ozellik .col-sm-10,
        #urun .col-sm-2,
        #urun .col-sm-10
        {
            padding-left: 15px !important;
            padding-right: 15px !important
        }

        #teknik .col-sm-5:nth-child(2)
        {
            margin-top: 5px;
        }
    }

</style>
@endsection

@section('script')
<script>

    $(function()
    {
        $(".galeri-a").sortable(
        {
            stop: function(event, ui) 
            {
                datas = {};
                
                $('.galeri-a .col-md-3').each(function(i, li) 
                { 
                    datas[i + 1] = $(this).attr('id');
                });

                url = '/admin/urun/foto/{{ $gelen->id }}';

                $.ajax(
                {
                    type: 'get',
                    url: url,
                    data: datas
                });
            },

            containment: '.galeri-container-a'
        });

        var ekle_sil = '.teknik-ekle, .teknik-sil, .ozellik-ekle, .ozellik-sil, .urun-ekle, .urun-sil';

        $(document).on('click', ekle_sil, function(e)
        {
            e.preventDefault();

            var form_group = $(this).closest(".form-group").html();
                form_group = '<div class="form-group">'+ form_group +'</div>';
                
                button = $(this).attr('class').split(" ").pop();
                button_sira = $('.'+ button).index(this);
                
                container = '#'+ button.split('-')[0];

            if (button.indexOf('ekle') != -1)
            {
                $(form_group).insertAfter(container +" .form-group:eq("+ button_sira +")");

                $(container +" .form-group").eq(button_sira + 1).find('input, select').val(null);

                if (button.indexOf('urun') != -1)
                {
                    $(container +" .form-group").eq(button_sira + 1).find('.select2-container').remove();

                    $(container +" .form-group").eq(button_sira + 1).find('select').removeAttr('aria-hidden')
                        .removeAttr('tabindex').attr('class', 'select2 form-control');

                    setTimeout(function()
                    {
                        $(container +" .form-group").eq(button_sira + 1).find('select').select2();

                    }, 100);
                }
            }

            else
            {
                if ($(container +" .form-group").length > 1)
                    
                    $(this).closest(".form-group").remove();

                else $(this).closest(".form-group").find('input').val(null);
            }
        });

        function fiyat()
        {
            var ids = [];

            $('#urun select').each(function(i)
            {
                ids[i] = $(this).val();
            });

            $.ajax(
            {
                type: 'get',
                url: '/admin/urun/fiyat',
                data: {ids: ids},
                success: function(resp)
                {
                    $('[name="fiyat"]').val(resp.fiyat);
                    $('[name="indirim"]').val(resp.indirim);
                }
            });
        }

        $(document).on('change', '#urun select', function()
        {
            fiyat();
        
        }).on('click', '.urun-sil', function()
        {
            fiyat();
        });
    });

</script>
@endsection