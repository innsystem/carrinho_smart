<?php

namespace App\Http\Controllers;

use App\Models\Despesa;
use App\Models\DespesaItem;
use Illuminate\Http\Request;

class DespesaItemController extends Controller
{
    public function store(Request $request, Despesa $despesa)
    {
        // Verificar se a despesa pertence ao usuário
        if ($despesa->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'quantidade' => 'nullable|numeric|min:0.001',
            'preco_unitario' => 'nullable|numeric|min:0',
        ]);

        $item = $despesa->itens()->create([
            'nome' => $validated['nome'],
            'quantidade' => $validated['quantidade'] ?? 1,
            'preco_unitario' => $validated['preco_unitario'] ?? 0,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'item' => $item,
                'total' => $despesa->fresh()->total,
            ]);
        }

        return back()->with('success', 'Item adicionado!');
    }

    public function update(Request $request, Despesa $despesa, DespesaItem $item)
    {
        // Verificar se a despesa e o item pertencem ao usuário
        if ($despesa->user_id !== auth()->id() || $item->despesa_id !== $despesa->id) {
            abort(403);
        }

        $validated = $request->validate([
            'nome' => 'sometimes|string|max:255',
            'quantidade' => 'sometimes|numeric|min:0.001',
            'preco_unitario' => 'sometimes|numeric|min:0',
        ]);

        $item->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'item' => $item->fresh(),
                'total' => $despesa->fresh()->total,
            ]);
        }

        return back()->with('success', 'Item atualizado!');
    }

    public function destroy(Despesa $despesa, DespesaItem $item)
    {
        // Verificar se a despesa e o item pertencem ao usuário
        if ($despesa->user_id !== auth()->id() || $item->despesa_id !== $despesa->id) {
            abort(403);
        }

        $item->delete();

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'total' => $despesa->fresh()->total,
            ]);
        }

        return back()->with('success', 'Item removido!');
    }
}
