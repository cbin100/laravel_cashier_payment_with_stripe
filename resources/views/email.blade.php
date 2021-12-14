@extends('template1')

@section('contenu1')
    <br>
	<div class="col-sm-offset-3 col-sm-6">
		<div class="panel panel-info">
			<div class="panel-heading">Inscription a la lettre d'information</div>
			<div class="panel-body"> 
				
				<form method="POST" action="{!! url('email/form') !!}" accept-charset="UTF-8">
					{!! csrf_field() !!} 
					
					<div class="form-group {!! $errors->has('email') ? 'has-error' : '' !!}">
						<input name="email" type="email" id="email" class="form-control" placeholder="Entrer votre email">
						{!! $errors->first('email', '<small class="help-block">:message</small>') !!}
					</div>
					
					<input type="submit" id="nom" class="btn btn-info pull-right" value="Envoyer !">
				</form>
			</div>
		</div>
	</div>
@stop


