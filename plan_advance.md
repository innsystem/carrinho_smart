# CARRINHO SMART

## Micro SaaS para Controle de Despesas de Supermercado

**Documentação Técnica Completa — Versão 1.0**
**Stack: Laravel 11 + Alpine.js + Bootstrap 5 (PWA Mobile-First)**

---

## ÍNDICE

1. [Visão Geral do Produto](#1-visão-geral-do-produto)
2. [Diferencial: Catálogo Pré-carregado](#2-diferencial-catálogo-pré-carregado)
3. [Jornada do Usuário (Fluxo Prático)](#3-jornada-do-usuário)
4. [Modelo de Negócio (SaaS)](#4-modelo-de-negócio-saas)
5. [Arquitetura Multi-Tenant](#5-arquitetura-multi-tenant)
6. [Estrutura do Banco de Dados](#6-estrutura-do-banco-de-dados)
7. [Catálogo de Produtos Padrão (Seed)](#7-catálogo-de-produtos-padrão-seed)
8. [Models e Relacionamentos](#8-models-e-relacionamentos)
9. [Controllers e Lógica de Negócio](#9-controllers-e-lógica-de-negócio)
10. [Rotas e Middleware](#10-rotas-e-middleware)
11. [Frontend — Views e UX](#11-frontend-views-e-ux)
12. [PWA e Modo Offline](#12-pwa-e-modo-offline)
13. [Instalação e Deploy](#13-instalação-e-deploy)
14. [Roadmap e Cronograma](#14-roadmap-e-cronograma)
15. [Projeções Financeiras](#15-projeções-financeiras)

---

## 1. VISÃO GERAL DO PRODUTO

### 1.1 O que é o Carrinho Smart?

Carrinho Smart é um **Micro SaaS mobile-first** que transforma a experiência de compras no supermercado. O sistema já vem com uma **lista completa de produtos comuns** organizados por categoria. O usuário **não precisa digitar nada** — basta abrir a despesa do mês, marcar os itens que precisa, ajustar quantidade e preço, e acompanhar o total em tempo real.

### 1.2 Proposta de Valor

- **Lista pronta**: +150 produtos pré-cadastrados por categoria (carnes, frutas, limpeza, etc.)
- **Zero digitação**: Marque os itens, ajuste quantidade e preço — pronto
- **Controle em tempo real**: Veja o total atualizar conforme adiciona itens no carrinho
- **Orçamento protegido**: Alerta visual quando se aproxima ou ultrapassa o limite
- **Lista inteligente**: Reutilize automaticamente os itens do mês anterior
- **Funciona no mercado**: PWA instalável, interface rápida e otimizada para celular

### 1.3 Público-Alvo

- Famílias que fazem compras mensais no supermercado
- Pessoas que precisam controlar orçamento doméstico
- Quem quer parar de estourar o limite no mercado
- Usuários que valorizam praticidade (abrir e já usar)

### 1.4 Problema que Resolve

| Problema Atual | Solução Carrinho Smart |
|---|---|
| Digitar cada produto na lista é tedioso | Produtos já vêm cadastrados, só marcar |
| Não sabe quanto está gastando no mercado | Total atualiza em tempo real |
| Estoura o orçamento todo mês | Alerta de orçamento com barra visual |
| Começa lista do zero todo mês | Reutiliza lista do mês anterior |
| Apps genéricos são complicados | Interface simples e focada em supermercado |

---

## 2. DIFERENCIAL: CATÁLOGO PRÉ-CARREGADO

### 2.1 Conceito

Ao criar conta, o usuário recebe um **catálogo pessoal** com +150 produtos comuns de supermercado, organizados em **12 categorias**. Ele nunca parte do zero.

### 2.2 Categorias e Produtos (Seed Inicial)

#### CARNES E PROTEÍNAS
| Produto | Unidade Padrão |
|---|---|
| Carne moída | kg |
| Peito de frango | kg |
| Coxa e sobrecoxa | kg |
| Linguiça toscana | kg |
| Carne de charque | kg |
| Bisteca suína | kg |
| Costela bovina | kg |
| Filé de tilápia | kg |
| Ovos (dúzia) | dz |
| Salsicha | pct |
| Presunto fatiado | kg |
| Mortadela | kg |
| Bacon | pct |

#### FRUTAS E VERDURAS
| Produto | Unidade Padrão |
|---|---|
| Banana | kg |
| Maçã | kg |
| Laranja | kg |
| Limão | kg |
| Tomate | kg |
| Cebola | kg |
| Alho | un |
| Batata | kg |
| Cenoura | kg |
| Alface | un |
| Cheiro verde | maço |
| Pimentão | kg |
| Mandioca | kg |

#### MERCEARIA / BÁSICOS
| Produto | Unidade Padrão |
|---|---|
| Arroz 5kg | pct |
| Feijão 1kg | pct |
| Macarrão espaguete | pct |
| Macarrão parafuso | pct |
| Farinha de trigo 1kg | pct |
| Farinha de mandioca | pct |
| Açúcar 1kg | pct |
| Sal 1kg | pct |
| Óleo de soja | un |
| Azeite de oliva | un |
| Vinagre | un |
| Molho de tomate | un |
| Extrato de tomate | un |
| Milho em conserva | un |
| Ervilha em conserva | un |
| Sardinha em lata | un |
| Atum em lata | un |

#### LATICÍNIOS
| Produto | Unidade Padrão |
|---|---|
| Leite integral (litro) | un |
| Leite em pó | pct |
| Queijo mussarela | kg |
| Queijo prato | kg |
| Requeijão | un |
| Manteiga | un |
| Margarina | un |
| Iogurte natural | un |
| Creme de leite | un |
| Leite condensado | un |

#### PADARIA E FRIOS
| Produto | Unidade Padrão |
|---|---|
| Pão francês | kg |
| Pão de forma | pct |
| Bisnaguinha | pct |
| Bolo pronto | un |
| Torrada | pct |

#### BEBIDAS
| Produto | Unidade Padrão |
|---|---|
| Água mineral 1,5L | un |
| Refrigerante 2L | un |
| Suco de caixinha | un |
| Café 500g | pct |
| Chá (caixa) | cx |
| Achocolatado em pó | un |
| Cerveja (lata) | un |

#### LIMPEZA
| Produto | Unidade Padrão |
|---|---|
| Detergente | un |
| Sabão em pó | pct |
| Amaciante | un |
| Água sanitária | un |
| Desinfetante | un |
| Sabão em barra | pct |
| Esponja de limpeza | pct |
| Saco de lixo | pct |
| Papel toalha | pct |
| Lustra-móveis | un |
| Limpador multiuso | un |

#### HIGIENE PESSOAL
| Produto | Unidade Padrão |
|---|---|
| Papel higiênico | pct |
| Sabonete | un |
| Shampoo | un |
| Condicionador | un |
| Creme dental | un |
| Escova de dente | un |
| Desodorante | un |
| Absorvente | pct |
| Algodão | pct |
| Cotonete | cx |

#### CONGELADOS
| Produto | Unidade Padrão |
|---|---|
| Pizza congelada | un |
| Hambúrguer congelado | cx |
| Nuggets | cx |
| Sorvete | un |
| Polpa de fruta | pct |
| Legumes congelados | pct |

#### TEMPEROS E CONDIMENTOS
| Produto | Unidade Padrão |
|---|---|
| Alho em pó | un |
| Caldo de galinha | cx |
| Colorau | un |
| Cominho | un |
| Orégano | un |
| Pimenta do reino | un |
| Shoyu | un |
| Maionese | un |
| Ketchup | un |
| Mostarda | un |

#### BISCOITOS E SNACKS
| Produto | Unidade Padrão |
|---|---|
| Biscoito cream cracker | pct |
| Biscoito recheado | pct |
| Biscoito maisena | pct |
| Salgadinho | pct |
| Pipoca de micro-ondas | un |
| Barra de cereal | cx |
| Chocolate | un |

#### PARA BEBÊS (opcional)
| Produto | Unidade Padrão |
|---|---|
| Fralda descartável | pct |
| Lenço umedecido | pct |
| Papinha | un |
| Fórmula infantil | un |

### 2.3 Como Funciona na Prática

1. **Primeiro acesso**: Sistema copia o catálogo padrão para o usuário
2. **Personalização**: Usuário pode adicionar, remover ou editar produtos do SEU catálogo
3. **Criar despesa**: Ao abrir uma nova despesa mensal, vê TODOS os seus produtos organizados por categoria
4. **Marcar itens**: Toca no produto para ativá-lo na lista daquele mês
5. **Ajustar**: Define quantidade e preço de cada item marcado
6. **Total em tempo real**: O valor total e a barra de orçamento atualizam instantaneamente

---

## 3. JORNADA DO USUÁRIO

### 3.1 Fluxo Principal (No Supermercado)

```
[Abrir App] → [Selecionar Despesa do Mês] → [Ver Produtos por Categoria]
     ↓                                              ↓
[Marcar Itens] → [Informar Qtd + Preço] → [Ver Total em Tempo Real]
     ↓                                              ↓
[Barra de Orçamento Atualiza] ← ← ← ← ← ← ← ← ← ←
     ↓
[Finalizar Compra] → [Salvar Histórico]
```

### 3.2 Telas Principais

| Tela | Descrição | Ação Principal |
|---|---|---|
| **Login/Registro** | Cadastro rápido (email + senha) | Entrar no app |
| **Dashboard** | Lista de despesas mensais + resumo | Ver gastos do mês |
| **Nova Despesa** | Definir mês e orçamento | Criar despesa |
| **Lista de Compras** | Produtos por categoria com checkbox | Marcar itens + qty + preço |
| **Resumo** | Total, economia, itens comprados | Finalizar compra |
| **Histórico** | Meses anteriores com comparativo | Reutilizar lista |
| **Meu Catálogo** | Gerenciar produtos pessoais | Adicionar/remover produtos |
| **Perfil/Plano** | Dados pessoais e assinatura | Upgrade de plano |

### 3.3 UX na Tela de Compras (Tela Principal)

```
┌─────────────────────────────────┐
│  Despesa: Janeiro/2026          │
│  Orçamento: R$ 800,00           │
│  ████████████░░░░  R$ 547,30    │  ← Barra de progresso (verde/amarelo/vermelho)
│  68% do orçamento               │
├─────────────────────────────────┤
│  🔍 Buscar produto...           │  ← Campo de busca rápida
├─────────────────────────────────┤
│  ▼ CARNES E PROTEÍNAS    (5)   │  ← Categoria colapsável + contagem
│  ┌─────────────────────────────┐│
│  │ ☑ Peito de frango           ││
│  │   2 kg × R$ 14,99 = 29,98  ││  ← Item marcado com qty e preço
│  │ ☑ Carne moída               ││
│  │   1 kg × R$ 32,00 = 32,00  ││
│  │ ☐ Linguiça toscana          ││  ← Item disponível mas não marcado
│  │ ☐ Costela bovina            ││
│  │ ...                         ││
│  └─────────────────────────────┘│
│  ▶ FRUTAS E VERDURAS     (3)   │  ← Colapsado por padrão
│  ▶ MERCEARIA / BÁSICOS   (8)   │
│  ▶ LATICÍNIOS            (4)   │
│  ...                            │
├─────────────────────────────────┤
│  📦 Itens: 23  │  💰 R$ 547,30 │  ← Rodapé fixo com totais
│  [Finalizar Compra]             │
└─────────────────────────────────┘
```

### 3.4 Interação do Item (Alpine.js)

Ao tocar em um produto:
1. **Checkbox marca/desmarca** o item
2. Se marcado, **expande campos** de quantidade e preço inline
3. **Quantidade**: Input numérico com botões +/- (padrão: 1)
4. **Preço**: Input monetário (se comprou antes, mostra último preço como sugestão)
5. **Subtotal**: Calcula e exibe `qty × preço` automaticamente
6. **Total geral**: Atualiza no rodapé fixo instantaneamente

---

## 4. MODELO DE NEGÓCIO (SaaS)

### 4.1 Planos de Assinatura

| Recurso | FREE | PREMIUM | PRO |
|---|---|---|---|
| **Preço/mês** | Grátis | R$ 9,90 | R$ 19,90 |
| **Despesas/mês** | 1 | 5 | Ilimitado |
| **Produtos no catálogo** | 50 | 200 | Ilimitado |
| **Produtos por despesa** | 30 | 100 | Ilimitado |
| **Histórico** | 3 meses | 12 meses | Ilimitado |
| **Reutilizar lista anterior** | ❌ | ✅ | ✅ |
| **Sugestão de último preço** | ❌ | ✅ | ✅ |
| **Comparativo entre meses** | ❌ | ✅ | ✅ |
| **Gráficos de gastos** | ❌ | ❌ | ✅ |
| **Exportar para PDF** | ❌ | ❌ | ✅ |
| **Produtos personalizados** | Até 10 | Até 50 | Ilimitado |

### 4.2 Estratégia de Monetização

- **Modelo Freemium**: Plano gratuito funcional para atrair e reter
- **Gatilho de upsell**: Limite de 1 despesa/mês e 50 produtos força upgrade natural
- **Conversão esperada**: 8-12% free → premium, 3-5% premium → pro
- **Churn estimado**: ~5% mensal no premium

### 4.3 Custos Operacionais (estimativa)

| Item | Custo Mensal |
|---|---|
| Hospedagem (VPS) | R$ 50-100 |
| Domínio | ~R$ 5 |
| SSL | Grátis (Let's Encrypt) |
| Email transacional | R$ 0-30 |
| **Total** | **~R$ 85-135** |

---

## 5. ARQUITETURA MULTI-TENANT

### 5.1 Estratégia de Isolamento

**Row-level isolation** — Cada registro no banco possui `user_id`. Todo acesso é filtrado automaticamente via Global Scopes do Laravel.

### 5.2 Camadas de Segurança

| Camada | Implementação |
|---|---|
| Autenticação | Laravel Sanctum (token + cookie) |
| Autorização | Policies por recurso |
| Isolamento de dados | Global Scope `user_id` em todos os models |
| Proteção CSRF | Token em todos os formulários |
| Rate Limiting | Throttle no login e API |
| Validação | Form Requests em todos os endpoints |

---

## 6. ESTRUTURA DO BANCO DE DADOS

### 6.1 Diagrama de Relacionamentos

```
users (1) ──── (N) categorias_usuario
  │                      │
  │                      └──── (N) catalogo_produtos
  │
  └──── (N) despesas (1) ──── (N) despesa_items
                                      │
                                      └──── (1) catalogo_produtos
```

### 6.2 Tabela: `users`

| Campo | Tipo | Nulo | Descrição |
|---|---|---|---|
| id | bigIncrements | Não | PK |
| name | string(255) | Não | Nome completo |
| email | string(255) | Não | Email único (login) |
| password | string | Não | Hash bcrypt |
| plan | enum('free','premium','pro') | Não | Plano atual (default: free) |
| plan_expires_at | timestamp | Sim | Data de expiração do plano |
| timestamps | — | — | created_at, updated_at |

### 6.3 Tabela: `categorias` (seed global, somente leitura)

| Campo | Tipo | Nulo | Descrição |
|---|---|---|---|
| id | bigIncrements | Não | PK |
| nome | string(100) | Não | Nome da categoria |
| icone | string(50) | Sim | Emoji ou classe de ícone |
| ordem | integer | Não | Ordem de exibição |
| timestamps | — | — | created_at, updated_at |

### 6.4 Tabela: `catalogo_produtos` (catálogo pessoal do usuário)

| Campo | Tipo | Nulo | Descrição |
|---|---|---|---|
| id | bigIncrements | Não | PK |
| user_id | unsignedBigInteger | Não | FK users — ISOLAMENTO |
| categoria_id | unsignedBigInteger | Não | FK categorias |
| nome | string(255) | Não | Nome do produto |
| unidade | string(20) | Não | kg, un, pct, lt, dz, cx, maço |
| ativo | boolean | Não | Se aparece na lista (default: true) |
| ordem | integer | Sim | Ordem dentro da categoria |
| timestamps | — | — | created_at, updated_at |

> **Unique constraint**: `user_id` + `nome` (evita duplicatas)

### 6.5 Tabela: `despesas`

| Campo | Tipo | Nulo | Descrição |
|---|---|---|---|
| id | bigIncrements | Não | PK |
| user_id | unsignedBigInteger | Não | FK users — ISOLAMENTO |
| mes_referencia | date | Não | Mês/Ano no formato YYYY-MM-01 |
| data_compra | date | Sim | Data efetiva da compra |
| orcamento | decimal(10,2) | Sim | Valor do orçamento para o mês |
| observacao | text | Sim | Notas livres |
| status | enum('rascunho','em_andamento','finalizada') | Não | Status da despesa |
| timestamps | — | — | created_at, updated_at |

> **Unique constraint**: `user_id` + `mes_referencia` (uma despesa por mês por padrão, premium pode ter mais)

### 6.6 Tabela: `despesa_items` (itens marcados na despesa)

| Campo | Tipo | Nulo | Descrição |
|---|---|---|---|
| id | bigIncrements | Não | PK |
| despesa_id | unsignedBigInteger | Não | FK despesas |
| catalogo_produto_id | unsignedBigInteger | Não | FK catalogo_produtos |
| quantidade | decimal(8,3) | Não | Quantidade comprada |
| preco_unitario | decimal(10,2) | Não | Preço unitário |
| subtotal | decimal(10,2) | Não | quantidade × preco_unitario (computed) |
| comprado | boolean | Não | Se já foi pego no mercado (default: false) |
| timestamps | — | — | created_at, updated_at |

> **Unique constraint**: `despesa_id` + `catalogo_produto_id` (um produto por despesa)

### 6.7 Tabela: `produtos_seed` (catálogo global para copiar ao novo usuário)

| Campo | Tipo | Nulo | Descrição |
|---|---|---|---|
| id | bigIncrements | Não | PK |
| categoria_id | unsignedBigInteger | Não | FK categorias |
| nome | string(255) | Não | Nome do produto |
| unidade | string(20) | Não | Unidade padrão |
| ordem | integer | Sim | Ordem de exibição |
| timestamps | — | — | created_at, updated_at |

---

## 7. CATÁLOGO DE PRODUTOS PADRÃO (SEED)

### 7.1 Seeder de Categorias

```php
// database/seeders/CategoriaSeeder.php
$categorias = [
    ['nome' => 'Carnes e Proteínas',     'icone' => '🥩', 'ordem' => 1],
    ['nome' => 'Frutas e Verduras',       'icone' => '🥬', 'ordem' => 2],
    ['nome' => 'Mercearia / Básicos',     'icone' => '🛒', 'ordem' => 3],
    ['nome' => 'Laticínios',              'icone' => '🧀', 'ordem' => 4],
    ['nome' => 'Padaria e Frios',         'icone' => '🍞', 'ordem' => 5],
    ['nome' => 'Bebidas',                 'icone' => '🥤', 'ordem' => 6],
    ['nome' => 'Limpeza',                 'icone' => '🧹', 'ordem' => 7],
    ['nome' => 'Higiene Pessoal',         'icone' => '🧴', 'ordem' => 8],
    ['nome' => 'Congelados',              'icone' => '🧊', 'ordem' => 9],
    ['nome' => 'Temperos e Condimentos',  'icone' => '🌶️', 'ordem' => 10],
    ['nome' => 'Biscoitos e Snacks',      'icone' => '🍪', 'ordem' => 11],
    ['nome' => 'Para Bebês',              'icone' => '🍼', 'ordem' => 12],
];
```

### 7.2 Lógica de Cópia para Novo Usuário

```php
// app/Services/CatalogoService.php

class CatalogoService
{
    /**
     * Copia o catálogo padrão para um novo usuário.
     * Chamado automaticamente após o registro.
     */
    public function copiarCatalogoParaUsuario(User $user): void
    {
        $produtosSeed = ProdutoSeed::with('categoria')->get();

        $catalogo = $produtosSeed->map(fn($produto) => [
            'user_id'       => $user->id,
            'categoria_id'  => $produto->categoria_id,
            'nome'          => $produto->nome,
            'unidade'       => $produto->unidade,
            'ativo'         => true,
            'ordem'         => $produto->ordem,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        // Insert em batch para performance
        CatalogoProduto::insert($catalogo->toArray());
    }
}
```

### 7.3 Lógica de "Lista Inteligente" (Reutilizar Mês Anterior)

```php
// app/Services/DespesaService.php

/**
 * Cria nova despesa copiando itens do mês anterior.
 * Disponível para planos Premium e Pro.
 */
public function criarDespesaComHistorico(User $user, string $mesReferencia, ?float $orcamento): Despesa
{
    $despesa = Despesa::create([
        'user_id'        => $user->id,
        'mes_referencia'  => $mesReferencia,
        'orcamento'      => $orcamento,
        'status'         => 'rascunho',
    ]);

    // Buscar última despesa finalizada
    $ultimaDespesa = Despesa::where('user_id', $user->id)
        ->where('status', 'finalizada')
        ->where('mes_referencia', '<', $mesReferencia)
        ->orderBy('mes_referencia', 'desc')
        ->first();

    if ($ultimaDespesa) {
        $itensAnteriores = $ultimaDespesa->items()->get();

        $novosItens = $itensAnteriores->map(fn($item) => [
            'despesa_id'          => $despesa->id,
            'catalogo_produto_id' => $item->catalogo_produto_id,
            'quantidade'          => $item->quantidade,
            'preco_unitario'      => $item->preco_unitario, // Último preço como sugestão
            'subtotal'            => $item->subtotal,
            'comprado'            => false,
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        DespesaItem::insert($novosItens->toArray());
    }

    return $despesa;
}
```

---

## 8. MODELS E RELACIONAMENTOS

### 8.1 User

```php
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'plan', 'plan_expires_at'];
    protected $hidden = ['password', 'remember_token'];
    protected $casts = ['plan_expires_at' => 'datetime'];

    // Relacionamentos
    public function despesas() { return $this->hasMany(Despesa::class); }
    public function catalogoProdutos() { return $this->hasMany(CatalogoProduto::class); }

    // Helpers de plano
    public function isPremium(): bool { return in_array($this->plan, ['premium', 'pro']); }
    public function isPro(): bool { return $this->plan === 'pro'; }

    // Limites por plano
    public function limiteDespesasMes(): int
    {
        return match($this->plan) {
            'free' => 1,
            'premium' => 5,
            'pro' => PHP_INT_MAX,
        };
    }

    public function limiteProdutosCatalogo(): int
    {
        return match($this->plan) {
            'free' => 50,
            'premium' => 200,
            'pro' => PHP_INT_MAX,
        };
    }

    public function limiteProdutosPorDespesa(): int
    {
        return match($this->plan) {
            'free' => 30,
            'premium' => 100,
            'pro' => PHP_INT_MAX,
        };
    }
}
```

### 8.2 Categoria

```php
class Categoria extends Model
{
    protected $fillable = ['nome', 'icone', 'ordem'];

    public function produtosSeed() { return $this->hasMany(ProdutoSeed::class); }
    public function catalogoProdutos() { return $this->hasMany(CatalogoProduto::class); }
}
```

### 8.3 CatalogoProduto

```php
class CatalogoProduto extends Model
{
    protected $table = 'catalogo_produtos';
    protected $fillable = ['user_id', 'categoria_id', 'nome', 'unidade', 'ativo', 'ordem'];
    protected $casts = ['ativo' => 'boolean'];

    // Global Scope — isolamento por usuário
    protected static function booted()
    {
        static::addGlobalScope('user', function ($query) {
            if (auth()->check()) {
                $query->where('user_id', auth()->id());
            }
        });
    }

    public function user() { return $this->belongsTo(User::class); }
    public function categoria() { return $this->belongsTo(Categoria::class); }
    public function despesaItems() { return $this->hasMany(DespesaItem::class); }

    // Último preço pago neste produto
    public function ultimoPreco(): ?float
    {
        return $this->despesaItems()
            ->whereHas('despesa', fn($q) => $q->where('status', 'finalizada'))
            ->orderByDesc('created_at')
            ->value('preco_unitario');
    }
}
```

### 8.4 Despesa

```php
class Despesa extends Model
{
    protected $fillable = ['user_id', 'mes_referencia', 'data_compra', 'orcamento', 'observacao', 'status'];
    protected $casts = ['mes_referencia' => 'date', 'data_compra' => 'date', 'orcamento' => 'decimal:2'];

    protected static function booted()
    {
        static::addGlobalScope('user', function ($query) {
            if (auth()->check()) {
                $query->where('user_id', auth()->id());
            }
        });
    }

    public function user() { return $this->belongsTo(User::class); }
    public function items() { return $this->hasMany(DespesaItem::class); }

    // Total da despesa
    public function getTotal(): float
    {
        return $this->items()->sum('subtotal');
    }

    // Porcentagem do orçamento usado
    public function getPorcentagemOrcamento(): float
    {
        if (!$this->orcamento || $this->orcamento == 0) return 0;
        return round(($this->getTotal() / $this->orcamento) * 100, 1);
    }

    // Cor da barra de progresso
    public function getCorOrcamento(): string
    {
        $pct = $this->getPorcentagemOrcamento();
        if ($pct < 70) return 'success';    // Verde
        if ($pct < 90) return 'warning';    // Amarelo
        return 'danger';                     // Vermelho
    }
}
```

### 8.5 DespesaItem

```php
class DespesaItem extends Model
{
    protected $table = 'despesa_items';
    protected $fillable = ['despesa_id', 'catalogo_produto_id', 'quantidade', 'preco_unitario', 'subtotal', 'comprado'];
    protected $casts = ['quantidade' => 'decimal:3', 'preco_unitario' => 'decimal:2', 'subtotal' => 'decimal:2', 'comprado' => 'boolean'];

    public function despesa() { return $this->belongsTo(Despesa::class); }
    public function catalogoProduto() { return $this->belongsTo(CatalogoProduto::class); }

    // Recalcula subtotal automaticamente
    protected static function booted()
    {
        static::saving(function ($item) {
            $item->subtotal = $item->quantidade * $item->preco_unitario;
        });
    }
}
```

---

## 9. CONTROLLERS E LÓGICA DE NEGÓCIO

### 9.1 Estrutura de Controllers

| Controller | Responsabilidade |
|---|---|
| `AuthController` | Registro, login, logout |
| `DashboardController` | Tela principal com resumo |
| `DespesaController` | CRUD de despesas mensais |
| `DespesaItemController` | Marcar/desmarcar itens, ajustar qty/preço |
| `CatalogoController` | Gerenciar catálogo pessoal |
| `PlanoController` | Visualizar e trocar plano |

### 9.2 Endpoints Principais

```
POST   /register                        → AuthController@register
POST   /login                           → AuthController@login
POST   /logout                          → AuthController@logout

GET    /dashboard                        → DashboardController@index

GET    /despesas                          → DespesaController@index
POST   /despesas                          → DespesaController@store
GET    /despesas/{despesa}                → DespesaController@show (tela de compras)
PUT    /despesas/{despesa}                → DespesaController@update
DELETE /despesas/{despesa}                → DespesaController@destroy
POST   /despesas/{despesa}/finalizar      → DespesaController@finalizar
POST   /despesas/{despesa}/duplicar       → DespesaController@duplicar (lista inteligente)

POST   /despesas/{despesa}/items          → DespesaItemController@toggle (marcar/desmarcar)
PUT    /despesas/{despesa}/items/{item}   → DespesaItemController@update (qty/preço)
DELETE /despesas/{despesa}/items/{item}   → DespesaItemController@destroy

GET    /catalogo                          → CatalogoController@index
POST   /catalogo                          → CatalogoController@store
PUT    /catalogo/{produto}                → CatalogoController@update
DELETE /catalogo/{produto}                → CatalogoController@destroy

GET    /plano                             → PlanoController@index
POST   /plano/upgrade                     → PlanoController@upgrade
```

### 9.3 Toggle de Item (Endpoint Chave)

```php
// app/Http/Controllers/DespesaItemController.php

/**
 * Marcar/desmarcar produto na despesa.
 * Se o item já existe, remove. Se não existe, adiciona.
 */
public function toggle(Request $request, Despesa $despesa)
{
    $request->validate([
        'catalogo_produto_id' => 'required|exists:catalogo_produtos,id',
        'quantidade'          => 'nullable|numeric|min:0.001',
        'preco_unitario'      => 'nullable|numeric|min:0',
    ]);

    $item = DespesaItem::where('despesa_id', $despesa->id)
        ->where('catalogo_produto_id', $request->catalogo_produto_id)
        ->first();

    if ($item) {
        // Desmarcar — remover item
        $item->delete();
        return response()->json([
            'action' => 'removed',
            'total'  => $despesa->getTotal(),
        ]);
    }

    // Marcar — adicionar item
    // Verificar limite por plano
    $limiteItens = auth()->user()->limiteProdutosPorDespesa();
    if ($despesa->items()->count() >= $limiteItens) {
        return response()->json([
            'error' => 'Limite de produtos por despesa atingido. Faça upgrade do plano.'
        ], 422);
    }

    // Buscar último preço como sugestão
    $catalogo = CatalogoProduto::find($request->catalogo_produto_id);
    $ultimoPreco = $catalogo->ultimoPreco() ?? 0;

    $novoItem = DespesaItem::create([
        'despesa_id'          => $despesa->id,
        'catalogo_produto_id' => $request->catalogo_produto_id,
        'quantidade'          => $request->quantidade ?? 1,
        'preco_unitario'      => $request->preco_unitario ?? $ultimoPreco,
        'comprado'            => false,
    ]);

    return response()->json([
        'action'         => 'added',
        'item'           => $novoItem,
        'ultimo_preco'   => $ultimoPreco,
        'total'          => $despesa->getTotal(),
    ]);
}
```

---

## 10. ROTAS E MIDDLEWARE

```php
// routes/web.php

// Públicas
Route::get('/', fn() => view('welcome'));
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// Protegidas
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('despesas', DespesaController::class);
    Route::post('/despesas/{despesa}/finalizar', [DespesaController::class, 'finalizar'])->name('despesas.finalizar');
    Route::post('/despesas/{despesa}/duplicar', [DespesaController::class, 'duplicar'])->name('despesas.duplicar');

    Route::post('/despesas/{despesa}/items', [DespesaItemController::class, 'toggle'])->name('despesa-items.toggle');
    Route::put('/despesas/{despesa}/items/{item}', [DespesaItemController::class, 'update'])->name('despesa-items.update');
    Route::delete('/despesas/{despesa}/items/{item}', [DespesaItemController::class, 'destroy'])->name('despesa-items.destroy');

    Route::resource('catalogo', CatalogoController::class)->except(['show']);

    Route::get('/plano', [PlanoController::class, 'index'])->name('plano.index');
    Route::post('/plano/upgrade', [PlanoController::class, 'upgrade'])->name('plano.upgrade');
});
```

---

## 11. FRONTEND — VIEWS E UX

### 11.1 Stack Frontend

| Tecnologia | Uso |
|---|---|
| **Bootstrap 5** | Layout responsivo, componentes, grid |
| **Alpine.js** | Reatividade inline (toggle, cálculos, UI) |
| **Blade** | Templates Laravel com componentes |
| **Fetch API** | Chamadas assíncronas para toggle/update |

### 11.2 Layout Mobile-First

- **Viewport**: Otimizado para telas de 360px-428px
- **Touch targets**: Botões e checkboxes com mínimo 44px
- **Sticky footer**: Total e botão finalizar sempre visíveis
- **Categorias colapsáveis**: Accordion Bootstrap + Alpine.js
- **Busca rápida**: Filtro local com Alpine.js (sem request ao server)
- **Haptic feedback**: Vibração ao marcar item (API Vibration)

### 11.3 Componente Alpine.js — Lista de Compras

```javascript
// Componente principal da tela de compras
function listaCompras(despesaId, orcamento) {
    return {
        items: [],           // Itens marcados [{id, produto_id, nome, qty, preco, subtotal}]
        total: 0,
        orcamento: orcamento,
        buscaTermo: '',
        loading: false,

        get porcentagem() {
            if (!this.orcamento) return 0;
            return Math.min(100, (this.total / this.orcamento * 100)).toFixed(1);
        },

        get corBarra() {
            if (this.porcentagem < 70) return 'bg-success';
            if (this.porcentagem < 90) return 'bg-warning';
            return 'bg-danger';
        },

        get totalFormatado() {
            return new Intl.NumberFormat('pt-BR', { style: 'currency', currency: 'BRL' }).format(this.total);
        },

        async toggleItem(produtoId) {
            const resp = await fetch(`/despesas/${despesaId}/items`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ catalogo_produto_id: produtoId })
            });
            const data = await resp.json();
            this.total = data.total;

            // Vibração sutil no celular
            if (navigator.vibrate) navigator.vibrate(50);
        },

        async updateItem(itemId, campo, valor) {
            await fetch(`/despesas/${despesaId}/items/${itemId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ [campo]: valor })
            });
            this.recalcularTotal();
        },

        recalcularTotal() {
            this.total = this.items.reduce((sum, item) => sum + (item.quantidade * item.preco_unitario), 0);
        },

        filtrarProduto(nome) {
            if (!this.buscaTermo) return true;
            return nome.toLowerCase().includes(this.buscaTermo.toLowerCase());
        }
    };
}
```

---

## 12. PWA E MODO OFFLINE

### 12.1 Manifest (manifest.json)

```json
{
    "name": "Carrinho Smart",
    "short_name": "CarrinhoSmart",
    "description": "Controle suas compras de supermercado",
    "start_url": "/dashboard",
    "display": "standalone",
    "background_color": "#ffffff",
    "theme_color": "#198754",
    "icons": [
        { "src": "/icons/icon-192.png", "sizes": "192x192", "type": "image/png" },
        { "src": "/icons/icon-512.png", "sizes": "512x512", "type": "image/png" }
    ]
}
```

### 12.2 Service Worker (Estratégia Cache-First)

- Cache de assets (CSS, JS, ícones) no install
- Cache de catálogo de produtos (muda pouco)
- Network-first para dados dinâmicos (despesas, items)
- Offline fallback: permite ver última lista carregada

---

## 13. INSTALAÇÃO E DEPLOY

### 13.1 Requisitos

- PHP 8.2+
- Composer 2.x
- MySQL 8.0+ ou MariaDB 10.6+
- Node.js 18+ (para compilar assets)

### 13.2 Comandos de Instalação

```bash
# Criar projeto
composer create-project laravel/laravel carrinho_smart
cd carrinho_smart

# Instalar Sanctum
composer require laravel/sanctum
php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider"

# Configurar .env
# DB_DATABASE=carrinho_smart

# Executar migrations
php artisan migrate

# Executar seeders (categorias + produtos padrão)
php artisan db:seed --class=CategoriaSeeder
php artisan db:seed --class=ProdutoSeedSeeder

# Criar symlink storage
php artisan storage:link

# Compilar assets
npm install && npm run build

# Iniciar servidor
php artisan serve
```

### 13.3 Deploy Sugerido

| Ambiente | Opção | Custo |
|---|---|---|
| **MVP/Beta** | Laragon local + ngrok | Grátis |
| **Produção básica** | VPS DigitalOcean/Hostinger | R$ 25-50/mês |
| **Produção escalável** | Laravel Forge + DigitalOcean | R$ 80-120/mês |

---

## 14. ROADMAP E CRONOGRAMA

### Fase 1 — MVP (4 semanas)

| Semana | Entregas |
|---|---|
| **Semana 1** | Setup projeto, migrations, seeders, autenticação (login/registro) |
| **Semana 2** | CRUD despesas, catálogo pessoal, tela de compras com toggle de itens |
| **Semana 3** | Cálculos em tempo real (Alpine.js), barra de orçamento, busca rápida |
| **Semana 4** | Responsividade mobile, testes, ajustes de UX, PWA básico |

**Entrega**: App funcional onde o usuário cria conta, vê produtos prontos, marca itens, ajusta qty/preço e controla orçamento.

### Fase 2 — Melhoria de Experiência (3 semanas)

| Entregas |
|---|
| Reutilizar lista do mês anterior (lista inteligente) |
| Sugestão de último preço pago |
| Histórico e comparativo entre meses |
| Gráficos de gastos (Chart.js) |
| Tela "Meu Catálogo" para personalizar produtos |

### Fase 3 — Monetização (3 semanas)

| Entregas |
|---|
| Integração Mercado Pago / Stripe (assinaturas) |
| Tela de planos com checkout |
| Controle de limites por plano (middleware) |
| Exportação para PDF |
| Emails transacionais (boas-vindas, lembrete, cobrança) |

### Fase 4 — Crescimento (contínuo)

| Entregas |
|---|
| PWA completo com modo offline |
| Compartilhar lista com cônjuge/família |
| Leitor de código de barras |
| Notificações push (promoções, lembrete de compra) |
| SEO e landing page de conversão |

---

## 15. PROJEÇÕES FINANCEIRAS

### 15.1 Cenário Conservador (12 meses)

| Métrica | Valor |
|---|---|
| Usuários free | 200 |
| Usuários premium (R$ 9,90) | 20 |
| Usuários pro (R$ 19,90) | 5 |
| **Receita mensal** | **(20 × 9,90) + (5 × 19,90) = R$ 297,50** |
| **Receita anual** | **R$ 3.570,00** |
| Custos operacionais anuais | ~R$ 1.500,00 |
| **Lucro líquido estimado** | **~R$ 2.070,00** |

### 15.2 Cenário Otimista (12 meses)

| Métrica | Valor |
|---|---|
| Usuários free | 1.000 |
| Usuários premium (R$ 9,90) | 100 |
| Usuários pro (R$ 19,90) | 30 |
| **Receita mensal** | **(100 × 9,90) + (30 × 19,90) = R$ 1.587,00** |
| **Receita anual** | **R$ 19.044,00** |
| Custos operacionais anuais | ~R$ 2.500,00 |
| **Lucro líquido estimado** | **~R$ 16.544,00** |

### 15.3 Break-even

Com custos de ~R$ 100/mês, o break-even é atingido com apenas **~11 assinantes premium** ou **~6 assinantes pro**.

---

## RESUMO DAS MELHORIAS vs. PLANO ORIGINAL

| Aspecto | Plano Original | Plano Melhorado |
|---|---|---|
| Produtos pré-carregados | ❌ Não existia | ✅ +150 produtos em 12 categorias |
| Fluxo prático de uso | ❌ Não descrito | ✅ Jornada completa do supermercado |
| Mockup da tela principal | ❌ | ✅ Wireframe ASCII detalhado |
| Tabela de produtos | ❌ "Mesma do anterior" | ✅ Definida com todos os campos |
| Banco de dados | Parcial e confuso | ✅ 6 tabelas bem definidas |
| Catálogo pessoal | ❌ | ✅ Cópia automática + personalização |
| Lista inteligente | ❌ | ✅ Reutiliza mês anterior |
| Sugestão de preço | ❌ | ✅ Último preço como default |
| Toggle de item | ❌ | ✅ Endpoint + Alpine.js reativo |
| PWA | Citado como futuro | ✅ Manifest + Service Worker no MVP |
| Projeções financeiras | Valores errados | ✅ Cálculos corretos + break-even |
| Cronograma | Vago | ✅ Semana a semana |
| Custos operacionais | ❌ Não mencionados | ✅ Estimativa detalhada |

---

*Carrinho Smart — Abra, marque, compre. Sem complicação.*
