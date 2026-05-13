<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\VehiclesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function dashboard()
    {
        $vehiclesToday = Vehicle::whereDate('day_entry', today())
            ->count();

        $visitToday = Vehicle::whereDate('day_entry', today())
            ->where('type', 'visit')
            ->count();

        $ecoToday = Vehicle::whereDate('day_entry', today())
            ->where('type', 'eco')
            ->count();

        $totalValue = Vehicle::whereDate('day_entry', today())
            ->sum('value');

        $lastVehicles = Vehicle::latest()
            ->join('users', 'vehicles.user_id', '=', 'users.id')
            ->select('vehicles.*', 'users.name as user_name')
            ->take(5)
            ->get();

        return view('pages.dashboard', compact(
            'vehiclesToday',
            'visitToday',
            'ecoToday',
            'totalValue',
            'lastVehicles',
        ));
    }

    public function index()
    {
        $vehicles = Vehicle::whereDate('created_at', today())
            ->whereNull('exits_time')
            ->orderBy('entry_time', 'desc')
            ->get();

        return view('pages.veiculos', compact('vehicles'));
    }

    public function store(Request $request)
    {
        // Validação para campos vazios
        $request->validate(
            [
                'name' => 'required',
                'plate' => [
                    'required',
                    'regex:/^[A-Z]{3}[0-9][A-Z0-9][0-9]{2}$/i'
                ],
                'type' => 'required',
                'value' => 'nullable'
            ],
            [
                'name.required' => 'O nome do veículo é obrigatório!',

                'plate.required' => 'A placa é obrigatória!',
                'plate.regex' => 'Formato de placa inválido!',

                'type.required' => 'Selecione um tipo!',
            ]
        );

        // Tratando o valor para caso de inserção invalida
        $value = str_replace(',', '.', $request->value);

        if (!empty($value) && !is_numeric($value)) {
            return redirect()
                ->back()
                ->with('error', 'O valor precisa ser numérico!');
        }

        // Padronização de placa
        $plate = strtoupper(
            str_replace(['-', ' '], '', $request->plate)
        );

        $vehicle = new Vehicle();

        // Validação de data
        if (empty($request->day_entry)) {
            $vehicle->day_entry = now()->format('Y-m-d');
        } else {
            $vehicle->day_entry = $request->day_entry;
        }

        // Validação de hora
        if (empty($request->entry_time)) {
            $vehicle->entry_time = now()->format('H:i:s');
        } else {
            $vehicle->entry_time = $request->entry_time;
        }

        // Salvando dados
        $vehicle->name = $request->name;
        $vehicle->plate = $plate;
        $vehicle->value = !empty($value) ? $value : null;
        $vehicle->type = $request->type;
        $vehicle->exits_time = $request->exits_time;
        $vehicle->user_id = Auth::id();

        $vehicle->save();

        return redirect()
            ->back()
            ->with('success', 'Veículo cadastrado!');
    }

    public function edit($id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return redirect()
                ->back()
                ->with('error', 'Veículo não encontrado!');
        }

        return view('pages.editar', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return redirect()
                ->back()
                ->with('error', 'Veículo não encontrado!');
        }

        $request->validate(
            [
                'name' => 'required',
                'plate' => [
                    'required',
                    'regex:/^[A-Z]{3}[0-9][A-Z0-9][0-9]{2}$/i'
                ],
                'type' => 'required',
                'value' => 'required'
            ],
            [
                'name.required' => 'O nome do veículo é obrigatório!',

                'plate.required' => 'A placa é obrigatória!',
                'plate.regex' => 'Formato de placa inválido!',

                'type.required' => 'Selecione um tipo!',

                'value.required' => 'O valor é obrigatório!'
            ]
        );

        $value = str_replace(',', '.', $request->value);

        // Validando valor
        if (!is_numeric($value)) {
            return redirect()
                ->back()
                ->with('error', 'O valor precisa ser numérico!');
        }

        $plate = strtoupper(
            str_replace(['-', ' '], '', $request->plate)
        );

        $vehicle->name = $request->name;
        $vehicle->plate = $plate;
        $vehicle->value = $value;
        $vehicle->type = $request->type;
        $vehicle->user_id = Auth::id();

        $vehicle->save();

        return redirect()
            ->back()
            ->with('success', 'Veículo atualizado!');
    }

    public function exit(Request $request, $id)
    {
        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return redirect()
                ->back()
                ->with('error', 'Veículo não encontrado!');
        }

        $value = $vehicle->value;

        // Se não informar valor
        if ($value === null || $value === '') {
            $entry = Carbon::parse($vehicle->entry_time);
            $exit = Carbon::now();
            $hours = $entry->diffInHours($exit);

            if ($hours <= 1) {
                $value = 10;
            } else {
                $value = 10 + (($hours - 1) * 5);
            }
        }

        // Registrando saída
        $vehicle->exits_time = now()->format('H:i:s');
        $vehicle->value = $value;

        $vehicle->save();

        return redirect()
            ->back()
            ->with('success', 'Veículo finalizado!');
    }

    public function reports(Request $request)
    {
        $query = Vehicle::query();

        // Apenas finalizados
        $query->whereNotNull('exits_time');

        // Filtro data inicial
        if ($request->start_date) {
            $query->whereDate('day_entry', '>=', $request->start_date);
        }

        // Filtro data final
        if ($request->end_date) {
            $query->whereDate('day_entry', '<=', $request->end_date);
        }

        // Filtro tipo
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // Filtro placa
        if ($request->plate) {
            $query->where('plate', 'LIKE', "%{$request->plate}%");
        }

        $vehicles = $query
            ->join('users', 'vehicles.user_id', '=', 'users.id')
            ->select('vehicles.*', 'users.name as user_name')
            ->orderBy('created_at', 'desc')
            ->get();

        // Cards
        $totalVeiculos = $query->count();
        $totalValue = $query->sum('value');
        $visitCount = $query->where('type', 'visit')->count();
        $ecoCount = $query->where('type', 'eco')->count();
        $averageTicket = $totalVeiculos > 0 ? $totalValue / $totalVeiculos : 0;

        return view('pages.relatorios', compact(
            'vehicles',
            'totalVeiculos',
            'totalValue',
            'visitCount',
            'ecoCount',
            'averageTicket'
        ));
    }

    public function exportPdf(Request $request)
    {
        $vehicles = Vehicle::query();

        if ($request->start_date) {
            $vehicles->whereDate('day_entry', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $vehicles->whereDate('day_entry', '<=', $request->end_date);
        }

        if ($request->plate) {
            $vehicles->where('plate', 'like', '%' . $request->plate . '%');
        }

        if ($request->type) {
            $vehicles->where('type', $request->type);
        }

        $vehicles = $vehicles
            ->join('users', 'vehicles.user_id', '=', 'users.id')
            ->select('vehicles.*', 'users.name as user_name')
            ->get();

        $pdf = Pdf::loadView('pages.reports.pdf', compact('vehicles'));

        return $pdf->download('relatorio.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(
            new VehiclesExport,
            'relatorio.xlsx'
        );
    }
}
