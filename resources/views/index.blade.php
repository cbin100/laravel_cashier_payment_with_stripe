

@extends('template1')

@section('contenu1')
    <br>
    <div class="col-sm-offset-4 col-sm-4">
    	@if(session()->has('ok'))
			<div class="alert alert-success alert-dismissible">{!! session('ok') !!}</div>
		@endif
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Liste des utilisateurs</h3>
			</div>
			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nom</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td>{!! $user->id !!}</td>
							<td class="text-primary"><strong>{!! $user->name !!}</strong></td>
							<td>{!! url('user.show', 'Voir', [$user->id], ['class' => 'btn btn-success btn-block']) !!}</td>
							<td>{!! URL::to('user.edit', 'Modifier', [$user->id], ['class' => 'btn btn-warning btn-block']) !!}</td>
							<td>
								


								<form method="DELETE" action="{!! url('user.destroy', [$user->id]) !!}" accept-charset="UTF-8">
								{!! csrf_field() !!}
								<input type="submit" id="Supprimer" name="Supprimer" class="btn btn-danger btn-block" value="Supprimer !" onclick="return confirm(\'Vraiment supprimer cet utilisateur ?\')">
								</form>

							</td>
						</tr>
					@endforeach
	  			</tbody>
			</table>
		</div>
		{!! url('user.create', 'Ajouter un utilisateur', [], ['class' => 'btn btn-info pull-right']) !!}
		{!! $links !!}
	</div>
@stop