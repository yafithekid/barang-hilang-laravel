  <?= Form::token(); ?>
  <input type='hidden' name='user_id' value='{{Auth::user()->id;}}'/>
  <div class='form-group @if($errors->has("name")) has-error @endif'>
      <label for='name'>Nama Barang</label>
      <input type='text' name='name' value='{{$item->name}}' class='form-control'>
      <span style='color:#f56954'><?= $errors->first('name'); ?></span>
  </div>

  <div class='form-group @if($errors->has("type")) has-error @endif'>
    <label for='type'>Laporan</label>
    <select name='type' value='{{$item->type}}' class='form-control'>
      <option label='Kehilangan' @if($item->type==Item::LOST) selected @endif>{{Item::LOST}}</option>
      <option label='Temuan' @if($item->type==Item::FOUND) selected @endif>{{Item::FOUND}}</option>
    </select>
  </div>

  <div class='form-group @if($errors->has("contact_no")) has-error @endif'>
      <label for='contact_no'>HP/Email yang bisa dihubungi</label>
      <input type='text' name='contact_no' value='{{$item->contact_no}}' class='form-control'>
      <span style='color:#f56954'><?= $errors->first('contact_no'); ?></span>
  </div>

  <div class='form-group @if($errors->has("contact_name")) has-error @endif'>
      <label for='contact_name'>Nama Kontak</label>
      <input type='text' name='contact_name' value='{{$item->contact_name}}' class='form-control'>
      <span style='color:#f56954'><?= $errors->first('owner'); ?></span>
  </div>
  
  <div class='form-group @if($errors->has("location")) has-error @endif'>
    <label for='location'>Lokasi hilang/temuan</label>
    <input type='text' name='location' value='{{$item->location}}' class='form-control'>
    <span style='color:#f56954'><?= $errors->first('location'); ?></span>
  </div>
  
  <div class='form-group'>
      <label>Perkiraan lokasi hilang/temuan (Tarik marka merah)</label>
      <div id='map-canvas' style='height:500px;'></div>
      <input type='hidden' name='lat' value='{{$item->lat}}' class='form-control' id='lost-lat'/>
      <input type='hidden' name='lng' value='{{$item->lng}}' class='form-control' id='lost-lng'/>
  </div>

  <div class='form-group @if($errors->has("category_id")) has-error @endif'>
      <label for='category_id'>Jenis Barang</label>
      <select name='category_id' value='{{$item->category_id}}' class='form-control'>
          <?php foreach ($item_categories as $item_category): ?>
              <option label='<?=$item_category->name;?>' @if($item->category_id == $item_category->id) selected @endif ><?=$item_category->id;?></option>
          <?php endforeach; ?>
      </select>
      <span style='color:#f56954'><?= $errors->first('category_id'); ?></span>
  </div>

  <div class='form-group @if($errors->has("description")) has-error @endif'>
      <label for='description'>Deskripsi</label>
      <textarea name='description' class='form-control'>{{$item->description}}</textarea>
      <span style='color:#f56954'><?= $errors->first('description'); ?></span>
  </div>

  <div class='form-group @if($errors->has("image")) has-error @endif'>
    <label for='image'>Gambar</label>
    <input type='file' name='image' class='form-control' value='{{$item->image}}' />
    <span style='color:#f56954'><?= $errors->first('image'); ?></span>
  </div>

@section('script')
@parent
<script src='https://maps.googleapis.com/maps/api/js?v=3&sensor=true&key=AIzaSyC3h2wqa3ND0xEO6RiJJgirIgoX-w3Ckd0'></script>
<script type="text/javascript">
  var lat = <?=$item->lat;?>;
  var lng = <?=$item->lng;?>;
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