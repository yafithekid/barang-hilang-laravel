@extends('item._form')

@section('main-content')
	    <div class='box box-success'>
	    
	        <div class="box-header">
	            <h3 class="box-title">Form Barang</h3>
	        </div>

	        <form action='<?=URL::action("ItemController@postCreate");?>' method='POST'>
	        <div class='box-body'> 
	        	@parent
	        </div>

	        <div class='box-footer'>
	            <input type='submit' class='btn btn-primary' value='Tambah'/>
	        </div>
        	</form>
        </div>
@stop

