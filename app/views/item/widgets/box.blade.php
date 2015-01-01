<div class="box box-info">
    <div class="box-header" style='min-height: 72px' >
        <h3 class="box-title" >{{substr($item->name,0,35).((strlen($item->name) > 35)?'...':'')}}</h3>
        <div class="box-tools pull-right">
        	@if (isset($labels))
	        	@foreach($labels as $label)
	            <div class="label bg-aqua">{{ $label }}</div>
	            @endforeach
            @endif
        </div>
    </div>
    <div class="box-body" style='text-align:center '>
        <br>
            <img src='{{$item->getImageUrl()}}' width='100px' height="100px" />
        <br>
        <h5>Lokasi : {{substr($item->location,0,20).((strlen($item->location) > 20)?'...':'')}}</h5>
    </div>
    <div class="box-footer">
        <i class='fa fa-comments'></i> {{$item->comments->count()}} Komentar&nbsp;
        <a href='<?=URL::action('ItemController@anyView',['id' => $item->id]);?>'><i class='fa fa-arrow-right'></i> Lihat</a>
    </div>
</div>