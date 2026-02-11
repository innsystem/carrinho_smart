<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DespesaItem extends Model
{
    use HasFactory;

    protected $fillable = ['despesa_id', 'nome', 'quantidade', 'preco_unitario', 'subtotal'];

    protected $casts = [
        'quantidade' => 'decimal:3',
        'preco_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2',
    ];

    // Relacionamento
    public function despesa()
    {
        return $this->belongsTo(Despesa::class);
    }

    // Calcular subtotal automaticamente ao salvar
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            $item->subtotal = $item->quantidade * $item->preco_unitario;
        });

        static::saved(function ($item) {
            $item->despesa->recalcularTotal();
        });

        static::deleted(function ($item) {
            $item->despesa->recalcularTotal();
        });
    }
}
