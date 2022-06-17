@extends('admin.index')

@section('header', 'Ayarlar')
@section('optional', 'İletişim')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">
                    @foreach ($iletisim as $name => $value)
                    <div class="form-group">
                        <label>{{ ucfirst($name) }}</label>
                        @if ($name != 'adres')
                        <input type="text" name="{{ $name }}" class="form-control" value="{{ $value }}" required>
                        @else
                        <textarea name="{{ $name }}" class="form-control" required 
                        rows="3" style="resize: none"><?php echo $value ?></textarea>
                        @endif
                    </div>
                    @endforeach
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

@section('script')
<!-- Google Maps -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyw0CFUi4wM_RXPL0kSV9-rmHrJBqm4vo&callback=initMap&libraries=places&language=tr"></script>
@endsection