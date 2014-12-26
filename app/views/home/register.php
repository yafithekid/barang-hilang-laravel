
<?= Form::open(); ?>
<?= Form::label('username','Username'); ?>
<?= Form::text('username',Input::old('username'),[]); ?>
<?= $errors->first('username'); ?>

<?= Form::label('password','Password'); ?>
<?= Form::password('password',[]); ?>
<?= $errors->first('password'); ?>

<?= Form::label('repeat_password','Ulangi Password'); ?>
<?= Form::password('repeat_password',[]); ?>
<?= $errors->first('repeat_password'); ?>

<?= Form::label('fullname','Nama lengkap'); ?>
<?= Form::text('fullname',Input::old('fullname'),[]); ?>
<?= $errors->first('fullname'); ?>

<?= Form::submit('Register'); ?>
<?= Form::close(); ?>