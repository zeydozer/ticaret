@extends('admin.index')

@section('header', 'Kategori')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="@if ($gelen->id) col-md-9 @else col-md-12 @endif">
                                <select name="id" id="id" class="form-control select2" 
                                onchange='location.href = "/admin/kategori/"+ value'>
                                    <option value="" selected>+ Yeni</option>
                                    @if (count($kategoriler) > 0)
                                    @foreach ($kategoriler as $kat_id => $kategori)
                                    
                                    <?php $select = $gelen->id == $kat_id ? 'selected' : ''; ?>
                                    
                                    <option value="{{ $kat_id }}" {{ $select }}>{{ $kategori }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            @if ($gelen->id)
                            <div class="col-md-3">
                                <a href="/admin/urun?kat_id={{ $gelen->id }}" class="btn btn-primary btn-block">
                                    Ürünler &nbsp;&nbsp; <i class="fa fa-arrow-right"></i>
                                </a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @if (count($kategoriler) > 0)
                    <div class="form-group">
                        <label for="bagli-id">Bağlı Olduğu Kategori</label>
                        <select name="bagli_id" id="bagli-id" class="form-control select2">
                            <option value="" selected>- Yok</option>
                            @foreach ($kategoriler as $kat_id => $kategori)

                            <?php 
                            
                            if ($gelen->id == $kat_id) continue; 
                            
                            $select = $gelen->bagli_id == $kat_id ? 'selected' : ''; 
                            
                            ?>
                            
                            <option value="{{ $kat_id }}" {{ $select }}>{{ $kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif
                    <div class="form-group">
                        <label for="isim">İsim</label>
                        <input type="text" required name="isim" id="isim" class="form-control" value="{{ $gelen->isim }}">
                    </div>
                    <div class="form-group">
                        <label for="sira">Sıra</label>
                        <input type="number" required name="sira" id="sira" class="form-control" value="{{ $gelen->sira }}">
                    </div>
                    @if ($gelen->foto)
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/img/{{ $gelen->foto }}" data-fancybox>
                                <img src="/img/{{ $gelen->foto }}" height="150">
                            </a>
                        </div>
                    </div>
                    <hr>
                    @endif
                    <div class="form-group">
                        <label for="foto">Fotoğraf</label>
                        <input type="file" name="foto" id="foto" class="form-control" @if (!$gelen->id) required @endif>
                    </div>
                    <div class="form-group">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="ana" @if ($gelen->ana) checked @endif>
                                Anasayfa
                            </label>
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
    @if (DB::table('kategori')->where('bagli_id', $gelen->bagli_id)->count() > 0)
    <div class="col-md-4">
		<div class="box box-solid sira-container">
			<div class="box-header with-border">
				<h4 class="box-title">Sıralama</h4>
			</div>
			<div class="box-body">
				<ul id="sortable" style="list-style: none; padding-left: 0">
				  @foreach (DB::table('kategori')->where('bagli_id', $gelen->bagli_id)->orderBy('sira')->get() as $i => $kategori)
				  <li class="ui-state-default external-event bg-light-blue" id="{{ $kategori->id }}">
				  	<span class="ui-icon ui-icon-arrowthick-2-n-s" style="color: orange">{{ $i + 1 }}) </span>{{ $kategori->isim }}
				  </li>
				  @endforeach
				</ul>
			</div>
			<!-- /.box-body -->
		</div>
		<!-- /. box -->
	</div>
    @endif
</div>

</section>
<!-- /.content -->

<style>

    img
    {
        width: 100%;
        object-fit: contain;
        object-position: left;
    }

</style>
@endsection