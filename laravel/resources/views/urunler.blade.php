@extends('index')

@section('title', $title)

@section('content')

<div class="container">
    
    @if (isset($breadcrumb)) 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/urunler">Ürünler</a></li>
            
            <?php $i = 1 ?>
            
            @foreach ($breadcrumb as $url => $name)
            <li class="breadcrumb-item @if ($i == count($breadcrumb)) active @endif" 
            @if ($i == count($breadcrumb)) aria-current="page" @endif>
                <a href="{{ $url }}">{{ $name }}</a>
            </li>

            <?php $i++ ?>

            @endforeach
        </ol>
    </nav>
    @else
    <div class="d-none d-md-block" style="height: calc(30px + 1rem)"></div>
    @endif

    <section class="row products-list">
        <h1 class="text-uppercase">{{ $title }}</h1>
        <form name="search" class="col-xl-3 col-lg-3 col-md-4 filter" 
        action="/{{ Request::path() }}" method="get">
            <a href="#" class="filter-button">Filtrele</a>
            @if (isset($ustler) && count($ustler) > 0)
            <div class="filter-item">
                <span class="title">Kategoriler</span>
                @foreach ($ustler as $kategori)
                <a href="/urunler/{{ $kategori->url }}">{{ $kategori->isim }}</a>
                @endforeach
            </div>
            @endif
            @if (count($kategoriler) > 0)
            <div class="filter-item">
                <span class="title">
                    @if (isset($ustler) && count($ustler) > 0)
                    Alt
                    @endif
                    Kategoriler
                </span>
                @foreach ($kategoriler as $kategori)
                <a href="/urunler/{{ $kategori->url }}">{{ $kategori->isim }}</a>
                @endforeach
            </div>
            @endif
            <div class="filter-item">
                <span class="title">İsim</span>
                <input type="text" name="ara" class="form-control" value="{{ Request::get('ara') }}">
            </div>
            @if ($markalar[0] > 0)
            <div class="filter-item">
                <span class="title">Marka</span>
                
                <?php $array = Request::has('marka') ? Request::get('marka') : [] ?>

                @foreach ($markalar[1] as $i => $marka)
                <div class="filter-line">
                    <input type="checkbox" value="{{ $marka->isim }}" id="marka-{{ $i }}" 
                    name="marka[]" @if (in_array($marka->isim, $array)) checked @endif>
                    <label for="marka-{{ $i }}">{{ $marka->isim }}</label>
                </div>
                @endforeach
            </div>
            @endif
            <div class="filter-item">
                <span class="title">Fiyat</span>
                
                <?php 
                
                $fiyatlar = [[0, 50], [50, 100], [100, 250], [250, 500], [500, null]];
                
                $array = Request::has('fiyat') ? Request::get('fiyat') : [];

                ?>

                @foreach ($fiyatlar as $i => $fiyat)
                <div class="filter-line">
                    <input type="checkbox" value="{{ implode('-', $fiyat) }}" id="fiyat-{{ $i }}" 
                    name="fiyat[]" @if (in_array(implode('-', $fiyat), $array)) checked @endif>
                    <label for="fiyat-{{ $i }}">
                        {{ $fiyat[0] }} TL @if ($fiyat[1]) - {{ $fiyat[1] }} TL @else ve üstü @endif
                    </label>
                </div>
                @endforeach
            </div>
            <div class="filter-item">
                <span class="title">Özellik</span>

                <?php 
                
                $array = Request::has('ozellik') ? Request::get('ozellik') : [];

                $ozellikler = ['yeni' => 'Yeni Gelen', 'vitrin' => 'Öne Çıkan', 'indir' => 'İndirimli'];
                
                ?>

                @foreach ($ozellikler as $i => $ozellik)
                <div class="filter-line">
                    <input type="checkbox" value="{{ $i }}" id="ozel-{{ $i }}" 
                    name="ozellik[]" @if (in_array($i, $array)) checked @endif>
                    <label for="ozel-{{ $i }}">{{ $ozellik }}</label>
                </div>
                @endforeach
            </div>
            <input type="hidden" name="sayfa" value="1">
            <input type="hidden" name="sira" value="{{ $sira }}">
            <div class="filter-item">
                <button class="btn" type="submit">Ara</button>
            </div>
        </form>
        <div class="col-xl-9 col-lg-9 col-md-8">
            @if (count($urunler) > 0)
            <div class="filter-top w-100 d-flex justify-content-between">
                <div class="ranking">
                    <select name="sirala">
                        <option value="stok desc">Akıllı Sıralama</option>
                        <option value="isim asc">A-Z'ye Göre</option>
                        <option value="isim desc">Z-A'ya Göre</option>
                        <option value="fiyat_s asc">Fiyat Artan</option>
                        <option value="fiyat_s desc">Fiyat Azalan</option>
                    </select>
                </div>
                @if ($toplam > $goster)
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        @if ($sayfa > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $sayfa - 1 }}"><i class="fas fa-backward"></i></a>
                        </li>
                        @endif

                        <?php 

                        $basla = $sayfa == 1 ? 1 : $sayfa - 1;

                        $bitir = ceil($toplam / $goster) - $sayfa >= 3  ? $sayfa + 1 : ceil($toplam / $goster);

                        ?>

                        @if ($sayfa >= 3)
                        <li class="page-item"><a class="page-link" href="1">1</a></li>
                        @if ($sayfa > 3)
                        <li class="page-item"><span class="page-link">...</span></li>
                        @endif
                        @endif
                        @for ($i = $basla; $i <= $bitir; $i++) 
                        <li class="page-item">
                            <a class="{{ $i == $sayfa ? 'current' : '' }} page-link" href="{{ $i }}">{{ $i }}</a>
                        </li>
                        @endfor
                        @if (ceil($toplam / $goster) - $sayfa >= 3)
                        <li class="page-item"><span class="page-link">...</span></li>
                        <li class="page-item">
                            <a href="{{ ceil($toplam / $goster) }}" class="page-link">{{ ceil($toplam / $goster) }}</a>
                        </li>
                        @endif
                        @if ($sayfa < ceil($toplam / $goster))
                        <li class="page-item">
                            <a class="page-link" href="{{ $sayfa + 1 }}"><i class="fas fa-forward"></i></a>
                        </li>
                        @endif
                    </ul>
                </nav>
                @endif
            </div>
            <div class="row list products">
                @foreach ($urunler as $urun)
                <div class="col-xl-3 col-lg-4 col-md-6 col-6 list-item">
                    <a href="/urun/{{ $urun->url }}">
                        <div class="product-container">

                            <?php 
                            
                            $profil = \App\Foto::where('profil', 1)
                                               ->where('urun_id', $urun->id)
                                               ->first();
                            
                            $profil = $profil ? $profil->deger : 'logo.png';

                            ?>

                            <img src="/img/{{ $profil }}" class="img-fluid" alt="{{ $urun->isim }}"
                            @if ($profil == 'logo.png') style="opacity: .5" @endif>
                            <h5>
                                {{ $urun->isim }}
                                <!-- @if ($urun->kod)
                                <small>{{ $urun->kod }}</small>
                                @endif -->
                            </h5>
                            <div class="prices text-center">
                                @if ($urun->indirim > 0)
                                <span class="old">{{ number_format($urun->fiyat, 2, ',', '.') }} TL</span>
                                <span class="product-price">{{ number_format($urun->indirim, 2, ',', '.') }} TL</span>
                                @else
                                <span class="old invisible">{{ number_format($urun->fiyat, 2, ',', '.') }} TL</span>
                                <span class="product-price">{{ number_format($urun->fiyat, 2, ',', '.') }} TL</span>
                                @endif
                            </div>
                            @if ($urun->indirim > 0)
                            <span class="winnings">Kazancınız %{{ intval($urun->oran) }}</span>
                            @else
                            <span class="winnings invisible">Kazancınız %{{ intval($urun->oran) }}</span>
                            @endif
                        </div>
                    </a>
                    <div class="hover">
                        @if ($urun->stok && !$urun->paket)
                        <a href="{{ $urun->id }}" class="add-basket">Sepete Ekle</a>
                        @endif
                        <a href="/urun/{{ $urun->url }}">İncele</a>
                    </div>
                </div>
                @endforeach
            </div>
            @if ($toplam > $goster)
            <div class="filter-top w-100 d-flex justify-content-end">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        @if ($sayfa > 1)
                        <li class="page-item">
                            <a class="page-link" href="{{ $sayfa - 1 }}"><i class="fas fa-backward"></i></a>
                        </li>
                        @endif

                        <?php 

                        $basla = $sayfa == 1 ? 1 : $sayfa - 1;

                        $bitir = ceil($toplam / $goster) - $sayfa >= 3  ? $sayfa + 1 : ceil($toplam / $goster);

                        ?>

                        @if ($sayfa >= 3)
                        <li class="page-item"><a class="page-link" href="1">1</a></li>
                        @if ($sayfa > 3)
                        <li class="page-item"><span class="page-link">...</span></li>
                        @endif
                        @endif
                        @for ($i = $basla; $i <= $bitir; $i++) 
                        <li class="page-item">
                            <a class="{{ $i == $sayfa ? 'current' : '' }} page-link" href="{{ $i }}">{{ $i }}</a>
                        </li>
                        @endfor
                        @if (ceil($toplam / $goster) - $sayfa >= 3)
                        <li class="page-item"><span class="page-link">...</span></li>
                        <li class="page-item">
                            <a href="{{ ceil($toplam / $goster) }}" class="page-link">{{ ceil($toplam / $goster) }}</a>
                        </li>
                        @endif
                        @if ($sayfa < ceil($toplam / $goster))
                        <li class="page-item">
                            <a class="page-link" href="{{ $sayfa + 1 }}"><i class="fas fa-forward"></i></a>
                        </li>
                        @endif
                    </ul>
                </nav>
            </div>
            @endif
            @else
            Ürün bulunamadı.
            @endif
        </div>
    </section>
