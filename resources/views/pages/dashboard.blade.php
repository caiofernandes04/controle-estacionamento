@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1>
    Dashboard
</h1>

<div class="dashboard-grid">

    <div class="card">

        <h3>
            Veículos Hoje
        </h3>

        <h1>
            {{ $vehiclesToday }}
        </h1>

    </div>

    <div class="card">

        <h3>
            Visitantes
        </h3>

        <h1>
            {{ $visitToday }}
        </h1>

    </div>

    <div class="card">

        <h3>
            Eco
        </h3>

        <h1>
            {{ $ecoToday }}
        </h1>

    </div>

    <div class="card">

        <h3>
            Faturamento Hoje
        </h3>

        <h1>
            R$ {{ number_format($totalValue, 2, ',', '.') }}
        </h1>

    </div>

</div>

<div class="paper">

    <h1>
        Últimas Entradas
    </h1>

    <table>

        <thead>

            <tr>
                <th>Nome</th>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Entrada</th>
            </tr>

        </thead>

        <tbody>

        @forelse($lastVehicles as $vehicle)

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
                    {{ $vehicle->entry_time }}
                </td>

            </tr>

        @empty

            <tr>

                <td colspan="4" class="empty">
                    Nenhum veículo encontrado
                </td>

            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection