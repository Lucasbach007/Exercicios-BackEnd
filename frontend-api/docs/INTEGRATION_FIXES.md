# Integration fixes — Frontend

Resumo das alterações:

- Corrigido `logout` em `AuthContext.jsx`: agora chama `logoutUser()` sem passar o token (o token é enviado pelo interceptor do axios). Isso evita chamadas incorretas e mantém a lógica de limpeza de `localStorage` centralizada no `AuthContext`.
- `logoutUser()` em `src/services/api.js` agora retorna `response.data` (antes removia itens do `localStorage` diretamente).

Como testar / aplicar:

1. Puxe a branch: `git fetch origin && git checkout fix/integration-issues`
2. Instalar dependências: `npm install` (se necessário)
3. Inicie o frontend: `npm run dev` (Vite)
4. Fluxos para testar (manuais):
   - Registrar, logar, visitar `/produtos` e `/servicos` com token.
   - Fazer upload de foto em `/profile` e confirmar retorno `foto_url`.
   - Efetuar logout e confirmar que `localStorage` está limpo e a rota redireciona para `/login`.

Observações:
- Também revisei tratamento de erros nos endpoints principais (recomendo adicionar mensagens de UI caso ocorram erros do servidor).
- Branch criada: `fix/integration-issues`.
