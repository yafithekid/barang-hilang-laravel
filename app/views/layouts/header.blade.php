<div class='container'>
    <div class='col-xs-12'>
        <div class='col-xs-3' style='padding-top: 8px; padding-bottom: 8px;'>
            <a href='<?=URL::action('ItemController@anyIndex');?>' style="font-family: 'Kaushan Script', cursive; font-size: 20px; color:white;">
                <?= HTML::image('img/logo.png','logo',['height'=>48]); ?>
                Barang Hilang</a>
        </div>
        <div class='col-xs-7'>
            <div class='col-xs-12' >
                <form action='<?=URL::action('ItemController@anySearch');?>' method='GET' role="search" >                             
                <div class='col-xs-10' style='padding-right:0px;'>
                    <div class="form-group" style='margin: 5px; 0px;' >
                        <input type="text" class="form-control" name='q' value='<?=Input::old('q');?>' placeholder="Cari barang anda di sini...">
                    </div>
                    <center>
                        <a href='{{URL::action('ItemController@anyAdvancedSearch');}}' method='GET' role="search" style='color:white;'>Pencarian lanjut</a>   
                    </center>
                </div>
                <div class='col-xs-2' style='padding-left:0px;' >
                    <button type="submit" class="btn btn-default" style='margin: 5px; 0px;'><i class='fa fa-search'></i></button>
                </div>
                </form>
                
            </div>
        </div>
        <div class='col-xs-2' style='padding-top: 8px; padding-bottom: 8px;'>
            <a href='<?=URL::action('ItemController@getCreate');?>' class='btn btn-warning' style='margin: 5px; 0px;'>
                <i class='fa fa-bullhorn'></i> Lapor Barang
            </a>
        </div>

    </div>
</div>