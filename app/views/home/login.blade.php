@extends('layouts.plain')
@section('main-content')
	<section class='content-header'>
		<center>Login</center>
	</section>
	<section class='content'>
		<div class='col-xs-4 col-xs-offset-4'>
			@include('home._form-login')
		</div>
	</section>
@stop
