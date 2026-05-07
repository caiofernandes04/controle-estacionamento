@extends('layouts.app')

@section('title', 'Veículos no Pátio')

@section('content')

<div class="paper">

    <h1>🚗 Veículos no Pátio</h1>

    <table>

        <thead>
            <tr>
                <th>Nome</th>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Entrada</th>
                <th>Valor</th>
                <th>Editar</th>
                <th></th>
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
                    {{ $vehicle->entry_time }}
                </td>

                <td>
                    {{ $vehicle->value }}
                </td>

                <td>
                    <a href="{{ route('vehicles.edit', $vehicle->id) }}">
                        ✏️
                    </a>
                </td>

                <td>
                    <div class="exit-button">
                        <form action="{{ route('vehicles.exit', $vehicle->id) }}" method="POST">

                            @csrf
                            @method('PUT')

                            <button type="submit">
                                Saída
                            </button>

                        </form>
                    </div>
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="7" class="empty">
                    Nenhum veículo no pátio
                </td>
            </tr>

        @endforelse

        </tbody>

    </table>

</div>

@endsection
