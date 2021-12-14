@extends('template1')

@section('contenu1')
    <br>
	<div class="col-sm-offset-3 col-sm-6">
		<div class="panel panel-info">
			<div class="panel-heading">Contactez-moi</div>
			<div class="panel-body"> 
				
				<form method="POST" action="{!! url('contact/form') !!}" accept-charset="UTF-8">
					{!! csrf_field() !!} 
					<div class="form-group {!! $errors->has('nom') ? 'has-error' : '' !!}">
						<input name="nom" type="text" id="nom" class="form-control" placeholder="Votre nom">
						{!! $errors->first('nom', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
						<input name="email" type="email" id="email" class="form-control" placeholder="Votre email">
						{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>
					<div class="form-group {!! $errors->has('texte') ? 'has-error' : '' !!}">
						<textarea name="texte" id="texte" class="form-control" placeholder="Votre message"> </textarea>
						{!! $errors->first('texte', '<small class="help-block">:message</small>') !!}
					</div>
					<input type="submit" id="nom" class="btn btn-info pull-right" value="Envoyer !">
				</form>
			</div>
		</div>
	</div>
@stop


