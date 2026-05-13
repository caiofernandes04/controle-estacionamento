<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <style>

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            font-family: Arial, Helvetica, sans-serif;

            padding: 30px;

            color: #111827;
        }

        .header{
            text-align: center;

            margin-bottom: 30px;
        }

        .header h1{
            font-size: 24px;

            margin-bottom: 8px;
        }

        .header p{
            font-size: 13px;

            color: #666;
        }

        table{
            width: 100%;

            border-collapse: collapse;
        }

        thead{
            background: #111827;

            color: white;
        }

        th{
            padding: 12px;

            font-size: 13px;

            text-align: left;
        }

        td{
            padding: 10px;

            border-bottom: 1px solid #ddd;

            font-size: 12px;
        }

        .visit{
            color: #1d4ed8;

            font-weight: bold;
        }

        .eco{
            color: #15803d;

            font-weight: bold;
        }

        .footer{
            margin-top: 30px;

            text-align: right;

            font-size: 13px;

            font-weight: bold;
        }

    </style>

</head>

<body>

    <div class="header">

        <h1>
            Relatório de Veículos
        </h1>

        <p>
            Gerado em {{ now()->format('d/m/Y H:i') }}
        </p>

    </div>

    <table>

        <thead>

            <tr>

                <th>Nome</th>

                <th>Placa</th>

                <th>Tipo</th>

                <th>Entrada</th>

                <th>Saída</th>

                <th>Usuario</th>

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

                        <span class="{{ $vehicle->type == 'visit' ? 'visit' : 'eco' }}">

                            {{ $vehicle->type == 'visit' ? 'Visitante' : 'Eco' }}

                        </span>

                    </td>

                    <td>
                        {{ $vehicle->entry_time }}
                    </td>

                    <td>
                        {{ $vehicle->exits_time ?? 'Em aberto' }}
                    </td>

                    <td>
                        {{ $vehicle->user_name }}
                    </td>

                    <td>
                        R$ {{ number_format($vehicle->value, 2, ',', '.') }}
                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6">
                        Nenhum veículo encontrado
                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

    <div class="footer">

        Total de veículos:
        {{ $vehicles->count() }}

    </div>

</body>

</html>