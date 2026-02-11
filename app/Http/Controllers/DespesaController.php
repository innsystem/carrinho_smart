<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DespesaController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        // Criar nova despesa com título padrão
        $titulo = 'Compras ' . Carbon::now()->locale('pt_BR')->isoFormat('MMM/YYYY');
        
        $despesa = Despesa::create([
            'user_id' => auth()->id(),
            'titulo' => $titulo,
            'total' => 0,
        ]);

        // Copiar itens da última despesa
        $ultimaDespesa = auth()->user()->despesas()
            ->where('id', '!=', $despesa->id)
            ->orderBy('created_at', 'desc')
            ->first();

        if ($ultimaDespesa) {
            foreach ($ultimaDespesa->itens as $item) {
                $despesa->itens()->create([
                    'nome' => $item->nome,
                    'quantidade' => $item->quantidade,
                    'preco_unitario' => 0, // Preço zerado, usuário preenche
                    'subtotal' => 0,
                ]);
            }
        }

        return redirect()->route('despesas.show', $despesa);
    }

    public function show(Despesa $despesa)
    {
        // Verificar se a despesa pertence ao usuário
        if ($despesa->user_id !== auth()->id()) {
            abort(403);
        }

        $despesa->load('itens');
        return view('despesas.show', compact('despesa'));
    }

    public function update(Request $request, Despesa $despesa)
    {
        // Verificar se a despesa pertence ao usuário
        if ($despesa->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'titulo' => 'sometimes|string|max:255',
            'data_compra' => 'sometimes|nullable|date',
        ]);

        $despesa->update($validated);

        return back()->with('success', 'Despesa atualizada!');
    }

    public function destroy(Despesa $despesa)
    {
        // Verificar se a despesa pertence ao usuário
        if ($despesa->user_id !== auth()->id()) {
            abort(403);
        }

        $despesa->delete();

        return redirect()->route('dashboard')->with('success', 'Despesa excluída!');
    }
}
