@extends('layouts.app') 
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					{{ __( 'Register a new release' ) }}
					<span class="pull-right">
						<a href="{{ route( 'software.index' ) }}" class="btn btn-primary btn-xs">{{ __( 'Software List' ) }}</a>
					</span>
				</div>
				<div class="panel-body">
					<form action="{{ route( 'software.submitRelease' ) }}" method="POST" enctype="multipart/form-data">
						{{ csrf_field() }}
						<div class="form-group {{ $errors->has( 'software_id' ) ? 'has-error' : '' }}">
							<label for="software_id">{{ __( 'Select the software' ) }}</label>
							<select name="software_id" type="text" class="form-control" id="software_id">
								<option>{{ __( 'Select a software' ) }}</option>
                                        @foreach( $softwares as $software ) 
                                        <option {{ old( 'software_id' ) == $software->id ? 'selected' : '' }} value="{{ $software->id }}">{{ $software->name }}</option>
                                        @endforeach
                                   </select>
							<p class="help-block">{{ $errors->first( 'software_id' ) }}</p>
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
							<label for="changelog">{{ __( 'Changelog' ) }}</label>
							<textarea rows="20" name="changelog" type="text" class="form-control" id="changelog" placeholder="App Changelog">{{ old( 'changelog' ) }}</textarea>
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