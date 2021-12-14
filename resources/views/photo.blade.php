@extends('template1')

@section('contenu1')
    <br>
	<div class="col-sm-offset-4 col-sm-6">
		<div class="panel panel-info">
			<div class="panel-heading">Envoi d'une photo</div>
			<div class="panel-body"> 
				@if(session()->has('error'))
					<div class="alert alert-danger">{!! session('error') !!}</div>
				@endif
				<form method="POST" action="{!! url('photo/form') !!}" accept-charset="UTF-8" enctype="multipart/form-data">
					{!! csrf_field() !!} 
					<div class="form-group {!! $errors->has('image') ? 'has-error' : '' !!}">
						<input name="image" type="file" id="image" class="form-control">

						{!! $errors->first('image', '<small class="help-block">:message</small>') !!}
					</div>
					
					<input type="submit" id="nom" class="btn btn-info pull-right" value="Envoyer !">
				</form>
			</div>
		</div>
	</div>
@stop


