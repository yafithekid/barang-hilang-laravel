@extends('layouts.master')
@section('main-content')
<section class='content-header'>
	<h1><?= ($item->type == Item::LOST)?'Hilang':'Ditemukan';?>: <?=$item->name;?></h1>
</section>
<section class='content'>
	<h4>Dilaporkan pada <?=$item->created_at;?> </h4>
	<dl class='dl-horizontal' style='font-size:18px;'>
		<dt>Pemilik</dt> <dd><?=$item->owner;?></dd>
		<dt>Lokasi <?=($item->type == Item::LOST)?'hilang':'ketemu';?></dt> <dd><?=$item->location;?></dd>
		<dt>Kontak</dt><dd>{{ $item->contact_person }} </dd>
	</dl>
	<p>{{$item->description}}</p>
	<div class="box box-success">
        <div class="box-header">
            <i class="fa fa-comments-o"></i>
            <h3 class="box-title">Komentar</h3>
        </div>
        <div class="box-body">
        	@foreach($comments as $comment)
            <div class="item">
                <p class="message">
                    <a href="#" class="name">
                        <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>{{$comment->created_at}}</small>
                        {{ $comment->user->username }} 
                    </a>
                    <div style='clear:both'></div>
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