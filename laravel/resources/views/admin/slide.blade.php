@extends('admin.index')

@section('header', 'Ayarlar')
@section('optional', 'Slider')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    <div class="form-group">
                        <select name="id" id="id" class="form-control" 
                        onchange='location.href = "/admin/ayar/slide/"+ value'>
                            <option value="" selected>+ Yeni</option>
                            @if (count($slides) > 0)
                            @foreach ($slides as $slide)
                            @php $select = $gelen->id == $slide->id ? 'selected' : ''; @endphp
                            <option value="{{ $slide->id }}" {{ $select }}>{{ $slide->id }} (Sıra: {{ $slide->sira }})</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    @if ($gelen->foto)
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="/img/{{ $gelen->foto }}" data-fancybox>
                                <img src="/img/{{ $gelen->foto }}" height="300">
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
                        <label for="link">Link</label>
                        <input type="text" name="link" id="link" class="form-control" value="{{ $gelen->link }}">
                    </div>
                    <div class="form-group">
                        <label for="sira">Sıra</label>
                        <input type="number" required name="sira" id="sira" class="form-control" value="{{ $gelen->sira }}">
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
    @if (DB::table('slide')->count() > 0)
    <div class="col-md-4">
		<div class="box box-solid sira-container">
			<div class="box-header with-border">
				<h4 class="box-title">Sıralama</h4>
			</div>
			<div class="box-body">
				<ul id="sortable" style="list-style: none; padding-left: 0">
				  @foreach (DB::table('slide')->orderBy('sira')->get() as $i => $slide)
				  <li class="ui-state-default external-event bg-light-blue" id="{{ $slide->id }}">
				  	<span class="ui-icon ui-icon-arrowthick-2-n-s" style="color: orange">{{ $i + 1 }}) </span>
                    {{ $slide->id }} (Sıra: {{ $slide->sira }})
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