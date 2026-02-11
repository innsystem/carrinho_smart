# CARRINHO SMART — Plano Simplificado

## Versão para Uso Hoje (MVP Essencial)

**Objetivo**: Lista de compras prática no celular. Login, ver despesas, nova despesa com itens da anterior, ajustar qtd e preço, total em tempo real.

**Sem**: planos, assinaturas, preços, limites. Apenas cadastro e lista pessoal.

---

## 1. JORNADA DO USUÁRIO

```
Página inicial → Login (email/senha) → Dashboard
                                              ↓
                                    Ver últimas despesas
                                              ↓
                                    [Nova despesa]
                                              ↓
                                    Lista já vem com produtos da despesa anterior
                                              ↓
                                    Ajustar quantidade (- / +)
                                    Digitar preço de cada item
                                    [ + ] adicionar produto novo se precisar
                                              ↓
                                    Total atualiza em tempo real
                                              ↓
                                    Salvar despesa
```

### Fluxo Resumido

1. **Entrar** → Login com email
2. **Ver despesas** → Lista das últimas (data + total de cada)
3. **Nova despesa** → Abre com os mesmos produtos da última (ou vazio se for a primeira)
4. **Ajustar** → Alterar quantidade com +/- e digitar o preço
5. **Adicionar** → Botão + para incluir produto novo na hora
6. **Salvar** → Despesa gravada e total calculado

---

## 2. ESTRUTURA MÍNIMA

### 2.1 Banco de Dados (3 tabelas)

#### `users`
| Campo     | Tipo        | Descrição      |
|-----------|-------------|----------------|
| id        | bigIncrements | PK            |
| name      | string(255) | Nome           |
| email     | string(255) | Login (único)  |
| password  | string      | Hash bcrypt    |
| timestamps| —           | created_at, updated_at |

#### `despesas`
| Campo     | Tipo              | Descrição                 |
|-----------|-------------------|---------------------------|
| id        | bigIncrements     | PK                        |
| user_id   | unsignedBigInteger| FK users                  |
| titulo    | string(255)       | Ex: "Compras Jan/2026"    |
| data_compra | date (nullable) | Data da compra            |
| total     | decimal(10,2)     | Total (calculado)         |
| timestamps| —                 | created_at, updated_at    |

#### `despesa_itens`
| Campo         | Tipo              | Descrição           |
|---------------|-------------------|---------------------|
| id            | bigIncrements     | PK                  |
| despesa_id    | unsignedBigInteger| FK despesas         |
| nome          | string(255)       | Nome do produto     |
| quantidade    | decimal(8,3)      | Ex: 2, 3, 0.5       |
| preco_unitario| decimal(10,2)    | Preço por unidade   |
| subtotal      | decimal(10,2)    | qtd × preço         |
| timestamps    | —                 | created_at, updated_at |

> Cada usuário vê só suas despesas (`user_id` em `despesas`).

---

## 3. TELAS (Mobile-First)

### 3.1 Página Inicial
- Logo/nome do app
- Link "Entrar" e "Criar conta"
- Sem conteúdo extra

### 3.2 Login
- Email
- Senha
- Botão "Entrar"
- Link "Não tenho conta → Criar conta"

### 3.3 Cadastro
- Nome
- Email
- Senha (e confirmação)
- Botão "Criar conta"
- Redireciona para dashboard após cadastro

### 3.4 Dashboard (Após Login)
- Texto: "Minhas despesas"
- Lista das últimas despesas (mais recente em cima):
  - Título ou data
  - Total (R$ X,XX)
  - Link para editar/ver
- Botão fixo: **+ Nova despesa**

### 3.5 Tela de Despesa (A Lista de Compras)

Layout sugerido:

```
┌─────────────────────────────────────┐
│ Compras Jan/2026          [Salvar]  │
├─────────────────────────────────────┤
│ Arroz          [-]  2  [+]  R$ 25,00  │  ← produto, -/+, qtd, preço
│ Feijão         [-]  3  [+]  R$ 18,00  │
│ Sal            [-]  1  [+]  R$  4,50  │
│ Óleo           [-]  3  [+]  R$  8,90  │
│ ...                                  │
├─────────────────────────────────────┤
│ [+ Adicionar produto]                │  ← botão para novo item
├─────────────────────────────────────┤
│ Total: R$ 342,50                     │  ← rodapé fixo, atualiza em tempo real
└─────────────────────────────────────┘
```

**Comportamento de cada linha**:
- **Nome**: Texto do produto (pode ser editável tocando)
- **[-] e [+]**: Diminuir/aumentar quantidade (mínimo 0,5 ou 1)
- **Quantidade**: Valor atual (editável tocando, se preferir)
- **Preço**: Campo para digitar (formato R$ X,XX ou só números)
- **Subtotal**: Calculado (qtd × preço) — pode mostrar ou não, o total já reflete

**Botão "+ Adicionar produto"**:
- Abre campo inline ou modal
- Digita o nome e adiciona com qtd 1 e preço 0 (depois ajusta)
- Alternativa: autocomplete com produtos das despesas anteriores para digitar mais rápido

---

## 4. LÓGICA PRINCIPAL

### 4.1 Criar Nova Despesa

1. Usuário clica em "Nova despesa"
2. Sistema cria despesa nova (título padrão: "Compras [mês/ano]")
3. **Se existe despesa anterior** do usuário:
   - Copia todos os itens da última despesa
   - Mantém nome e quantidade (usuário altera depois)
   - Preço pode vir como 0 ou como último preço pago (sugestão)
