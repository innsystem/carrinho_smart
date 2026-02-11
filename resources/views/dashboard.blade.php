@extends('layouts.app')

@section('title', 'Minhas Despesas - Carrinho Smart')

@section('header-actions')
    <a href="{{ route('despesas.create') }}" class="btn btn-sm btn-success btn-touch" title="Nova despesa">
        ✚ Nova
    </a>
@endsection

@section('content')
<div class="mb-3">
    <h5 class="mb-0">Minhas Despesas</h5>
</div>

@if($despesas->count() > 0)
    @foreach($despesas as $despesa)
        <a href="{{ route('despesas.show', $despesa) }}" class="text-decoration-none">
            <div class="item-card d-flex justify-content-between align-items-center">
                <div>
                    <strong class="text-dark fs-6">{{ $despesa->titulo }}</strong>
                    <div>
                        <small class="text-muted">
                            @if($despesa->data_compra)
                                {{ $despesa->data_compra->format('d/m/Y') }}
                            @else
                                {{ $despesa->created_at->format('d/m/Y') }}
                            @endif
                            · {{ $despesa->itens->count() }} itens
                        </small>
                    </div>
                </div>
                <div class="text-end">
                    <span class="fs-5 fw-bold text-success">R$ {{ number_format($despesa->total, 2, ',', '.') }}</span>
                </div>
            </div>
        </a>
    @endforeach
@else
    <div class="text-center py-5">
        <div class="fs-1 mb-2">🛒</div>
        <h5 class="text-muted">Bem-vindo ao Carrinho Smart!</h5>
        <p class="text-muted mb-3">Você ainda não tem despesas.</p>
        <a href="{{ route('despesas.create') }}" class="btn btn-success btn-lg">
            ✚ Criar primeira despesa
        </a>
    </div>
@endif
@endsection
