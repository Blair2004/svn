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
                    {{ __( 'Tasks List' ) }}
                    <span class="pull-right">
                         <a href="{{ route( 'tasks.create' ) }}" class="btn btn-primary btn-xs">{{ __( 'Add a Task' ) }}</a>
                    </span>
               </div>
               <table class="table table-bordered table-striped">
                    <thead>
                         <tr>
                              <td>{{ __( 'Task' ) }}</td>
                              <td class="text-center" width="30">{{ __( 'By' ) }}</td>
                              <td class="text-center" width="30">{{ __( 'Scheduled' ) }} </td>
                              <td class="text-center" width="30">{{ __( 'Entries' ) }}</td>
                              <td class="text-center" width="150">{{ __( 'Created' ) }}</td>
                              <td class="text-center" width="150">{{ __( 'Updated' ) }}</td>
                              <td class="text-center" width="100">{{ __( 'Actions' ) }}</td>
                         </tr>
                    </thead>
                    <tbody>
                         @if( count( $tasks ) == 0 )
                         <tr>
                              <td colspan="6">{{ __( 'No tasks has been defined' ) }}</td>
                         </tr>
                         @endif
                         @foreach( $tasks as $task ) 
                         <tr>
                              <td>{{ $task->name }}</td>
                              <td>{{ $task->user->name }}</td>
                              <td>{{ $task->scheduled ? __( 'Yes' ) : __( 'No' ) }}</td>
                              <td>{{ count( $task->entries ) }}</td>
                              <td>{{ $task->created_at->toDateTimeString() }}</td>
                              <td>{{ $task->updated_at->toDateTimeString() }}</td>
                              <td>
                                   <div class="dropdown">
                                        <button class="btn btn-default btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                             {{ __( 'Actions' ) }}
                                             <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                             <li><a 
                                                       onClick="return confirm( '{{ __( 'Would you like to delete this tasks' ) }}' )" 
                                                       href="{{ route( 'tasks.destroy', [ 'id' => $task->id ]) }}">{{ __( 'Delete' ) }}
                                                  </a>
                                             </li>
                                             <li>
                                                  <a 
                                                       onClick="return confirm( '{{ __( 'Would you like to clear all entries' ) }}' )" 
                                                       href="{{ route( 'tasks.destroy', [ 'id' => $task->id ]) }}">{{ __( 'Delete Entries' ) }}
                                                  </a>
                                             </li>
                                        </ul>
                                   </div>
                              </td>
                         </tr>
                         @endforeach
                    </tbody>
               </table>
            </div>
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection
