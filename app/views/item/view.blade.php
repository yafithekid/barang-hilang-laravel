@extends('layouts.master')
@section('main-content')
<section class='content-header'>
	<h1><?= ($item->type == Item::LOST)?'Hilang':'Ditemukan';?>: <?=$item->name;?></h1>
</section>
<section class='content'>
	<h4>Dilaporkan pada <?=$item->created_at;?> </h4>
    <div class='col-xs-12'>
        <div class='col-xs-6'>
            <img src='{{$item->getImageUrl()}}' max-width='100px' max-height='100px' />
            <dl class='dl-horizontal' style='font-size:14px;'>
                <dt>Pemilik</dt> <dd><?=$item->owner;?></dd>
                <dt>Lokasi <?=($item->type == Item::LOST)?'hilang':'ketemu';?></dt> <dd><?=$item->location;?></dd>
                <dt>Kontak</dt><dd>{{ $item->contact_person }} </dd>
            </dl>
            <p>{{$item->description}}</p>
        </div>
        <div class='col-xs-6'>
            <div id='map-canvas' style='height:300px'></div><br/><br/>
        </div>
    </div>
	<div class='clearfix'></div>
	<div class="box box-success">
        <div class="box-header">
            <i class="fa fa-comments-o"></i>
            <h3 class="box-title">Komentar</h3>
        </div>
        <div class="box-body chat">
        	@foreach($comments as $comment)
            <div class="item">
                <img src="{{$comment->user->getImageUrl()}}" alt="user image" class="online" />
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>{{$comment->created_at}}</small>
                        {{ $comment->user->fullname}}
                    </a>
                    {{$comment->content}}
                </p>
            </div>
            @endforeach
        </div>
        <div class='box-footer'>
        	@if (Auth::check())
        	<form action="{{ URL::action('ItemController@postComment',['item_id'=>$item->id]);}}" method='post'>
        		<input type='hidden' name='item_id' value='{{$item->id}}'/>
        		<input type='hidden' name='user_id' value='{{Auth::user()->id}}'/>
        		<div class='form-group'>
        			<textarea name='content' class='form-control'>{{Input::old('content')}}</textarea>
        		</div>
        		
        		<input type='submit' class='btn btn-primary' value='Tambah Komentar'>
        	</form>
        	@else
        		Anda harus login untuk memberikan komentar
        	@endif
        </div>
    </div>
</section>
@stop
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
      draggable: false,
      title: 'Start',
      map: map,
  });


  $(document).ready(function(){initializeMarker();});
  function initializeMarker(){
      marker.setPosition(new google.maps.LatLng(lat,lng));
  }
</script>
@stop