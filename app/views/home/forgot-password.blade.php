@extends('layouts.plain')
@section('main-content')
	<section class='content-header'>
		<center>Lupa password</center>
	</section>
	<section class='content'>
		<div class='col-xs-4 col-xs-offset-4'>
			<form action='{{URL::action('HomeController@postForgotPassword')}}' method='POST'>
			<center>
				<div class='form-group'>
					<label for='field'>Masukkan username atau email</label>
					<input name='field' type='text' class='form-control' />
				</div>
				<div class='form-group'>
					<input type='submit' class='btn btn-primary' value='Reset password' />
				</div>
			</form>
			</center>
		</div>
	</section>
@stop
