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