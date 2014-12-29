@extends('layouts.master')

@section('main-content')
  <?= Form::token(); ?>
  <div class='form-group @if($errors->has("name")) has-error @endif'>
      <label for='name'>Nama Barang</label>
      <input type='text' name='name' value='<?=Input::old('name');?>' class='form-control'>
      <span style='color:#f56954'><?= $errors->first('name'); ?></span>
  </div>

  <div class='form-group @if($errors->has("type")) has-error @endif'>
    <label for='type'>Laporan</label>
    <select name='type' value='<?=Input::old('type');?>' class='form-control'>
      <option value='<?=Item::LOST;?>'>Kehilangan</option>
      <option value='<?=Item::FOUND;?>'>Temuan</option>
    </select>
  </div>

  <div class='form-group @if($errors->has("owner")) has-error @endif'>
      <label for='owner'>Nama Pemilik</label>
      <input type='text' name='owner' value='<?=Input::old('owner');?>' class='form-control'>
      <span style='color:#f56954'><?= $errors->first('owner'); ?></span>
  </div>

  <div class='form-group @if($errors->has("contact_person")) has-error @endif'>
      <label for='contact_person'>Kontak yang bisa dihubungi</label>
      <input type='text' name='contact_person' value='<?=Input::old('contact_person');?>' class='form-control'>
      <span style='color:#f56954'><?= $errors->first('contact_person'); ?></span>
  </div>
  
  <div class='form-group @if($errors->has("location")) has-error @endif'>
    <label for='location'>Lokasi hilang/temuan</label>
    <input type='text' name='location' value='<?=Input::old('location');?>' class='form-control'>
    <span style='color:#f56954'><?= $errors->first('location'); ?></span>
  </div>
  
  <div class='form-group'>
      <label>Perkiraan lokasi hilang/temuan (Tarik marka merah)</label>
      <div id='map-canvas' style='height:500px;'></div>
      <input type='hidden' name='lat' value='<?=Input::old('lat',Item::DEFAULT_LAT);?>' class='form-control' id='lost-lat'/>
      <input type='hidden' name='lng' value='<?=Input::old('lng',Item::DEFAULT_LNG);?>' class='form-control' id='lost-lng'/>
  </div>

  <div class='form-group @if($errors->has("item_category_id")) has-error @endif'>
      <label for='category_id'>Jenis Barang</label>
      <select name='category_id' value='<?=Input::old('item_category_id');?>' class='form-control'>
          <?php foreach ($item_categories as $item_category): ?>
              <option value='<?=$item_category->id;?>'><?=$item_category->name;?></option>
          <?php endforeach; ?>
      </select>
      <span style='color:#f56954'><?= $errors->first('item_category_id'); ?></span>
  </div>

  <div class='form-group @if($errors->has("description")) has-error @endif'>
      <label for='description'>Deskripsi</label>
      <textarea name='description' class='form-control'><?=Input::old('description');?></textarea>
      <span style='color:#f56954'><?= $errors->first('description'); ?></span>
  </div>
@stop

@section('script')
@parent
<script src='https://maps.googleapis.com/maps/api/js?v=3&sensor=true&key=AIzaSyC3h2wqa3ND0xEO6RiJJgirIgoX-w3Ckd0'></script>
<script type="text/javascript">
  var lat = <?=$lost_item->lost_lat;?>;
  var lng = <?=$lost_item->lost_lng;?>;
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