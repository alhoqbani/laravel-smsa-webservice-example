@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <App></App>

@endsection