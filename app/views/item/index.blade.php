@extends('layouts.master')

@section('main-content')
<section class='content-header'>
Barang Temuan
</section>
	
<section class='content'>
	@if ($found_items->count() > 0)
		@foreach($found_items as $item)
		<div class='col-xs-4'>
			@include('item.widgets.box',['item' => $item]);
	    </div>
	    @endforeach
	    <div style="clear:both"></div> 
    	{{ $found_items->links() }}
    @else
    	<h5>Tidak ada barang yang ditemukan</h5>
    @endif
    
</section>
<div style='clear:both'></div>
<section class='content-header'>
Barang Hilang
</section>
<section class='content'>
	@if ($lost_items->count() > 0)
		@foreach($lost_items as $item)
		<div class='col-xs-4'>
			@include('item.widgets.box',['item'=>$item]);
	    </div>
   		@endforeach
   		<div style="clear:both"></div>
    	{{ $lost_items->links() }}
   	@else
    	<h5>Tidak ada barang yang ditemukan</h5>
    @endif
    
</section>
@stop