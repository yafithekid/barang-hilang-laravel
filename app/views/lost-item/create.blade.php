@extends('lost-item._form')

@section('content')
	    <div class='box box-success'>
	    
	        <div class="box-header">
	            <h3 class="box-title">Form Kehilangan</h3>
	        </div>

	        <form action='<?=URL::action("LostItemController@postCreate");?>' method='POST'>
	        <div class='box-body'>  
	        	@parent
	        </div>

	        <div class='box-footer'>
	            <input type='submit' class='btn btn-primary' value='Tambah'/>
	        </div>
        	</form>
        </div>
@stop

