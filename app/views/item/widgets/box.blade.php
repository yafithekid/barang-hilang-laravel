<div class="box box-info">
    <div class="box-header">
        <h3 class="box-title"><?=isset($title)?$title:'judul';?></h3>
        <div class="box-tools pull-right">
        	@if (isset($labels))
	        	@foreach($labels as $label)
	            <div class="label bg-aqua"><?=$label;?></div>
	            @endforeach
            @endif
        </div>
    </div>
    <div class="box-body">
    </div>
    <div class="box-footer">
        <i class='fa fa-comments'></i> 26
        <i class='fa fa-eye'></i> 26
        <i class='fa fa-arrow-right'></i> Lihat
    </div>
</div>