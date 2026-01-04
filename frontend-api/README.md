# Frontend API - React + Vite

Frontend React com Vite para consumir as APIs do projeto Laravel Backend.

## 🚀 Começar Rápido

### Pré-requisitos
- Node.js 18+
- Backend Laravel rodando em `http://localhost:8000`

### Instalação

```bash
cd frontend-api
npm install
```

### Configurar Variáveis de Ambiente

Crie um arquivo `.env.local` na raiz da pasta `frontend-api`:

```bash
VITE_API_BASE_URL=http://localhost:8000/api
```

### Rodar em Desenvolvimento

```bash
npm run dev
```

Acesse `http://localhost:5173` (ou a porta sugerida no terminal).

### Build para Produção

```bash
npm run build
```

## 📁 Estrutura

```
src/
├── pages/
│   ├── Login.jsx          # Login com autenticação
│   ├── Register.jsx       # Registro de usuário
│   ├── Produtos.jsx       # Listar produtos da API
│   └── Servicos.jsx       # Listar serviços da API
├── components/
│   └── Navbar.jsx         # Navbar com navegação
├── services/
│   └── api.js             # Funções para chamar APIs
└── styles/
    ├── global.css         # Estilos globais
    └── gil/
        └── gil.css        # Estilos do Professor Gil
```

## 🔌 APIs Consumidas

### Públicas
- `POST /register` - Registrar novo usuário
- `POST /login` - Fazer login (retorna token)

### Autenticadas (com Bearer Token)
- `GET /servicos` - Listar serviços
- `GET /produtos` - Listar produtos
- `POST /avaliacoes/{tipo}/{id}` - Avaliar serviço/produto

## 🎨 Estilos do Professor Gil

Os estilos estão em `src/styles/gil/gil.css`. Substitua pelo seu tema:

1. Abra `src/styles/gil/gil.css`
2. Substitua pelos estilos do Professor Gil do TSI
3. Ajuste as classes CSS dos componentes conforme necessário

Paleta padrão (CSS variables):
```css
--primary: #0b5ed7
--danger: #dc3545
--success: #28a745
--bg: #f8f9fa
--text: #212529
--border: #dee2e6
```

## 📝 Uso de APIs

Exemplos de como usar as funções do `src/services/api.js`:

```javascript
import { loginUser, registerUser, getProdutos, getServicos } from '../services/api';

// Login
const data = await loginUser({ email: 'user@example.com', password: 'senha123' });

// Registrar
const newUser = await registerUser({ 
  name: 'John', 
  email: 'john@example.com', 
  password: 'senha123',
  password_confirmation: 'senha123'
});

// Listar Produtos
const produtos = await getProdutos();

// Listar Serviços
const servicos = await getServicos();
```

**Nota:** O token é salvo automaticamente em `localStorage` após login e incluído em todas as requisições autenticadas.

## ⚙️ Backend (Laravel)

Para rodar o backend:

```bash
cd projeto
php artisan serve
```

A API estará disponível em `http://localhost:8000/api`.

## 🐛 Troubleshooting

### Erro: "Cannot GET /"
- Certifique-se de rodar `npm run dev` (não `npm start`)
- Verifique a porta: padrão é `5173`

### Erro: "Failed to fetch"
- Verifique se o backend está rodando em `http://localhost:8000`
- Confirme a variável de ambiente `VITE_API_BASE_URL`
- Verifique CORS no backend Laravel

### Token não funciona
- Verifique se o `Bearer token` é válido
- Confirme se foi salvo em `localStorage` após login
- Inspecione as requisições no DevTools (F12)

---

**Desenvolvido com React + Vite** 🔥
