@extends('layouts.app')

@section('title', $despesa->titulo . ' - Carrinho Smart')

@section('header-actions')
    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary btn-touch" title="Voltar">
        ←
    </a>
    <button type="button" class="btn btn-sm btn-success btn-touch" onclick="abrirAdicionarProduto()" title="Adicionar produto">
        ✚
    </button>
@endsection

@section('content')
<div x-data="listaCompras()" x-init="init()">

    <!-- Info da despesa -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0">{{ $despesa->titulo }}</h5>
            <small class="text-muted">{{ $despesa->created_at->format('d/m/Y') }}</small>
        </div>
        <div>
            <span class="badge bg-primary badge-count fs-6">
                <span x-text="totalItens"></span> itens
            </span>
        </div>
    </div>

    <!-- Lista de itens -->
    <div id="lista-itens">
        @forelse($despesa->itens as $item)
            <div class="item-card" id="item-{{ $item->id }}">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <strong class="fs-6">{{ $item->nome }}</strong>
                    <button type="button" class="btn btn-sm btn-link text-danger p-0 btn-touch"
                            style="min-width:32px; min-height:32px;"
                            @click="removerItem({{ $item->id }}, '{{ addslashes($item->nome) }}')">
                        ✕
                    </button>
                </div>
                <div class="d-flex align-items-center justify-content-between gap-2">
                    <!-- Quantidade -->
                    <div class="d-flex align-items-center gap-1">
                        <button class="btn btn-outline-danger btn-qty" type="button"
                                @click="diminuirQtd({{ $item->id }})">−</button>
                        <input type="number"
                               class="qty-input"
                               x-bind:value="itens[{{ $item->id }}]?.quantidade"
                               @change="atualizarItem({{ $item->id }}, 'quantidade', parseFloat($event.target.value) || 1)"
                               min="0.5" step="1"
                               inputmode="numeric">
                        <button class="btn btn-outline-success btn-qty" type="button"
                                @click="aumentarQtd({{ $item->id }})">+</button>
                    </div>

                    <!-- Preço -->
                    <div class="input-group" style="max-width: 140px;">
                        <span class="input-group-text px-2" style="font-size:0.85rem;">R$</span>
                        <input type="text"
                               class="form-control preco-input"
                               inputmode="decimal"
                               x-bind:value="formatarPrecoInput({{ $item->id }})"
                               @focus="$event.target.select()"
                               @blur="atualizarPreco({{ $item->id }}, $event.target.value)"
                               @input="mascaraPrecoEl($event.target)"
                               placeholder="0.00">
                    </div>
                </div>

                <!-- Subtotal -->
                <div class="text-end mt-2">
                    <small class="text-muted">
                        Subtotal: <strong class="text-dark">R$ <span x-text="formatarMoeda(calcularSubtotal({{ $item->id }}))"></span></strong>
                    </small>
                </div>
            </div>
        @empty
            <div class="text-center py-5" id="empty-state">
                <div class="fs-1 mb-2">📝</div>
                <h5 class="text-muted">Lista vazia</h5>
                <p class="text-muted mb-3">Toque no botão <strong class="text-success">✚</strong> no topo para adicionar produtos.</p>
            </div>
        @endforelse
    </div>

    <!-- Excluir despesa -->
    <div class="text-center mt-4 mb-3">
        <button type="button" class="btn btn-sm btn-outline-danger"
                onclick="excluirDespesa()">
            🗑️ Excluir esta despesa
        </button>
    </div>

    <form id="delete-form" action="{{ route('despesas.destroy', $despesa) }}" method="POST" class="d-none">
        @csrf
        @method('DELETE')
    </form>

    <!-- Rodapé fixo com total -->
    <div class="total-footer">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <small class="text-muted d-block" style="line-height:1;">Total</small>
                    <span class="fs-4 fw-bold text-success">
                        R$ <span x-text="formatarMoeda(total)"></span>
                    </span>
                </div>
                <div>
                    <span class="badge bg-secondary"><span x-text="totalItens"></span> itens</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// === SWEETALERT: Adicionar Produto ===
function abrirAdicionarProduto() {
    Swal.fire({
        title: 'Adicionar Produto',
        html:
            '<div class="mb-3">' +
                '<label class="form-label text-start d-block fw-bold">Produto</label>' +
                '<input id="swal-nome" class="swal2-input w-100 m-0" placeholder="Ex: Arroz, Feijão..." autocomplete="off">' +
            '</div>' +
            '<div class="d-flex gap-2">' +
                '<div class="flex-fill">' +
                    '<label class="form-label text-start d-block fw-bold">Qtd</label>' +
                    '<input id="swal-qtd" type="number" class="swal2-input w-100 m-0" value="1" min="0.5" step="1" inputmode="numeric">' +
                '</div>' +
                '<div class="flex-fill">' +
                    '<label class="form-label text-start d-block fw-bold">Preço (R$)</label>' +
                    '<input id="swal-preco" type="text" class="swal2-input w-100 m-0" placeholder="0.00" inputmode="decimal"' +
                    ' oninput="mascaraPreco(this)">' +
                '</div>' +
            '</div>',
        showCancelButton: true,
        confirmButtonText: 'Adicionar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#198754',
        focusConfirm: false,
        didOpen: () => {
            document.getElementById('swal-nome').focus();
        },
        preConfirm: () => {
            const nome = document.getElementById('swal-nome').value.trim();
            if (!nome) {
                Swal.showValidationMessage('Digite o nome do produto');
                return false;
            }
            return {
                nome: nome,
                quantidade: parseFloat(document.getElementById('swal-qtd').value) || 1,
                preco_unitario: parseFloat(document.getElementById('swal-preco').value) || 0
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            enviarNovoProduto(result.value);
        }
    });
}

async function enviarNovoProduto(dados) {
    try {
        const response = await fetch(`/despesas/{{ $despesa->id }}/itens`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json'
            },
            body: JSON.stringify(dados)
        });

        if (response.ok) {
            const data = await response.json();
            Swal.fire({
                icon: 'success',
                title: 'Adicionado!',
                text: dados.nome + ' foi adicionado à lista.',
                timer: 1200,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
            window.location.reload();
        } else {
            Swal.fire('Erro', 'Não foi possível adicionar o produto.', 'error');
        }
    } catch (error) {
        Swal.fire('Erro', 'Falha na conexão.', 'error');
    }
}

// === SWEETALERT: Excluir Despesa ===
function excluirDespesa() {
    Swal.fire({
        title: 'Excluir despesa?',
        text: 'Todos os itens serão removidos. Isso não pode ser desfeito.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form').submit();
        }
    });
}

