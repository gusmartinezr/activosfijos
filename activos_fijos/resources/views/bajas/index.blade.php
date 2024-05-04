@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Listado de Bajas</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Activo</th>
                    <th>Cantidad</th>
                    <th>Motivo</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bajas as $baja)
                    <tr>
                        <td>{{ $baja->id }}</td>
                        <td>{{ $baja->activo->name }}</td>
                        <td>{{ $baja->quantity }}</td>
                        <td>{{ $baja->reason }}</td>
                        <td>{{ $baja->date }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
