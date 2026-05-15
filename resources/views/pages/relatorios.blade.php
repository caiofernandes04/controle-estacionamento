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

                <option value="Mensalista">
                    Mensalista
                </option>

            </select>

        </div>

        <button type="submit" class="report-button">
            Filtrar
        </button>

    </form>

</div>

<div class="dashboard-cards">

    <div class="card">

        <h3>Total Veículos</h3>

        <p>
            {{ $totalVeiculos }}
        </p>

    </div>

    <div class="card">

        <h3>Visitantes</h3>

        <p>
            {{ $visitCount }}
        </p>

    </div>

    <div class="card">

        <h3>Eco</h3>

        <p>
            {{ $ecoCount }}
        </p>

    </div>

    <div class="card">

        <h3>Mensalistas</h3>

        <p>
            {{ $mensalistaCount }}
        </p>
    </div>


</div>

<div class="export-buttons">

    <a 
        href="{{ route('vehicles.pdf', request()->query()) }}"
        class="pdf-button"
    >
        Exportar PDF
    </a>

    <a 
    href="{{ route('vehicles.excel') }}"
    class="excel-button"
    >
        Exportar Excel
    </a>

</div>

<div class="paper">

    <h1>
        Relatório
    </h1>

    <table id="reports-table">

        <thead>

            <tr>
                <th>Nome</th>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Entrada</th>
                <th>Usuario</th>
                <th>Permanências</th>
            </tr>

        </thead>

        <tbody>

        @foreach($vehicles as $vehicle)

            <tr>

                <td>
                    {{ strtoupper($vehicle->name) }}
                </td>

                <td>
                    {{ strtoupper($vehicle->plate) }}
                </td>

                <td>

                    <span class="badge {{ $vehicle->type }}">

                        {{ $vehicle->type }}

                    </span>

                </td>

                <td>
                    {{ $vehicle->day_entry }}
                </td>

                <td>
                     {{ $vehicle->user_name }}
                </td>

                <td>

                    {{
                        \Carbon\Carbon::parse($vehicle->entry_time)
                        ->diff(
                            \Carbon\Carbon::parse($vehicle->exits_time)
                        )
                        ->format('%Hh %Im')
                    }}

                </td>

            </tr>

        @endforeach

        </tbody>

    </table>

</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const table = document.querySelector('#reports-table');

            if (!table) {
                return;
            }

            if (window.DataTable) {
                new DataTable('#reports-table', {
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.3.4/i18n/pt-BR.json',
                    },
                    pageLength: 10,
                    order: [[3, 'desc']],
                });

                return;
            }

            const search = document.createElement('input');
            search.type = 'search';
            search.className = 'table-search';
            search.placeholder = 'Buscar no relatório';

            table.parentNode.insertBefore(search, table);

            search.addEventListener('input', function () {
                const term = search.value.toLowerCase();

                table.querySelectorAll('tbody tr').forEach(function (row) {
                    row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
                });
            });
        });
    </script>
@endpush

@push('styles')
    <style>
        .table-search{
            width: 100%;
            max-width: 320px;
            padding: 12px;
            margin-bottom: 18px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
            background: #f9fafb;
        }

        .table-search:focus{
            outline: none;
            border-color: #111827;
            background: white;
            box-shadow: 0 0 0 3px rgba(17,24,39,0.1);
        }
    </style>
@endpush
