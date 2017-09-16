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
                    Software List
                    <span class="pull-right">
                         <a href="{{ route( 'software.add' ) }}" class="btn btn-primary btn-xs">{{ __( 'Add a new software' ) }}</a>
                         <a href="{{ route( 'software.addRelease' ) }}" class="btn btn-primary btn-xs">{{ __( 'Add a new release' ) }}</a>
                    </span>
               </div>
               <table class="table table-bordered table-striped">
                    <thead>
                         <tr>
                              <td>{{ __( 'Name' ) }}</td>
                              <td class="text-center" width="30">{{ __( 'Latest' ) }}</td>
                              <td class="text-center" width="30">{{ __( 'Count' ) }}</td>
                              <td class="text-center" width="30">{{ __( 'Author' ) }}</td>
                              <td class="text-center" width="150">{{ __( 'Updated' ) }}</td>
                              <td class="text-center" width="180">{{ __( 'Actions' ) }}</td>
                         </tr>
                    </thead>
                    <tbody>
                        @if( count( $apps ) == 0 )
                        <tr>
                            <td colspan="6">{{ __( 'No Software saved' ) }}</td>
                        </tr>
                        @endif
                        @foreach( $apps as $app )
                        <tr>
                            <td>{{ $app[ 'name' ] }}</td>
                            <td class="text-center">{{ 
                                @$app->releases[0]->version ? 
                                $app->releases[0]->version : 
                                __( 'N/A' ) 
                            }}</td>
                            <td class="text-center">{{ count( $app->releases ) }}</td>
                            <td class="text-center">{{ $app->author->name }}</td>
                            <td class="text-center">{{ $app->updated_at->diffForHumans( \Carbon\Carbon::now() ) }}</td>
                            <td>
                                <a href="{{ route( 'software.delete', [ 'id' => $app[ 'id' ] ] ) }}" class="btn btn-sm btn-danger">{{ __( 'Delete' ) }}</a>
                                <a href="{{ route( 'software.expose', [ 'id' => $app[ 'id' ] ] ) }}" class="btn btn-sm btn-info">{{ __( 'JSON Details' ) }}</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
               </table>
            </div>
            {{ $apps->links() }}
        </div>
    </div>
</div>
@endsection
