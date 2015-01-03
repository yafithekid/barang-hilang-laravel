
        <?= Form::token(); ?>

        <div class='form-group @if($errors->has("username")) has-error @endif'>
            <label for='username'>Username</label>
            <input type="text" name='username' value='{{$user->username}}' class='form-control' disabled/>
            <?= $errors->first('username'); ?>
        </div>

        <div class='form-group @if($errors->has("password")) has-error @endif'>
            <label for='password'>Password</label>
            <input type='password' name='password' value='{{$user->password}}' class='form-control'/>
            <?= $errors->first('password'); ?>
        </div>

        <div class='form-group @if($errors->has("repeat_password")) has-error @endif'>
            <label for='repeat_password'>Ulangi Password</label>
            <input type='password' name='repeat_password' value='{{$user->repeat_password}}' class='form-control'/>
            <?= $errors->first('repeat_password'); ?>
        </div>
        
        <div class='form-group @if($errors->has("fullname")) has-error @endif'>
            <label for='fullname'>Nama Lengkap</label>
            <input type='text' name='fullname' value='{{$user->fullname}}' class='form-control'>
            <?= $errors->first('fullname'); ?>
        </div>

        <div class='form-group @if($errors->has("email")) has-error @endif'>
            <label for='email'>Email</label>
            <input type='text' name='email' value='{{$user->email}}' class='form-control'>
            <?= $errors->first('email'); ?>
        </div>

        <div class='form-group @if($errors->has("image")) has-error @endif'>
            <label for='image'>Gambar</label>
            <input type='file' name='image' class='form-control'>
            <?= $errors->first('image'); ?>
        </div>