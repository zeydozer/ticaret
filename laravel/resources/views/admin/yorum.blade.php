@extends('admin.index')

@section('header', 'Yorumlar')

@section('content')
<!-- Main content -->
<section class="content container-fluid">

    <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Toplam: {{ $toplam }}</h3>
              <div class="box-tools" style="display: none">
                <form class="input-group input-group-sm" style="width: 130px;" method="get" 
                action="/admin/yorum" id="arama">
                  <input type="hidden" name="sira" value="{{ implode(' ', $sira) }}">
                  <input type="hidden" name="sayfa" value="1">
                </form>
              </div>
            </div>
            <div class="box-body no-padding table-responsive">
              <table class="table">
                <tr>
                  <th>#</th>
                  <th sort="tarih">Tarih</th>
                  <th sort="isim_u">Ürün</th>
                  <th sort="isim">İsim</th>
                  <th sort="yorum">Yorum</th>
                  <th sort="puan">Puan</th>
                  <th></th>
                  <th></th>
                </tr>
                @foreach ($yorumlar as $i => $yorum)
                <tr data="{{ $yorum->id }}">
                  <td><b>{{ $limit + $i + 1 }})</b></td>
                  <td>{{ date('d.m.Y H:i', strtotime($yorum->tarih)) }}</td>
                  <td><a href="/admin/urun/{{ $yorum->id_u }}">{{ $yorum->isim_u }}</a></td>
                  <td>{{ $yorum->isim }}</td>
                  <td>{{ $yorum->yorum }}</td>
                  <td>{{ $yorum->puan }}</td>
                  <td>
                    <a href="islem" data="onay">
                      <i class="fa fa-{{ $yorum->onay ? 'check' : 'ban' }}"></i>
                    </a>
                  </td>
                  <td>
                    <a href="islem" data="sil">
                      <i class="fa fa-trash"></i>
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

@section('script')

<script type="text/javascript">
    
    $('[href="islem"]').click(function(e)
    {
        e.preventDefault();

        var id = $(this).closest('tr').attr('data'), islem = $(this).attr('data');

            datas = {id: id, _token: $('[name="csrf-token"]').attr('content'), konu: islem};

            _this = $(this); _class = $(this).find('i').attr('class');

        if (islem == 'sil')
        {
            if (confirm('Emin misiniz?'))
            {
                $(this).find('i').attr('class', 'fa fa-pulse fa-spinner fa-fw');

                $.post(location.pathname, datas, function(resp)
                {
                    if (resp == 1) location.reload();

                    else _this.find('i').attr('class', _class);
                });
            }
        }

        else
        {
            $(this).find('i').attr('class', 'fa fa-pulse fa-spinner fa-fw');
            
            $.post(location.pathname, datas, function(resp)
            {
                if (resp == 1) location.reload();

                else _this.find('i').attr('class', _class);
            });
        }
    });

</script>

@endsection