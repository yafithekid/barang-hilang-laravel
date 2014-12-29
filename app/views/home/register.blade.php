@extends('layouts.master')
@section('main-content')
<div class='box box-success'>

    <div class="box-header">
        <h3 class="box-title">Form Pendaftaran</h3>
    </div>
    
    <form action='<?=URL::action("HomeController@postRegister");?>' method='POST'>
    <div class='box-body'>
        
        
        <?= Form::token(); ?>
        <div class='form-group @if($errors->has("username")) has-error @endif'>
            <label for='username'>Username</label>
            <input type="text" name='username' value='<?=Input::old('username');?>' class='form-control'/>
            <?= $errors->first('username'); ?>
        </div>

        <div class='form-group @if($errors->has("password")) has-error @endif'>
            <label for='password'>Password</label>
            <input type='password' name='password' value='' class='form-control'/>
            <?= $errors->first('password'); ?>
        </div>

        <div class='form-group @if($errors->has("repeat_password")) has-error @endif'>
            <label for='repeat_password'>Ulangi Password</label>
            <input type='password' name='repeat_password' value='' class='form-control'/>
            <?= $errors->first('repeat_password'); ?>
        </div>
        
        <div class='form-group @if($errors->has("fullname")) has-error @endif'>
            <label for='fullname'>Nama Lengkap</label>
            <input type='text' name='fullname' value='<?=Input::old('fullname');?>' class='form-control'>
            <?= $errors->first('fullname'); ?>
        </div>

        <div class='form-group @if($errors->has("email")) has-error @endif'>
            <label for='email'>Email</label>
            <input type='text' name='email' value='<?=Input::old('email');?>' class='form-control'>
            <?= $errors->first('email'); ?>
        </div>
        
    </div>

    <div class='box-footer'>
        <input type='submit' class='btn btn-primary' value='Daftar'/>
    </div>
    </form>

</div>
@stop