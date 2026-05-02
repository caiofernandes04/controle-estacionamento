@extends('layouts.app')

@section('title', 'Nova Entrada')

@section('content')

<div class="form-center">

    <div class="ticket">

        <div class="title">ESTACIONAMENTO</div>

        <div class="subtitle">
            Comprovante de Estacionamento
        </div>

        @include('includes.alerts')

        <form method="POST" action="/entrada">

            @csrf

            <div class="field">
                <label>Carro</label>

                <input type="text" name="name">
            </div>

            <div class="field">
                <label>Placa</label>

                <input type="text" name="plate">
            </div>

            <div class="field">
                <label>Valor (R$)</label>

                <input type="number" step="0.01" name="value">
            </div>

            <div class="radio-group">

                <label>
                    <input type="radio" name="type" value="visit">
                    Visitante
                </label>

                <label>
                    <input type="radio" name="type" value="eco">
                    Eco
                </label>

            </div>

            <button type="submit">
                Salvar
            </button>

        </form>

    </div>

</div>

@endsection