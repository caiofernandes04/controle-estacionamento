<div class="sidebar">

    <h2>Estacionamento Cavalini</h2>

    <a href="{{ route('dashboard') }}">📊 Dashboard</a>
    <a href="{{ route('entrada.index') }}">🚗 Entrada</a>
    <a href="{{ route('veiculos.index') }}">📋 Pátio</a>
    <a href="{{ route('relatorios.reports') }}">🗂️ Relatórios</a>
    @if (auth()->user()?->role === 'admin')
        <a href="/admin">🔑 Painel do administrador</a>
    @endif
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit">Sair</button>
    </form>

</div>