// === ALPINE.JS: Lista de Compras ===
function listaCompras() {
    return {
        itens: {},
        total: 0,

        get totalItens() {
            return Object.keys(this.itens).length;
        },

        init() {
            @foreach($despesa->itens as $item)
                this.itens[{{ $item->id }}] = {
                    id: {{ $item->id }},
                    nome: @json($item->nome),
                    quantidade: {{ $item->quantidade + 0 }},
                    preco_unitario: {{ $item->preco_unitario + 0 }},
                    subtotal: {{ $item->subtotal + 0 }}
                };
            @endforeach
            this.calcularTotal();
        },

        calcularSubtotal(itemId) {
            if (!this.itens[itemId]) return 0;
            return (parseFloat(this.itens[itemId].quantidade) || 0) * (parseFloat(this.itens[itemId].preco_unitario) || 0);
        },

        calcularTotal() {
            this.total = Object.values(this.itens).reduce((sum, item) => {
                return sum + (parseFloat(item.quantidade) || 0) * (parseFloat(item.preco_unitario) || 0);
            }, 0);
        },

        formatarMoeda(valor) {
            return parseFloat(valor || 0).toFixed(2).replace('.', ',');
        },

        formatarPrecoInput(itemId) {
            if (!this.itens[itemId]) return '0.00';
            return parseFloat(this.itens[itemId].preco_unitario || 0).toFixed(2);
        },

        mascaraPrecoEl(el) {
            let v = el.value.replace(/[^\d]/g, '');
            if (v === '') { el.value = ''; return; }
            v = (parseInt(v) / 100).toFixed(2);
            el.value = v;
        },

        atualizarPreco(itemId, valorStr) {
            const valor = parseFloat(valorStr) || 0;
            this.itens[itemId].preco_unitario = valor;
            this.calcularTotal();
            this.salvarItem(itemId, 'preco_unitario', valor);
        },

        async salvarItem(itemId, campo, valor) {
            try {
                const response = await fetch(`/despesas/{{ $despesa->id }}/itens/${itemId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ [campo]: valor })
                });
                if (response.ok) {
                    const data = await response.json();
                    if (data.item) {
                        this.itens[itemId].quantidade = parseFloat(data.item.quantidade);
                        this.itens[itemId].preco_unitario = parseFloat(data.item.preco_unitario);
                        this.itens[itemId].subtotal = parseFloat(data.item.subtotal);
                    }
                    this.calcularTotal();
                }
            } catch (error) {
                console.error('Erro ao salvar:', error);
            }
        },

        async atualizarItem(itemId, campo, valor) {
            this.itens[itemId][campo] = valor;
            this.calcularTotal();
            await this.salvarItem(itemId, campo, valor);
        },

        async aumentarQtd(itemId) {
            const novaQtd = (parseFloat(this.itens[itemId].quantidade) || 0) + 1;
            this.itens[itemId].quantidade = novaQtd;
            this.calcularTotal();
            // Atualiza o input de quantidade visualmente
            const el = document.querySelector(`#item-${itemId} .qty-input`);
            if (el) el.value = novaQtd;
            await this.salvarItem(itemId, 'quantidade', novaQtd);
            if (navigator.vibrate) navigator.vibrate(30);
        },

        async diminuirQtd(itemId) {
            const novaQtd = Math.max(0.5, (parseFloat(this.itens[itemId].quantidade) || 0) - 1);
            this.itens[itemId].quantidade = novaQtd;
            this.calcularTotal();
            const el = document.querySelector(`#item-${itemId} .qty-input`);
            if (el) el.value = novaQtd;
            await this.salvarItem(itemId, 'quantidade', novaQtd);
            if (navigator.vibrate) navigator.vibrate(30);
        },

        async removerItem(itemId, nome) {
            const result = await Swal.fire({
                title: 'Remover item?',
                text: `Remover "${nome}" da lista?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Remover',
                cancelButtonText: 'Cancelar'
            });

            if (!result.isConfirmed) return;

            try {
                const response = await fetch(`/despesas/{{ $despesa->id }}/itens/${itemId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });

                if (response.ok) {
                    // Animação de saída
                    const el = document.getElementById(`item-${itemId}`);
                    if (el) {
                        el.classList.add('item-removing');
                        setTimeout(() => el.remove(), 300);
                    }
                    delete this.itens[itemId];
                    this.calcularTotal();

                    Swal.fire({
                        icon: 'success',
                        title: 'Removido!',
                        timer: 800,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                }
            } catch (error) {
                Swal.fire('Erro', 'Falha ao remover item.', 'error');
            }
        }
    };
}
</script>
@endpush
@endsection
