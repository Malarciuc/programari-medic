@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($appointments->count())
                            <table class="table">
                                @foreach($appointments as $appointment)

                                    <tr class="d-table-row">

                                    </tr>
                                @endforeach
                            </table>
                        @else
                            Nu aveti inca nici o programare <a class="btn btn-primary" href="/make-appointment" >Programeaza-te</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
