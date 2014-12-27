@extends('layouts.master')

<?php if (!Auth::check()): ?>
Login
<?= Form::open(['action' => 'HomeController@postLogin']); ?>


<?= Session::has('login_error')?Session::get('login_error'):'';?>

<?= Form::label('username','Username'); ?>
<?= Form::text('username',Input::old('username'),[]); ?>

<?= Form::label('password','Password'); ?>
<?= Form::password('password',[]); ?>

<?= Form::checkbox('remember_me'); ?> Ingat saya

<?= Form::submit('Login'); ?>
<?= Form::close(); ?>
<?php else: ?>
<?= HTML::link(URL::action('HomeController@getLogout'),'Logout'); ?>
<?php endif; ?>