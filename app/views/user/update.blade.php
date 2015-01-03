@extends('layouts.master')
@section('main-content')
<div class='box box-success'>

    <div class="box-header">
        <h3 class="box-title">Ubah Profil</h3>
    </div>
    
    <form action='<?=URL::action("UserController@postUpdate",['id'=>$user->id]);?>' method='POST' enctype='multipart/form-data'>
    <div class='box-body'>
        @include('user._form',['user'=>$user])
    </div>

    <div class='box-footer'>
        <input type='submit' class='btn btn-primary' value='Ubah'/>
    </div>
    </form>

</div>
@stop