import { useEffect, useState } from "react";
import { getProdutos, deleteProduto } from "../services/api";
import "../styles/Produto.css";
function Produtos() {
  const [produtos, setProdutos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    async function carregar() {
      try {
        setLoading(true);
        const data = await getProdutos();
        setProdutos(Array.isArray(data) ? data : data.data || []);
      } catch (err) {
        setError(err.message || "Erro ao carregar produtos");
      } finally {
        setLoading(false);
      }
    }

    carregar();
  }, []);

  return (
    <div className="container">
      <h1>Produtos</h1>

      {error && <div className="alert alert-danger">{error}</div>}
      {loading && <p>Carregando...</p>}

      {!loading && produtos.length > 0 && (
        <ul className="list-produtos">
          {produtos.map(p => (
            <li key={p.id} className="produto-item">
              {p.imagem && (
                <img 
                  src={p.imagem_url || `${import.meta.env.VITE_API_BASE_URL.replace('/api', '')}/storage/${p.imagem}`} 
                  alt={p.nome} 
                  className="produto-imagem"
                  onError={(e) => { e.target.style.display = 'none'; }}
                />
              )}
              <div className="produto-info">
                <strong>{p.nome}</strong>
                {p.descricao && <p>{p.descricao}</p>}
                {p.preco && <p className="preco">R$ {Number(p.preco).toFixed(2)}</p>}
              </div>
              <div className="produto-actions">
                <button
                  className="btn-danger"
                  onClick={async () => {
                    if (!confirm('Confirma exclusão deste produto?')) return;
                    try {
                      await deleteProduto(p.id);
                      setProdutos(prev => prev.filter(x => x.id !== p.id));
                    } catch (err) {
                      alert(err?.message || 'Erro ao excluir');
                    }
                  }}
                >Excluir</button>
              </div>
            </li>
          ))}
        </ul>
      )}

      {!loading && produtos.length === 0 && <p>Nenhum produto encontrado.</p>}
    </div>
  );
}

export default Produtos;
