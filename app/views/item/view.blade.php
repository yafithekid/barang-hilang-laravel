@extends('layouts.master')
@section('main-content')
<section class='content-header'>
	<h1><?= ($item->type == Item::LOST)?'Hilang':'Ditemukan';?>: <?=$item->name;?></h1>
</section>
<section class='content'>
	<h4>Dilaporkan oleh {{$item->user->fullname}} pada {{ $item->created_at }}</h4>
    <div class='col-xs-12'>
        <div class='col-xs-6'>
            <div class='row'>
              <img src='{{$item->getImageUrl(1)}}' width='300px' height='300px' id='main-img'/>
            </div>
            @foreach([1,2,3] as $i)
              @if ($item->getImageUrl($i))
                <img src='{{$item->getImageUrl($i)}}' width='50px' height='50px' id='img-{{$i}}' style='border: 1px solid black'/>
              @endif
            @endforeach
            <br/>
            <dl class='dl-horizontal' style='font-size:14px;'>
                <dt>Lokasi <?=($item->type == Item::LOST)?'hilang':'ketemu';?></dt> <dd><?=$item->location;?></dd>
                <dt>Kontak</dt><dd>{{ $item->contact_no }} </dd>
                <dt>Nama Kontak</dt><dd>{{ $item->contact_name }}</dd>
            </dl>
            <p>{{$item->description}}</p>
        </div>
        <div class='col-xs-6'>
            <div id='map-canvas' style='height:300px'></div><br/><br/>
            <div class='form-group'>
            <div class="fb-share-button" data-href="{{URL::action('ItemController@anyView',['id'=>$item->id])}}" data-layout="button_count"></div>
          </div>
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

  $(document).ready(function(){
    $("#img-1").hover(function(){
      var src = $(this).attr('src');
      $("#main-img").attr('src',src);
    });
    $("#img-2").hover(function(){
      var src = $(this).attr('src');
      $("#main-img").attr('src',src);
    });
    $("#img-3").hover(function(){
      var src = $(this).attr('src');
      $("#main-img").attr('src',src);
    });
  });
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=363050293866988&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
@stop