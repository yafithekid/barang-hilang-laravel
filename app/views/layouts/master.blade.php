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
                    <div class='col-xs-2'>
                        <a href='<?=URL::action('HomeController@getHome');?>'>
                            <?= HTML::image('img/logo.png','logo',['height'=>46,'style'=>'padding: 4px;']); ?>
                            Barang Hilang</a>
                    </div>
                    <div class='col-xs-8'>
                        <div class='col-xs-12' >
                            <form action='<?=URL::action('ItemController@getIndex');?>' method='GET' role="search" >                             
                            <div class='col-xs-9' style='padding-right:0px;'>
                                <div class="form-group" style='margin: 5px; 0px;' >
                                    <input type="text" class="form-control" placeholder="Cari barang anda di sini...">
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
            <div class='col-xs-12'>
                <div class='col-xs-3' style='background: #F4F4F4; min-height:1000px;'>
                    @section('sidebar')
                    <section class='sidebar'>
                    @if(!Auth::check())
                        <form action='<?=URL::action('HomeController@postLogin');?>' method='POST'>
                            <span style='color:#f56954;'><?=Session::get('login_error','');?></span> 
                            <div class='form-group'>
                                <label for='username'>Username</label>
                                <input type='text' name='username' value='<?=Input::old('username');?>' class='form-control'/>
                            </div>
                            <div class='form-group'>
                                <label for='password'>Password</label>
                                <input type='password' name='password' value='<?=Input::old('password');?>' class='form-control'/>
                            </div>
                            <div class='form-group'>
                                <center><input type='submit' value='login' class='btn btn-warning' /></center>
                            </div>
                            Belum punya akun? <a href='<?=URL::action('HomeController@getRegister');?>'>Daftar di sini</a>
                        </form>
                    @else
                        <center>
                            <h4><?= Auth::user()->fullname;?></h4>
                            <a href='<?=URL::action('HomeController@getLogout');?>' class='btn btn-warning'>Logout</a>
                        </center>

                    @endif
                    <br>
                        <h4>Barang per kategori</h4>
                        <ul class='sidebar-menu'>
                            @foreach(Category::all() as $item)
                                <li><a href='<?=URL::action('ItemController@getSearch',['category'=>$item->id]);?>'><?=$item->name;?></a></li>
                            @endforeach
                        </ul>
                    @show
                    </section>
                </div>

                <div class='col-xs-9 right-side' style='background: #f9f9f9; margin-left:0px;'>
                    @if (Session::has('global-success'))
                        <div class='alert alert-success'>
                            <?= Session::get('global-success'); ?>
                        </div>
                    @endif
                    @yield('main-content')
                </div>

                @section('script')
                     <?= Html::script('js/jquery/jquery.min.js'); ?>
                @show
            </div>
        </div>
    </body>

    

</html>
