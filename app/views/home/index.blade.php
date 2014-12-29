@extends('layouts.master')
@section('main-content')
<section class='content-header'>
	<h1>Barang Temuan</h1>
</section>
	
<section class='content'>
	<div class='col-xs-4'>
		@include('item.widgets.box');
    </div>
</section>
<div style='clear:both'></div>
<section class='content-header'>
	<h1>Barang Hilang</h1>
</section>
<section class='content'>
	<p>Hei gw dapet barang</p>
</section>
@stop
