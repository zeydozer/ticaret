@extends('admin.index')

@section('header', 'Ayarlar')
@section('optional', 'Pos')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
            <form id="ajax-form">
                <div class="box-body">

                    <?php $temps = json_decode(\App\Ayar::find(14)->data, true) ?>

                    @foreach ($pos as $name => $value)
                    <div class="form-group">
                        <label>{{ ucwords(str_replace('_', ' ', $name)) }}</label>
                        @if ($name == 'banka')
                        <select class="form-control" name="banka" required>
                            @foreach ($temps as $bank => $url)

                            <?php $selected = $value == $bank ? 'selected' : null ?>

                            <option value="{{ $bank }}" {{ $selected }}>{{ ucwords(str_replace('_', ' ', $bank)) }}</option>
                            @endforeach
                        </select>
                        @else
                        <input type="text" name="{{ $name }}" class="form-control" value="{{ $value }}">
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