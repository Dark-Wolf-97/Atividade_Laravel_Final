<?php

namespace App\Http\Controllers;

use App\Models\Urna;
use Illuminate\Http\Request;

class UrnaController extends Controller
{
    public function index()
    {
        $urnas = Urna::all();
        return view('urna.index', compact('urnas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'urna_nome' => 'required',
            'urna_tipo' => 'required',
            'urna_material' => 'required',
            'urna_preco' => 'required|numeric',
        ]);

        Urna::create($request->all());
        return redirect()->route('urna.index')->with('success', 'Urna criada com sucesso.');
    }

    public function update(Request $request, Urna $urna)
    {
        $request->validate([
            'urna_nome' => 'required',
            'urna_tipo' => 'required',
            'urna_material' => 'required',
            'urna_preco' => 'required|numeric',
        ]);

        $urna->update($request->all());
        return redirect()->route('urna.index')->with('success', 'Urna atualizada com sucesso.');
    }

    public function destroy(Urna $urna)
    {
        $urna->delete();
        return redirect()->route('urna.index')->with('success', 'Urna excluída com sucesso.');
    }
}
