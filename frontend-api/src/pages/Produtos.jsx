import { useEffect, useState } from "react";
import { getProdutos, deleteProduto } from "../services/api";
import ProdCard from "../components/ProdsComps/ProdCard";
import ProdModal from "../components/ProdsComps/ProdsModal";
import "../styles/Produto.css";
function Produtos() {
  const [produtos, setProdutos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [selectedProduct, setSelectedProduct] = useState(null);

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
        <div className="produtos-grid">
          {produtos.map(p => (
            <ProdCard key={p.id} product={p} onComprar={(prod)=>setSelectedProduct(prod)} />
          ))}
        </div>
      )}

      {!loading && produtos.length === 0 && <p>Nenhum produto encontrado.</p>}

      <ProdModal product={selectedProduct} onClose={()=>setSelectedProduct(null)} />
    </div>
  );
}

export default Produtos;
