@extends('layouts.master')
@section('main-content')
	<div class="box">
        <div class="box-header">
            <h3 class="box-title">Barang Saya</h3>
            <!-- <div class="box-tools">
                <div class="input-group">
                    <input type="text" name="table_search" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search">
                    <div class="input-group-btn">
                        <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div> -->
        </div><!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <tbody><tr>
                    <th>Nama</th>
                    <th>Tipe</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Jumlah Komentar</th>
                    <th>Aksi</th>
                </tr>
                @foreach($items as $item)
                <tr>
                    <td>{{$item->name}}</td>
                    <td>{{$item->type}}</td>
                    <td>{{$item->location}}</td>
                    <td><span class="label @if($item->finished == 1) label-success @else label-warning @endif">
                    	@if ($item->finished == 1)
                    		Selesai
                    	@else
                    		Belum selesai
                    	@endif
                    	</span>
                   	</td>
                    <td>{{$item->comments->count()}}</td>
                    <td>
                    	<a href='<?= URL::action('ItemController@anyView',['id' => $item->id]);?>'><span class='fa fa-eye'></span></a>
                    	<a href='<?= URL::action('ItemController@getUpdate',['id' => $item->id]);?>'><span class='fa fa-pencil'></span></a>
                    	<a href='<?= URL::action('ItemController@anyDelete',['id' => $item->id]);?>' onclick='return confirm("Anda yakin ingin menghapus barang ini?")'><span class='fa fa-trash'></span></a>
                    </td>
                </tr>
                @endforeach
            </tbody></table>
        </div><!-- /.box-body -->
    </div>
@stop
