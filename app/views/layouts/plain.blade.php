<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Barang Hilang</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <?= HTML::style('css/bootstrap/bootstrap.min.css'); ?>
        <?= HTML::style('css/adminLTE/AdminLTE.css'); ?>
        <?= HTML::style('css/main.css');?>
        <?= HTML::style('css/font-awesome/css/font-awesome.min.css'); ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class='skin-blue'>
        <header class='header'>
            <div class='container'>
                <div class='col-xs-12'>
                    <div class='col-xs-3'>
                        <a href='<?=URL::action('ItemController@anyIndex');?>' style="font-family: 'Kaushan Script', cursive; font-size: 20px; color:white;">
                            <?= HTML::image('img/logo.png','logo',['height'=>48]); ?>
                            Barang Hilang</a>
                    </div>
                    <div class='col-xs-8'>
                        <div class='col-xs-12' >
                            <form action='<?=URL::action('ItemController@anySearch');?>' method='GET' role="search" >                             
                            <div class='col-xs-9' style='padding-right:0px;'>
                                <div class="form-group" style='margin: 5px; 0px;' >
                                    <input type="text" class="form-control" name='q' value='<?=Input::old('q');?>' placeholder="Cari barang anda di sini...">
                                </div>
                            </div>
                            <div class='col-xs-3' style='padding-left:0px;' >
                                <button type="submit" class="btn btn-default" style='margin: 5px; 0px;'><i class='fa fa-search'></i></button>
                            </div>
                            </form>
                        </div>    
                    </div>
                    <div class='col-xs-2'>
                        <a href='<?=URL::action('ItemController@getCreate');?>' class='btn btn-warning' style='margin: 5px; 0px;'>
                            <i class='fa fa-bullhorn'></i> Lapor Barang
                        </a>
                    </div>

                </div>
            </div>
            
            
        </header>
        <div class='container' style='min-height:100%; padding-top:30px;'>
            <div>
            	@if (Session::has('global-success'))
                    <div class='alert alert-success'>
                        <?= Session::get('global-success'); ?>
                    </div>
                @endif
                @if (Session::has('global-warning'))
                    <div class='alert alert-warning'>
                        <?= Session::get('global-warning'); ?>
                    </div>
                @endif
                @if (Session::has('global-error'))
                    <div class='alert alert-danger'>
                        <?= Session::get('global-error'); ?>
                    </div>
                @endif
            </div>
            <div class='col-xs-12 right-side'>
            	
            	@yield('main-content')
                @section('script')
                     <?= Html::script('js/jquery/jquery.min.js'); ?>
                @show
            </div>
        </div>
    </body>

    

</html>