</div>

@endsection

@section('custom')

<style>

    .filter-item a
    {
        display: block;
        color: #212529;
    }

    .filter-item .form-control
    {
        border-color: #212529;
        max-width: 175px;
        border-radius: 0;
    }

    .filter-item .form-control:focus
    {
        outline: unset;
        box-shadow: unset;
    }

    [name="search"]
    {
        font-size: 14px;
    }

    [name="search"] .btn
    {
        width: 175px;
        background: #009498;
        color: #fff;
        font-weight: 900;
        border: none;
        padding: .5rem 0;
        font-size: 18px;
    }

    .products-list .products
    {
        margin-right: -7.5px;
        margin-left: -7.5px;
    }

    .products-list .list .list-item
    {
        margin-bottom: 15px;
        padding-left: 7.5px;
        padding-right: 7.5px;
    }

    .products a
    {
        display: block;
        border: 1px solid #707070;
        border-radius: 10px;
        padding: .5rem;
        height: 100%;
    }

    .products a:hover
    {
        border-color: #009498;
        box-shadow: 0 0 5px rgba(0, 0, 0, .25);
    }

    .products img
    {
        margin-bottom: 0;
        width: 100%;
    }

    .prices
    {
        line-height: 1;
    }

    .prices .old
    {
        display: table;
        margin: 0 auto;
        text-align: center;
        color: #383838;
        margin-bottom: 5px;
        width: auto;
    }

    .prices .old::after 
    {
        display: none;
    }

    .prices .old::before 
    {
        width: 120%;
        display: block;
        height: 1px;
        background: #ff0000;
        content: '';
        position: absolute;
        left: -10%;
        top: 50%;
    }
    
    .products .winnings
    {
        display: none;
        background: #ff0000;
        color: #fff;
        font-size: 10pt;
        padding: 5px 10px;
        margin-top: 10px;
    }

    .products h5
    {
        margin-bottom: 0;
        padding: 0 .5rem;
        color: #000;
        transition: .125s;
    }

    .products-list .list .list-item
    {
        position: relative;
    }

    .products .list-item:hover .hover
    {
        opacity: 1;
    }

    .products .hover
    {
        position: absolute;
        top: 0;
        left: 7.5px;
        right: 7.5px;
        height: 100%;
        /* background: rgba(255, 255, 255, .75); */
        transition: .25s;
        opacity: 0;
        border: 1px solid #707070;
        border-radius: 10px;
        display: none;
    }

    .products .hover a
    {
        height: auto;
        display: inline-block;
        background: #009498;
        color: #fff;
        text-transform: uppercase;
        font-weight: bold;
        width: 80%;
        font-size: 10pt;
        transition: .25s;
        border: none;
    }

    .products .hover a:hover
    {
        background: #ff0000;
        box-shadow: none;
    }

    .products .hover a:first-child
    {
        margin-bottom: 7.5px;
    }

    .filter-top.justify-content-end
    {
        margin-top: 15px;
    }

    .pagination
    {
        margin-bottom: 0;
        height: 42px;
    }

    .pagination .page-item:last-child
    {
        margin-right: 0
    }

    .pagination .page-item .page-link
    {
        height: 42px;
        line-height: calc(42px - 1rem);
    }

    @media (max-width: 767px)
    {
        .products-list
        {
            padding-top: 0;
            padding-bottom: 30px;
        }

        .products-list h1
        {
            font-size: 30px;
            margin-top: 30px;
            margin-bottom: 30px;
            text-align: center;
        }

        .products-list .filter-top:first-child
        {
            display: none !important;
        }

        .products-list .filter-top:last-child
        {
            margin-bottom: 0
        }

        .products .hover
        {
            display: none;
        }
    }

