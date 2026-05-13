# Sistema de Estacionamento

Sistema desenvolvido em Laravel para controle de entrada, saída e relatórios de veículos em um estacionamento.

## Funcionalidades

- Cadastro de veículos
- Registro de entrada e saída
- Cálculo de valor por tempo de permanência
- Dashboard com resumo diário
- Relatórios com filtros por data, tipo e placa
- Exportação de relatórios em PDF e Excel
- Controle de usuários autenticados
- Registro do usuário responsável pelas ações

## Tecnologias

- PHP 8.3
- Laravel 13
- Blade
- MySQL
- Vite
- Tailwind CSS
- Laravel Breeze
- DomPDF
- Laravel Excel

## Como Rodar o Projeto

Clone o repositório:

```bash
git clone https://github.com/caiofernandes04/controle-estacionamento.git
cd controle-estacionamento
```

Instale as dependências:

```bash
composer install
npm install
```

Configure o ambiente:

```bash
cp .env.example .env
php artisan key:generate
```

Depois, configure o banco de dados no arquivo `.env` e rode as migrations:

```bash
php artisan migrate
```

Inicie o projeto:

```bash
php artisan serve
npm run dev
```

## Comandos Úteis

Rodar testes:

```bash
php artisan test
```

Gerar build dos assets:

```bash
npm run build
```

## Autor

Desenvolvido por Caio Fernandes.
