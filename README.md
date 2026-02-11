# 🛒 Carrinho Smart

Sistema de controle de despesas de supermercado. Lista de compras prática no celular com cálculo em tempo real.

## ✅ Sistema Implementado

### Funcionalidades
- ✅ Cadastro e login de usuários
- ✅ Dashboard com lista de despesas
- ✅ Criar nova despesa (copia produtos da despesa anterior)
- ✅ Lista de compras com produtos
- ✅ Ajustar quantidade com botões +/-
- ✅ Digitar preço de cada produto
- ✅ Adicionar novos produtos na hora
- ✅ Cálculo do total em tempo real
- ✅ Design mobile-first responsivo
- ✅ Alpine.js para reatividade

### Tecnologias
- Laravel 8
- Bootstrap 5
- Alpine.js
- MySQL

## 🚀 Como Usar

### 1. Servidor já está rodando
```
http://localhost:8000
```

### 2. Primeiro Acesso
1. Acesse http://localhost:8000
2. Clique em "Criar conta"
3. Preencha: Nome, Email, Senha
4. Será redirecionado para o Dashboard

### 3. Criar Primeira Despesa
1. No Dashboard, clique em "➕ Nova despesa"
2. Sistema cria automaticamente com título "Compras [Mês/Ano]"
3. Se for a primeira despesa, lista estará vazia
4. Clique em "➕ Adicionar produto"

### 4. Adicionar Produtos
1. Digite o nome do produto (ex: Arroz)
2. Clique em "Adicionar"
3. Produto aparece na lista com quantidade 1 e preço R$ 0,00
4. Ajuste a quantidade com os botões - e +
5. Digite o preço
6. Total atualiza automaticamente

### 5. Próximas Despesas
1. Ao criar nova despesa, sistema copia automaticamente os produtos da despesa anterior
2. Você só precisa ajustar quantidade e preço
3. Adicione ou remova produtos conforme necessário

## 📱 Uso no Celular

1. Abra no navegador do celular: http://[seu-ip]:8000
2. Faça login
3. Dentro do supermercado:
   - Abra a despesa do mês
   - Conforme pega os produtos, ajuste quantidade e digite o preço
   - Total aparece no rodapé fixo
   - Controle quanto está gastando em tempo real

## 🗂️ Estrutura do Projeto

```
app/
├── Http/Controllers/
│   ├── AuthController.php         (Login/Registro)
│   ├── DashboardController.php    (Lista de despesas)
│   ├── DespesaController.php      (CRUD de despesas)
│   └── DespesaItemController.php  (Gerenciar itens)
├── Models/
│   ├── User.php
│   ├── Despesa.php
│   └── DespesaItem.php
database/migrations/
├── 2014_10_12_000000_create_users_table.php
├── 2026_02_11_211723_create_despesas_table.php
└── 2026_02_11_211724_create_despesa_itens_table.php
resources/views/
├── layouts/app.blade.php          (Layout base com Bootstrap/Alpine)
├── auth/
│   ├── login.blade.php
│   └── register.blade.php
├── dashboard.blade.php            (Lista de despesas)
└── despesas/
    └── show.blade.php             (Tela principal da lista)
routes/web.php                     (Todas as rotas)
```

## 🎯 Próximos Passos (Opcionais)

- [ ] Editar título da despesa
- [ ] Adicionar data da compra
- [ ] Relatórios e comparativos
- [ ] PWA para instalar no celular
- [ ] Modo offline
- [ ] Compartilhar lista com família

## 📝 Exemplo de Uso

**Lista do usuário hoje:**
- Arroz (2)
- Feijão (3)
- Sal (1)
- Óleo (3)
- Açúcar (1)
- Café (1)
- Macarrão (3)
- Massa Tomate (4)
- Detergente (4)
- Sabonete (7)
- etc...

**Como funciona:**
1. Mês anterior: criou despesa com 27 produtos
2. Este mês: clica em "Nova despesa"
3. Sistema já traz os 27 produtos na lista
4. No mercado: ajusta quantidade (alguns produtos precisa mais, outros menos)
5. Digita o preço conforme pega cada item
6. Total atualiza em tempo real
7. Controla orçamento enquanto compra

---

*Sistema implementado conforme plan_simple.md*
