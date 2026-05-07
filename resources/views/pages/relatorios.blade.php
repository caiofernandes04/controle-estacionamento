@extends('layouts.app')

@section('title', 'Relatórios')

@section('content')


<div class="report-filter">

    <form method="GET" action="{{ route('relatorios.reports') }}">

        <div class="report-field">

            <label>Data Inicial</label>

            <input type="date" name="start_date">

        </div>

        <div class="report-field">

            <label>Data Final</label>

            <input type="date" name="end_date">

        </div>

        <div class="report-field">

            <label>Placa</label>

            <input 
                type="text" 
                name="plate"
                placeholder="ABC1234"
            >

        </div>

        <div class="report-field">

            <label>Tipo</label>

            <select name="type">

                <option value="">
                    Todos
                </option>

                <option value="visit">
                    Visitante
                </option>

                <option value="eco">
                    Eco
                </option>

            </select>

        </div>

        <button type="submit" class="report-button">
            Filtrar
        </button>

    </form>

</div>

<div class="paper">

    <h1>
        Relatório
    </h1>

    <table>

        <thead>

            <tr>
                <th>Nome</th>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Entrada</th>
                <th>Valor</th>
            </tr>

        </thead>

        <tbody>

        @forelse($vehicles as $vehicle)

            <tr>

                <td>
                    {{ strtoupper($vehicle->name) }}
                </td>

                <td>
                    {{ strtoupper($vehicle->plate) }}
                </td>

                <td>

                    <span class="badge {{ $vehicle->type == 'visit' ? 'visit' : 'eco' }}">

                        {{ $vehicle->type == 'visit' ? 'Visitante' : 'Eco' }}

                    </span>

                </td>

                <td>
                    {{ $vehicle->day_entry }}
                </td>

                <td>
                    R$ {{ $vehicle->value }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="5" class="empty">
                    Nenhum veículo encontrado
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection