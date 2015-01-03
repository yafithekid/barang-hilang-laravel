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
            
            
        </header>
        <div class='container' style='min-height:100%; padding-top:30px;'>
            <div class='col-xs-12'>
                
                    @section('sidebar')
                    <div class='col-xs-3' style='padding: 0px; background: #F4F4F4; min-height:1000px;'>
                    <section class='sidebar' style='padding:10px'>
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
                            Belum punya akun? <a href='<?=URL::action('HomeController@getRegister');?>' style='color:#3c8dbc;'>Daftar di sini</a>
                        </form>
                    @else
                        <center>
                            <h4><?= Auth::user()->fullname;?></h4>
                            <img src='{{Auth::user()->getImageUrl()}}' class='img-circle' width='100px' height="100px" /><br><br>
                            <a href='<?=URL::action('HomeController@getLogout');?>' class='btn btn-warning' style='color:white'>Logout</a><br><br>
                            <a href='{{URL::action('ItemController@anyMine')}}' style='color:#3c8dbc' >Lihat barang saya</a>
                        </center>

                    @endif
                    <br>
                        <h4>Barang per kategori</h4>
                        <ul class='sidebar-menu'>
                            @foreach(Category::all() as $category)
                                <li><a href='<?=URL::action('ItemController@anyCategory',['id'=>$category->id,'name'=>$category->name]);?>'><?=$category->name;?></a></li>
                            @endforeach
                        </ul>
                    
                    </section>
                    @show
                </div>

                <div class='col-xs-9' style='margin-left:0px;'>
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

                    <div class='right-side' style="background: #f9f9f9; ">
                        
                        @yield('main-content')
                    </div>
                </div>

                @section('script')
                     <?= Html::script('js/jquery/jquery.min.js'); ?>
                @show
            </div>
        </div>
    </body>

    

</html>
