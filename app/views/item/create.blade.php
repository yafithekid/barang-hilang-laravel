@extends('layouts.master')

@section('main-content')
<section class='content-header'>
Tambah Barang
</section>
<section class='content'>
	<form action='<?=URL::action("ItemController@postCreate");?>' method='POST' enctype='multipart/form-data'>
		@include('item._form',['item'=>$item,'errors'=>$errors,'item_categories'=>$item_categories])
		<div class='form-group'>
		    <input type='submit' class='btn btn-primary' value='Tambah'/>
		</div>
	</form>
</section>
@stop

