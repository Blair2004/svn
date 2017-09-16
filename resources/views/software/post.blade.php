@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ __( 'Register a new app' ) }}
					<span class="pull-right">
						<a href="{{ route( 'software.index' ) }}" class="btn btn-primary btn-xs">{{ __( 'Software List' ) }}</a>
					</span>
				</div>
				<div class="panel-body">
					<form action="{{ route( 'software.submit' ) }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group {{ $errors->has( 'name' ) ? 'has-error' : '' }}">
							<label for="name">{{ __( 'Software Name' ) }}</label>
							<input value="{{ old( 'name' ) }}" name="name" type="text" class="form-control" id="name" placeholder="Name">
							<p class="help-block">{{ $errors->first( 'name' ) }}</p>
						</div>
						<div class="form-group {{ $errors->has( 'namespace' ) ? 'has-error' : '' }}">
							<label for="namespace">{{ __( 'Software Namespace' ) }}</label>
							<input value="{{ old( 'namespace' ) }}" name="namespace" type="text" class="form-control" id="namespace" placeholder="Namespace">
							<p class="help-block">{{ $errors->first( 'namespace' ) ? $errors->first( 'namespace' ) : __( 'Unique namespace for the software' ) }}</p>
						</div>
						<div class="form-group {{ $errors->has( 'description' ) ? 'has-error' : '' }}">
							<label for="description">{{ __( 'Description' ) }}</label>
							<textarea name="description" type="text" class="form-control" id="description" placeholder="App description">{{ old( 'description' ) }}</textarea>
							<p class="help-block">{{ $errors->first( 'description' ) }}</p>
						</div>
						<div class="form-group {{ $errors->has( 'release_file' ) ? 'has-error' : '' }}">
							<label for="release_file">{{ __( 'File' ) }}</label>
							<input value="{{ old( 'release_file' ) }}" type="file" name="release_file" class="form-control" id="release_file" placeholder="file">
							<p class="help-block">{{ $errors->first( 'release_file' ) }}</p>
						</div>
						<div class="form-group {{ $errors->has( 'version' ) ? 'has-error' : '' }}">
							<label for="version">{{ __( 'Initial Release' ) }}</label>
							<input value="{{ old( 'version' ) }}" name="version" type="text" class="form-control" id="version" placeholder="version">
							<p class="help-block">{{ $errors->first( 'version' ) }}</p>
						</div>
						<div class="form-group {{ $errors->has( 'changelog' ) ? 'has-error' : '' }}">
							<label for="changelog">{{ __( 'Initial Changelog' ) }}</label>
							<textarea name="changelog" type="text" class="form-control" id="changelog" placeholder="App Changelog">{{ old( 'changelog' ) }}</textarea>
							<p class="help-block">{{ $errors->first( 'changelog' ) }}</p>
						</div>
						<button class="btn btn-primary" type="submit">{{ __( 'Save Software' ) }}</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection