@extends('layouts.app')

@section('title', 'Editar Veículo')

@section('content')

<div class="form-center">

    <div class="ticket">

        <div class="title">
            EDITAR VEÍCULO
        </div>

        <div class="subtitle">
            Atualização de Dados
        </div>

        @include('includes.alerts')

        <form action="{{ route('vehicles.update', $vehicle->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="field">
                <label>Carro</label>

                <input 
                    type="text"
                    name="name"
                    value="{{ $vehicle->name }}"
                >
            </div>

            <div class="field">
                <label>Placa</label>

                <input 
                    type="text"
                    name="plate"
                    value="{{ $vehicle->plate }}"
                >
            </div>

            <div class="field">
                <label>Valor (R$)</label>

                <input 
                    type="number"
                    step="0.01"
                    name="value"
                    value="{{ $vehicle->value }}"
                >
            </div>

            <div class="field">

                <label>Tipo</label>

                <select name="type">

                    <option 
                        value="visit"
                        {{ $vehicle->type == 'visit' ? 'selected' : '' }}
                    >
                        Visitante
                    </option>

                    <option 
                        value="eco"
                        {{ $vehicle->type == 'eco' ? 'selected' : '' }}
                    >
                        Eco
                    </option>

                </select>

            </div>

            <button type="submit">
                Salvar Alterações
            </button>

        </form>

        <div class="return-button">

            <a href="{{ route('veiculos.index') }}">
                ← Voltar
            </a>

        </div>

    </div>

</div>

@endsection