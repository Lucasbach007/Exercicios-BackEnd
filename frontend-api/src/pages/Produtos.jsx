import { useEffect, useState } from "react";
import { getProdutos, deleteProduto } from "../services/api";
import ProdCard from "../components/ProdsComps/ProdCard";
import ProdModal from "../components/ProdsComps/ProdsModal";
import SearchBarprodutos from "../components/Sherachbarprodutos";
import "../styles/Produto.css";
function Produtos() {
  const [produtos, setProdutos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [selectedProduct, setSelectedProduct] = useState(null);
  const [searchValue, setSearchValue] = useState("");

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

  const handleSearchChange = (e) => setSearchValue(e.target.value);

  const filteredProdutos = produtos.filter((p) => {
    const term = searchValue.trim().toLowerCase();
    if (!term) return true;
    return (
      (p.nome && p.nome.toLowerCase().includes(term)) ||
      (p.descricao && p.descricao.toLowerCase().includes(term))
    );
  });

  return (
    <div className="container">
      <h1>Produtos</h1>

      {error && <div className="alert alert-danger">{error}</div>}
      {loading && <p>Carregando...</p>}

      <SearchBarprodutos value={searchValue} onChange={handleSearchChange} />

      {!loading && filteredProdutos.length > 0 && (
        <div className="produtos-grid">
          {filteredProdutos.map((p) => (
            <ProdCard key={p.id} product={p} onComprar={(prod) => setSelectedProduct(prod)} />
          ))}
        </div>
      )}

      {!loading && filteredProdutos.length === 0 && <p>Nenhum produto encontrado.</p>}

      <ProdModal product={selectedProduct} onClose={()=>setSelectedProduct(null)} />
    </div>
  );
}

export default Produtos;
