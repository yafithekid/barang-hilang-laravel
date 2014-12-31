@extends('layouts.master')
@section('main-content')
<section class='content-header'>
	Pencarian lanjut
</section>
<section class='content'>
<form action='{{URL::action('ItemController@anyAdvancedSearch')}}' method='get'>
	<div class='form-group'>
		<label for='type'>Tipe</label>
		<select name='type' class='form-control' value='{{Input::old('type')}}'>
			<option value='{{Item::LOST}}'>Barang hilang</option>
			<option value='{{Item::FOUND}}'>Barang temuan</option>
		</select>
	</div>
	<div class='form-group'>
		<input name='use-name' type='checkbox' value='{{Input::old('use-name')}}'>
		<label for='name'>Nama barang</label>
		<input type='text' name='name' class='form-control' value='{{Input::old('name')}}'/>
	</div>

	<div class='form-group'>
		<input name='use-category' type='checkbox' value='{{Input::old('use-category')}}'>
		<label for='category_id'>Kategori</label>
		<select name='category_id' value='{{Input::old('category_id')}}' class='form-control'>
			@foreach($categories as $category)
				<option value='{{$category->id}}'>{{$category->name}}</option>
			@endforeach
		</select>
	</div>

	<div class='form-group'>
		<label for='position'>Posisi Barang</label>
		<input type='hidden' name='lat' id='lat' value='{{Input::old('lat',Item::DEFAULT_LAT)}}'/>
		<input type='hidden' name="lng" id='lng' value="{{Input::old('lng',Item::DEFAULT_LNG)}}">
		<input type='hidden' name='rad' id='rad' value='{{Input::old('rad',Item::DEFAULT_RAD)}}'/>
		<div id='map-canvas' style='height:500px;'></div>
	</div>

</form>
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
      radius: {{Input::old('rad',Item::DEFAULT_RAD)}},
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
  }
</script>
@stop