import { useEffect, useState } from "react";
import { getServicos, deleteServico } from "../services/api";
import "../styles/Servicos.css";
function Servicos() {
  const [servicos, setServicos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");

  useEffect(() => {
    async function carregar() {
      try {
        setLoading(true);
        const data = await getServicos();
        setServicos(Array.isArray(data) ? data : data.data || []);
      } catch (err) {
        setError(err.message || "Erro ao carregar serviços");
      } finally {
        setLoading(false);
      }
    }

    carregar();
  }, []);

  return (
    <div className="container">
      <h1>Serviços</h1>

      {error && <div className="alert alert-danger">{error}</div>}
      {loading && <p>Carregando...</p>}

      {!loading && servicos.length > 0 && (
        <ul className="list-servicos">
          {servicos.map(s => (
            <li key={s.id} className="servico-item">
              {s.imagem && (
                <img 
                  src={s.imagem_url || `${import.meta.env.VITE_API_BASE_URL.replace('/api', '')}/storage/${s.imagem}`} 
                  alt={s.nome} 
                  className="servico-imagem"
                  onError={(e) => { e.target.style.display = 'none'; }}
                />
              )}
              <div className="servico-info">
                <strong>{s.nome}</strong>
                {s.descricao && <p>{s.descricao}</p>}
                {s.preco && <p className="preco">R$ {Number(s.preco).toFixed(2)}</p>}
                {s.duracao_minutos && <p className="duracao">{s.duracao_minutos} minutos</p>}
              </div>
              <div className="servico-actions">
                <button
                  className="btn-danger"
                  onClick={async () => {
                    if (!confirm('Confirma exclusão deste serviço?')) return;
                    try {
                      await deleteServico(s.id);
                      setServicos(prev => prev.filter(x => x.id !== s.id));
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

      {!loading && servicos.length === 0 && <p>Nenhum serviço encontrado.</p>}
    </div>
  );
}

export default Servicos;
