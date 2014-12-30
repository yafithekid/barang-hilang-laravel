@extends('item._form')

@section('main-content')
<section class='content-header'>
Form Barang
</section>
<section class='content'>
	<form action='<?=URL::action("ItemController@postCreate");?>' method='POST' enctype='multipart/form-data'>
		@parent
		<div class='form-group'>
		    <input type='submit' class='btn btn-primary' value='Tambah'/>
		</div>
	</form>
</section>
@stop

