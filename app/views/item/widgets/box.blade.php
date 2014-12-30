<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title">{{$item->name}}</h3>
        <div class="box-tools pull-right">
        	@if (isset($labels))
	        	@foreach($labels as $label)
	            <div class="label bg-aqua">{{ $label }}</div>
	            @endforeach
            @endif
        </div>
    </div>
    <div class="box-body" style='text-align:center;'>
        <br>
            <img src='{{$item->getImageUrl()}}' width='100px' height="100px" />
        <br>
        <h5>Lokasi : {{ $item->location }} </h5>
    </div>
    <div class="box-footer">
        <i class='fa fa-comments'></i> {{$item->comments->count()}} Komentar&nbsp;
        <a href='<?=URL::action('ItemController@anyView',['id' => $item->id]);?>'><i class='fa fa-arrow-right'></i> Lihat</a>
    </div>
</div>