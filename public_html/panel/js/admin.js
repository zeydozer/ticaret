$(function()
{
    $('form [type="submit"]').click(function()
    {
        $('[name="yap"]').val($(this).attr('value'));
        $(this).attr('clicked', 1);
    });

    function ajax_form(form, route)
    {
        $(form).submit(function(e)
        {
            e.preventDefault();
         
            $.ajax(
            {
                type: "post",
                url: route,
                data: new FormData(this),
                processData: false,
                contentType: false,
                beforeSend: function() 
                {
                    $('[clicked="1"]').html('<i class="fa fa-spinner fa-pulse fa-fw"></i>').attr("disabled", "disabled");
                    $(form +" *").attr("disabled", "disabled");
                },
                success: function(cevap) 
                {
                    $(".form-sonuc").html('<script>'+ cevap +'</script>');
                },
                complete: function() 
                {
                    $('[clicked="1"]').html($('[clicked="1"]').attr("value")).removeAttr("disabled").removeAttr('clicked');
                    $(form +" *").removeAttr("disabled");
                }
            });
        });
    }

    ajax_form('#ajax-form', location.pathname);
    
    $(".aciklama").each(function(i)
    {
        CKEDITOR.replace($(this).attr("name"), 
        {
            'extraPlugins': 'colorbutton',
            'toolbar': 'Full',
        });

        CKEDITOR.instances[$(this).attr("name")].on('change', function(e) 
        { 
            $('[name='+ $(this).attr("name") +']').html(e.editor.getData());
        });
    });

    $("#sortable").sortable(
    {
        stop: function(event, ui) 
        {
            datas = {}, paths = location.pathname.split('/');
            
            tip = paths[2], item = paths[3];
            
            if (tip == 'ayar') tip = item;

            $('#sortable li').each(function(i, li) 
            { 
                datas[$(this).attr('id')] = i + 1;
                $('.ui-icon').eq(i).html(i + 1 +') ');
            });

            if (item != undefined)

                $('[name="sira"]').val(datas[item]);

            $.ajax(
            {
                type: 'get',
                url: '/sira/'+ tip,
                data: datas
            });
        },

        containment: '.sira-container'
    });

    $('.select2').select2();

    $(".galeri").sortable(
    {
        stop: function(event, ui) 
        {
            datas = {};
            
            $('.galeri .col-md-3').each(function(i, li) 
            { 
                datas[$(this).attr('id')] = i + 1;
            });

            $.ajax(
            {
                type: 'get',
                url: '/sira/foto',
                data: datas
            });
        },

        containment: '.galeri-container'
    });

    $('input[name="profil-sec"]').click(function()
    {
        var $radio = $(this);
        
        if ($radio.data('waschecked') == true)
        {
            $radio.prop('checked', false);
            $radio.data('waschecked', false);
        }

        else $radio.data('waschecked', true);
        
        $radio.siblings('input[name="profil-sec"]').data('waschecked', false);
    });

    $('th[sort]').click(function()
    {
        var sira = $('[name=sira]').val().indexOf('asc') != -1 ? 'desc' : 'asc';

        $('[name=sira]').val($(this).attr('sort') +' '+ sira);

        $('#arama').trigger('submit');
    });

    function sayfa(git)
    {
        $('[name=sayfa]').val(git);

        $('#arama').trigger('submit');
    }

    $('[git]').click(function() { sayfa($(this).attr('git')); });

    $('.sayfa').change(function() { sayfa($(this).val()); });
});