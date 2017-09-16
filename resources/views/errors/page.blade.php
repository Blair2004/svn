@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <h3 class="text-center">{{ config( 'app.errors.' . $code . '.title' ) }}</h3>
                    <p class="text-center">{{ config( 'app.errors.' . $code . '.message' ) }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
