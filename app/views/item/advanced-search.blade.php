@extends('layouts.master')
@section('main-content')
<section class='content-header'>
	Pencarian lanjut
</section>
<section class='content'>
<form action='{{URL::action('ItemController@anyAdvancedSearch')}}' method='get'>
	<div class='form-group'>
		<label for='type'>Tipe</label>
		<select name='type' class='form-control'>
			<option label='Barang hilang' @if (Input::get('type') == Item::LOST) selected @endif>{{Item::LOST}}</option>
			<option label='Barang temuan' @if (Input::get('type') == Item::FOUND) selected @endif>{{Item::FOUND}}</option>
		</select>
	</div>
	<div class='form-group'>
		<input name='use-name' type='checkbox' value='1' id='use-name' @if(Input::get('use-name')) checked @endif>
		<label for='name'>Nama barang</label>
		<input type='text' name='name' class='form-control' value='{{Input::get('name')}}' id='name' disabled/>
	</div>

	<div class='form-group'>
		<input type='checkbox' name='use-category_id' value='1' id='use-category_id' @if(Input::get('use-category_id')) checked @endif>
		<label for='category_id'>Kategori</label>
		<select name='category_id' class='form-control' id='category_id' disabled>
			@foreach($categories as $category)
				<option label='{{$category->name}}' @if(Input::get('category_id') == $category->id) selected @endif>{{$category->id}}</option>
			@endforeach
		</select>
	</div>

	<div class='form-group'>
		<input type='checkbox' name='use-character' id='use-character' @if (Input::get('use-character')) checked @endif>
		<label for='character'>Karakter Barang. Pisahkan kata dengan spasi (misal: <i>hitam B1234UH</i>)</label>
		<input name='character' id='character' class='form-control' value='{{Input::get('character')}}' type='text'/>
	</div>


	<div class='form-group'>
		<input type='checkbox' name='use-position' id='use-position' @if(Input::get('use-position')) checked @endif >
		<label for='position'>Posisi Barang</label>
		<input type='hidden' name='lat' id='lat' value='{{Input::get('lat',Item::DEFAULT_LAT)}}' disabled/>
		<input type='hidden' name="lng" id='lng' value="{{Input::get('lng',Item::DEFAULT_LNG)}}" disabled/>
		<input type='hidden' name='rad' id='rad' value='{{Input::get('rad',Item::DEFAULT_RAD)}}' disabled/>
		<div id='map-canvas' style='height:500px;'></div>
	</div>

	
	<div class='form-group'>
		<input type='submit' value='Cari' class='btn btn-primary'/>
	</div>
</form>
@if (isset($items))
@foreach($items as $item)
	<div class='col-xs-4'>
		@include('item.widgets.box',['item'=>$item])
	</div>
@endforeach
@endif
</section>
@stop


@section('script')
@parent
<script src='https://maps.googleapis.com/maps/api/js?v=3&sensor=true&key=AIzaSyC3h2wqa3ND0xEO6RiJJgirIgoX-w3Ckd0'></script>
<script type="text/javascript">
  var lat = <?=Input::old('lat',Item::DEFAULT_LAT);?>;
  var lng = <?=Input::old('lng',Item::DEFAULT_LNG);?>;
  var mapOptions = {
          center: new google.maps.LatLng(lat,lng),
          zoom: 15
     };
  var map = new google.maps.Map(
      document.getElementById("map-canvas"),
      mapOptions
  );
  var marker = new google.maps.Marker({
      draggable: true,
      title: 'Start',
      map: map,
  });
  var circle = new google.maps.Circle({
      map: map,
      radius: {{Input::old('rad',Item::DEFAULT_RAD * 3000)}},
      editable: true,
    });
  circle.bindTo('center', marker, 'position');
  $(document).ready(function(){initialize();});
  function initialize(){
      marker.setPosition(new google.maps.LatLng(lat,lng));
      google.maps.event.addListener(marker,'drag',function(e){
          //change 
          $("#lat").val(marker.getPosition().lat());
          $("#lng").val(marker.getPosition().lng());
      });
      google.maps.event.addListener(circle,'radius_changed',function(e){
      	$("#rad").val(circle.getRadius());
      });
      checkUsePosition();
      checkUseName();
      checkUseCategoryId();
      checkUseCharacter();
  }
  function checkUsePosition(){
	  	var val = $("#use-position").prop('checked');
	  	//console.log(val);
	  	if (val){
	  		$("#lat").attr('disabled',false);
	  		$("#lng").attr('disabled',false);
	  		$("#rad").attr('disabled',false);
	  		marker.setVisible(true);
	  		circle.setVisible(true);
	  	} else {
	  		$("#lat").attr('disabled',true);
	  		$("#lng").attr('disabled',true);
	  		$("#rad").attr('disabled',true);
	  		marker.setVisible(false);
	  		circle.setVisible(false);
	  	}	
  }
  function checkUseName(){
  	var val = $("#use-name").prop('checked');
  		if (val){
  			$("#name").attr('disabled',false);
  		} else {
  			$("#name").attr('disabled',true);
  		}
  }
  function checkUseCategoryId(){
  		var val = $("#use-category_id").prop('checked');
  		//console.log(val);
  		if (val){
  			$("#category_id").attr('disabled',false);
  		} else {
  			$("#category_id").attr('disabled',true);
  		}
  }
  function checkUseCharacter(){
  	var val = $("#use-character").prop('checked');
  	if (val){
  		$("#character").attr('disabled',false);
  	} else {
  		$("#character").attr('disabled',true);
  	}
  }
  	$("#use-position").change(function(){checkUsePosition();});
  	$("#use-name").change(function(){checkUseName();});
  	$("#use-category_id").change(function(){checkUseCategoryId();});
  	$("#use-character").change(function(){checkUseCharacter()});
  
</script>
@stop