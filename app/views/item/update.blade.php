@extends('layouts.master')

@section('main-content')
<section class='content-header'>
Ubah Barang
</section>
<section class='content'>
	<form action='<?=URL::action("ItemController@postUpdate",['id'=>$item->id]);?>' method='POST' enctype='multipart/form-data'>
		@include('item._form',['item'=>$item,'errors'=>$errors,'item_categories'=>$item_categories])
		<div class='form-group'>
		    <input type='submit' class='btn btn-primary' value='Ubah'/>
		</div>
	</form>
</section>
@stop

