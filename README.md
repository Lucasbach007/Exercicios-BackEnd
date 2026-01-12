# Projeto - Frontend + Backend (Instruções de desenvolvimento)

Este repositório contém duas partes principais:

- `projeto` — backend Laravel (API)
- `frontend-api` — frontend React + Vite

Resumo rápido das alterações recentes:

- Integração de barras de busca nas páginas de listagem (`Servicos` e `Produtos`).
- Rotas `GET /api/servicos` e `GET /api/produtos` tornadas públicas (apenas leitura).
- CORS ajustado para permitir `http://localhost:5173` e `http://127.0.0.1:5173`.

Pré-requisitos

- PHP >= 8.1, Composer
- Node.js e npm
- (Opcional) Docker/Sail se preferir rodar o Laravel via container

Como rodar localmente

1) Backend (Laravel)

```bash
cd projeto
composer install         # se necessário
cp .env.example .env     # ajustar variáveis (DB, etc)
php artisan key:generate
php artisan migrate --seed   # se quiser popular DB de exemplo
php artisan serve --host=127.0.0.1 --port=8000
```

O backend deverá ficar disponível em `http://127.0.0.1:8000`.

2) Frontend (Vite)

```bash
cd frontend-api
npm install
cp .env.local.example .env.local || true   # se houver
# certifique-se que VITE_API_BASE_URL aponte para http://127.0.0.1:8000/api
npm run dev -- --host 127.0.0.1 --port 5173
```

O frontend ficará em `http://127.0.0.1:5173`.

Notas importantes

- `VITE_API_BASE_URL` é usado pelo frontend para as chamadas à API. Verifique `frontend-api/.env.local`.
- As rotas de escrita (criar/editar/deletar) permanecem protegidas por Sanctum — para esses endpoints é necessário autenticar e transmitir o token via `localStorage` (o `axios` já injeta `Authorization: Bearer <token>` no header se houver `token` no `localStorage`).
- Se usar Docker/Sail, inicie os containers e ajuste `VITE_API_BASE_URL` para o host apropriado.
- CORS já foi ajustado para aceitar `localhost:5173` e `127.0.0.1:5173`.

Testes rápidos

- Verifique que `GET /api/servicos` retorna 200: `curl http://127.0.0.1:8000/api/servicos`
- Abra `http://127.0.0.1:5173` e navegue até as páginas `Serviços` e `Produtos`, use o campo de busca para filtrar os cards.

Se quiser, eu posso:
- adicionar instruções para executar com Docker/Sail;
- fazer commit das mudanças neste repositório (já vou fazer agora);
- adicionar instruções de debug / testes automatizados.

---
Gerado automaticamente pelo assistente.
