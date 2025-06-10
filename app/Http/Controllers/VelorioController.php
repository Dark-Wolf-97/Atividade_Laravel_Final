<?php

namespace App\Http\Controllers;

use App\Models\Velorio;
use App\Models\Finado;
use App\Models\Urna;
use Illuminate\Http\Request;

class VelorioController extends Controller
{
    public function index()
    {
        $velorios = Velorio::with(['finado', 'urna'])->get();
        $finados = Finado::all();
        $urna = Urna::all();
        return view('velorio.index', compact('velorios', 'finados', 'urna'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'velorio_data' => 'required|date|after_or_equal:today',
            'finado_id' => 'required|exists:finados,id',
            'usuario_id' => 'required|integer',
            'urna_id' => 'required|exists:urna,id',
        ]);

        Velorio::create($request->all());
        return redirect()->route('velorio.index')->with('success', 'Velório criado com sucesso.');
    }

    public function update(Request $request, Velorio $velorio)
    {
        $request->validate([
            'velorio_data' => 'required|date',
            'finado_id' => 'required|exists:finados,id',
            'usuario_id' => 'required|integer',
            'urna_id' => 'required|exists:urna,id',
        ]);

        $velorio->update($request->all());
        return redirect()->route('velorio.index')->with('success', 'Velório atualizado com sucesso.');
    }

    public function destroy(Velorio $velorio)
    {
        $velorio->delete();
        return redirect()->route('velorio.index')->with('success', 'Velório excluído com sucesso.');
    }
}
