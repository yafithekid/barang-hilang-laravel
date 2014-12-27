@extends('layouts.master')
<div class='col-xs-6'>
    <div class='box box-success'>
    
        <div class="box-header">
            <h3 class="box-title">Form Kehilangan</h3>
        </div>
        
        <form action='<?=URL::action("LostItemController@postCreate");?>' method='POST'>
        <div class='box-body'>
            
            
            <?= Form::token(); ?>
            
            <div class='form-group @if($errors->has("name")) has-error @endif'>
                <label for='name'>Nama Barang</label>
                <input type='text' name='name' value='<?=Input::old('name');?>' class='form-control'>
                <?= $errors->first('name'); ?>
            </div>
            
        </div>

        <div class='box-footer'>
            <input type='submit' class='btn btn-primary' value='Daftar'/>
        </div>
        </form>
    
    </div>
</div>