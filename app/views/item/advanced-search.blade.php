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
		<input type='hidden' name='lat' value='{{Input::old('lat')}}'/>
		<input type='hidden' name="lng" value="{{Input::old('lng')}}">
		<input type='hidden' name='rad' value='{{Input::old('rad')}}'/>
		<div id='map-canvas' style='height:500px;'></div>
	</div>

</form>
</section>
@stop


@section('script')
@parent
<script src='https://maps.googleapis.com/maps/api/js?v=3&sensor=true&key=AIzaSyC3h2wqa3ND0xEO6RiJJgirIgoX-w3Ckd0'></script>
<script type="text/javascript">
  var lat = <?=Item::DEFAULT_LAT;?>;
  var lng = <?=Item::DEFAULT_LNG;?>;
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
      radius: 300,
      editable: true,
    });
  circle.bindTo('center', marker, 'position');
  $(document).ready(function(){initializeMarker();});
  function initializeMarker(){
      marker.setPosition(new google.maps.LatLng(lat,lng));
      google.maps.event.addListener(marker,'drag',function(e){
          //change 
          $("#lost-lat").val(marker.getPosition().lat());
          $("#lost-lng").val(marker.getPosition().lng());
      });
  }
</script>
@stop