4. **Se não existe despesa anterior**:
   - Lista vazia
   - Usuário usa "+" para adicionar tudo

### 4.2 Lista de Referência (Sua Lista de Hoje)

Para orientar o seed inicial ou testes, use esta lista real:

| Produto       | Qtd |
|---------------|-----|
| Arroz         | 2   |
| Feijão        | 3   |
| Sal           | 1   |
| Óleo          | 3   |
| Banha         | 1   |
| Açúcar        | 1   |
| Café          | 1   |
| Chá           | 1   |
| Macarrão      | 3   |
| Massa Tomate  | 4   |
| Pó Royal      | 1   |
| Farinha       | 1   |
| Nescau        | 1   |
| Ovo           | 1   |
| Temperos      | *   |
| Roupalin Pequeno | 1 |
| Amaciante     | 1   |
| Detergente    | 4   |
| Sabão em Pedra| 2   |
| Bucha Pia     | 1   |
| Bucha Banho   | 1   |
| Veneno        | 1   |
| Sabonete      | 7   |
| Listerine     | 1   |
| Pasta Dental  | 4   |
| Shampoo       | 1   |
| Creme de Cabelo | 1 |

*Temperos: podem ser vários itens diferentes — usuário adiciona com + e nomeia como quiser.

### 4.3 Adicionar Produto Rápido

**Opção A – Mais simples**  
- Botão "+" → campo de texto "Nome do produto" → Enter ou "Adicionar"  
- Item entra com qtd 1 e preço 0  
- Usuário ajusta quantidade e preço na linha

**Opção B – Sugestão**  
- Ao digitar, mostra sugestões dos produtos já usados antes (histórico do usuário)  
- Escolhe na lista ou continua digitando para criar novo

### 4.4 Cálculo em Tempo Real

- Ao mudar quantidade ou preço: recalcula `subtotal` do item
- Soma todos os subtotais → total da despesa
- Atualiza o valor no rodapé sem recarregar a página (Alpine.js ou JS simples)

---

## 5. UX NO CELULAR

### 5.1 Toque e Digitação

- Botões **-** e **+** grandes (44px ou mais)
- Campos de preço com teclado numérico
- Evitar muitos passos: adicionar, editar e salvar na mesma tela
- Salvar automático a cada alteração ou botão "Salvar" visível

### 5.2 Performance

- Carregar rápido
- Respostas imediatas ao +/-, digitar preço e adicionar item
- Evitar recarregar a página inteira

---

## 6. ROTAS ESSENCIAIS

```
GET  /                    → Página inicial (login ou redirect)
GET  /login               → Formulário de login
POST /login               → Processar login
GET  /register            → Formulário de cadastro
POST /register            → Processar cadastro
POST /logout              → Sair

GET  /dashboard           → Lista de despesas (requer login)
GET  /despesas            → Lista de despesas (mesmo que dashboard)
GET  /despesas/create     → Nova despesa (já com itens da anterior)
POST /despesas            → Criar despesa
GET  /despesas/{id}       → Ver/editar despesa (tela da lista)
PUT  /despesas/{id}       → Atualizar despesa (título, data)
DELETE /despesas/{id}     → Excluir despesa

POST /despesas/{id}/itens         → Adicionar item
PUT  /despesas/{id}/itens/{item}  → Atualizar qtd/preço
DELETE /despesas/{id}/itens/{item} → Remover item
```

---

## 7. STACK TÉCNICA

| Item       | Escolha                         |
|------------|---------------------------------|
| Backend    | Laravel 11                      |
| Auth       | Laravel Breeze ou padrão Laravel|
| Frontend   | Blade + Alpine.js               |
| CSS        | Bootstrap 5 ou Tailwind (mobile)|
| Banco      | MySQL / SQLite                  |

---

## 8. RESUMO DO QUE CONSTRUIR

| # | Entrega                                      |
|---|-----------------------------------------------|
| 1 | Migrations: users, despesas, despesa_itens   |
| 2 | Auth: registro e login com email             |
| 3 | Dashboard: listar despesas do usuário        |
| 4 | Nova despesa: copiar itens da anterior       |
| 5 | Tela da despesa: listar itens, +/- qtd, preço|
| 6 | Adicionar item: botão + e campo nome         |
| 7 | Cálculo em tempo real (total)                 |
| 8 | Salvar despesa e itens                       |
| 9 | Layout mobile responsivo                     |

---

## 9. O QUE NÃO ESTÁ NESTE PLANO

- Planos de assinatura
- Limites por plano
- Pagamentos
- Catálogo fixo de produtos
- Categorias obrigatórias
- Gráficos ou relatórios avançados
- PWA/offline (pode vir depois)
- Compartilhamento de lista

---

## 10. EXEMPLO DE USO

1. Maria acessa o site no celular.
2. Faz login com maria@email.com.
3. Vê as despesas: "Compras Dez/2025 - R$ 380,00", "Compras Nov/2025 - R$ 320,00".
4. Clica em "+ Nova despesa".
5. Abre a lista já com os produtos de dezembro (Arroz, Feijão, Sal...).
6. Ajusta quantidades: Arroz de 2 para 3 (+), Feijão de 3 para 2 (-).
7. Digita o preço de cada um conforme passa no mercado.
8. Percebe que faltou "Leite": clica em "+ Adicionar produto", digita "Leite", qtd 2, preço 5,90.
9. O total aparece no rodapé: R$ 395,40.
10. Clica em "Salvar" e volta para o dashboard.

---

*Carrinho Smart Simplificado — Lista pronta, ajuste e compre.*
