@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
          @if (session('status'))
               <div class="alert alert-success">
                    {{ session('status') }}
               </div>
          @endif
          <div class="panel panel-default">
               <div class="panel-heading">
                    {{ __( 'Create a new Task' ) }}
                    <span class="pull-right">
                         <a href="{{ route( 'tasks.index' ) }}" class="btn btn-primary btn-xs">{{ __( 'Tasks List' ) }}</a>
                    </span>
               </div>
               <div class="panel-body">
                    <form action="{{ route( 'tasks.store' ) }}" method="POST">
                         {{ csrf_field() }}
                         <div class="form-group {{ $errors->has( 'name' ) ? 'has-error' : '' }}">
                              <label for="name">{{ __( 'Name' ) }}</label>
                              <input type="text" class="form-control" name="name">
                              <p class="help-block">
                              @if( $errors->has( 'name' ) ) 
                                   {{ $errors->first( 'name' ) }}
                              @else
                                   {{ __( 'Provide a name to the task' ) }}
                              @endif
                              </p>
                         </div>

                         <div class="form-group {{ $errors->has( 'ends_at' ) ? 'has-error' : '' }}">
                              <label for="ends_at">{{ __( 'Ends On' ) }}</label>
                              <input type="datetime-local" class="form-control" name="ends_at">
                              <p class="help-block">{{ __( 'Define an ending date for that task' ) }}</p>
                         </div>

                         <div class="form-group {{ $errors->has( 'description' ) ? 'has-error' : '' }}">
                              <label for="description">{{ __( 'Description' ) }}</label>
                              <textarea rows="10" class="form-control" name="description"></textarea>
                              <p class="help-block">{{ __( 'Provide a description to the task.' ) }}</p>
                         </div>
                         
                         <button type="submit" class="btn btn-primary">{{ __( 'Save Task' ) }}</button>
                    </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection
