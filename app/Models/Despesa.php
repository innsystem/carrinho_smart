<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'titulo', 'data_compra', 'total'];

    protected $casts = [
        'data_compra' => 'date',
        'total' => 'decimal:2',
    ];

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function itens()
    {
        return $this->hasMany(DespesaItem::class);
    }

    // Recalcular total
    public function recalcularTotal()
    {
        $this->total = $this->itens()->sum('subtotal');
        $this->save();
    }
}
