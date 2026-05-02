<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{

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

        // Tratando o valor para caso de inserção invalida
        $value = str_replace(',', '.', $request->value);

        // Validando se o valor é numérico
        if (!is_numeric($value)) {

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

        // Validação de hora'
        if (empty($request->entry_time)) {

            $vehicle->entry_time = now()->format('H:i:s');

        } else {

            $vehicle->entry_time = $request->entry_time;
        }

        // Salvando dados
        $vehicle->name = $request->name;
        $vehicle->plate = $plate;
        $vehicle->value = $value;
        $vehicle->type = $request->type;
        $vehicle->exits_time = $request->exits_time;

        $vehicle->save();

        return redirect()
            ->back()
            ->with('success', 'Veículo cadastrado!');
    }


    public function index()
    {

        $vehicles = Vehicle::whereDate('created_at', today())
            ->whereNull('exits_time')
            ->orderBy('entry_time', 'desc')
            ->get();

        return view('pages.veiculos', compact('vehicles'));
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

        $vehicle->save();

        return redirect()
            ->back()
            ->with('success', 'Veículo atualizado!');
    }


    public function exit($id)
    {

        $vehicle = Vehicle::find($id);

        if (!$vehicle) {

            return redirect()
                ->back()
                ->with('error', 'Veículo não encontrado!');
        }

        // Registrando saída
        $vehicle->exits_time = now()->format('H:i:s');

        $vehicle->save();

        return redirect()
            ->back()
            ->with('success', 'Veículo finalizado!');
    }


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
            ->take(5)
            ->get();

        return view('pages.dashboard', compact(
            'vehiclesToday',
            'visitToday',
            'ecoToday',
            'totalValue',
            'lastVehicles'
        ));
    }

}