@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex align-content-center justify-content-center"> <h4 class="text-center"> Programari </h4>
                         <a class="btn mx-5 align-content-end btn-primary" href="/make-appointment" >Fa o programare</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($appointments->count())
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Nume Prenume Medic</th>
                                    <th>Data programarii</th>
                                    <th>Ora programarii</th>
                                    <th>Actiune</th>
                                </tr>
                                </thead>
                                @foreach($appointments as $appointment)

                                    <tr class="d-table-row">
                                          <td>
                                              {{$appointment->doctor->name}}
                                          </td>
                                          <td>
                                              {{$appointment->appointment_date}}
                                          </td>
                                          <td>
                                              {{7 + $appointment->order}}:00
                                          </td>
                                        <td>
                                            <a href="/revoke-appointment/?appointment_id={{$appointment->id}}" class="btn btn-danger">Anuleaza programare</a>
                                        </td>
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
