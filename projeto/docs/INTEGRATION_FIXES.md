# Integration fixes — Backend

Resumo das alterações:

- Criação de uma view `listaprod` para compatibilidade com consultas legadas (migration criada: `2026_01_10_180000_create_listaprod_view.php`).
- Implementado tratamento para upload de foto (já existente) e verificado que funciona com token Bearer.
- Corrigida duplicidade de controller (`AuthController`) através de limpeza de autoload e limpeza de cache (veja abaixo).

Como aplicar em produção / em ambiente local:

1. Puxe a branch: `git fetch origin && git checkout fix/integration-backend`
2. Rode as migrations: `php artisan migrate --force`
3. Limpe caches e regenere autoloads (se necessário):
   - `php artisan optimize:clear`
   - `composer dump-autoload -o`
4. Reinicie o servidor (`php artisan serve` ou serviço PHP-FPM conforme seu ambiente).

Observações:
- A view `listaprod` replica por ora todos os registros da tabela `produtos`. Se preferir, posso criar uma migration que crie uma tabela real em vez de view.
- Logs antigos mostravam `Table 'listaprod' doesn't exist` — a migration corrige isso.

Se quiser, abro o PR automaticamente; já criei a branch `fix/integration-backend` com a migration e posso abrir o PR se você me autorizar a criar via GitHub (preciso de um token) ou você pode usar o link retornado pelo GitHub para criar o PR manualmente.
