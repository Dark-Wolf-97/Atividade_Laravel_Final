<?php


namespace App\Http\Controllers;

use App\Models\Finado;
use Illuminate\Http\Request;

class FinadoController extends Controller
{
    public function index()
    {
        $finados = Finado::all();
        return view('finado.index', compact('finados'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'finado_nome' => 'required',
            'finado_certidao' => 'required',
        ]);

        Finado::create($request->all());
        return redirect()->route('finado.index')->with('success', 'Finado criado com sucesso.');
    }

    public function update(Request $request, Finado $finado)
    {
        $request->validate([
            'finado_nome' => 'required',
            'finado_certidao' => 'required',
        ]);

        $finado->update($request->all());
        return redirect()->route('finado.index')->with('success', 'Finado atualizado com sucesso.');
    }

    public function destroy(Finado $finado)
    {
        $finado->delete();
        return redirect()->route('finado.index')->with('success', 'Finado excluído com sucesso.');
    }
}