</style>

<script>

    $(function()
    {
        $(".filter-button").click(function()
        {
            $(".filter-item").toggle(1000);
        });

        $('.pagination a').click(function(e)
        {
            e.preventDefault();

            $('[name="sayfa"]').val($(this).attr('href'));

            $('[name="search"]').trigger('submit');
        });

        $('select').val($('[name="sira"]').val());

        $('select').change(function(e)
        {
            e.preventDefault();

            $('[name="sira"]').val($(this).val());

            $('[name="search"]').trigger('submit');
        });

        $('[name="search"] button').click(function()
        {
            $('[name="search"]').find('input').each(function()
            {
                if ($(this).val() == undefined || $.trim($(this).val()) == '')

                    $(this).attr('disabled', true);
            });
        });

        $('.filter-button').click(function(e)
        {
            e.preventDefault();
        });

        setTimeout(function()
        {

            $('.products .hover').each(function()
            {
                var height = $(this).find('a').outerHeight() * $(this).find('a').length + 15;
                    padding = ($(this).height() / 2) - (height / 2);

                $(this).css('padding-top', padding);
            });

        }, 250);

        $('.add-basket').click(function(e)
        {
            e.preventDefault();

            var form_data = new FormData();
                _this = $(this);

            form_data.append('id', $(this).attr('href'));
            form_data.append('_token', '{{ csrf_token() }}');
            form_data.append('yap', 'ekle');
            
            $.ajax(
            {
                url: '/sepet',
                type: 'post',
                data: form_data,
                processData: false,
                contentType: false,
                beforeSend: function()
                {
                    _this.html('<i class="fa fa-spinner fa-pulse fa-fw"></i>');

                    _this.attr('disabled', 'disabled');
                },
                success: function(resp)
                {
                    $('.sepet-adet').html(resp);
                    
                    var isim = _this.closest('.col-xl-3').find('h5').text();

                    $('#sepet-sonuc .modal-body span').text(isim);
                    
                    $('#sepet-sonuc').modal('show');

                    setTimeout(function()
                    {
                        _this.html('Sepete Ekle').removeAttr('disabled');

                    }, 1000);
                }
            });
        });

        setTimeout(function()
        {
            $('.products-list .list .list-item').each(function()
            {
                if ($(this).find('a').eq(0).height() != $(this).find('.product-container').outerHeight())
                {
                    var height = $(this).find('a').eq(0).height() - $(this).find('.product-container').outerHeight();

                    $(this).find('h5').css('margin-bottom', height);
                }
            });

        }, 250);
    });

</script>

@endsection