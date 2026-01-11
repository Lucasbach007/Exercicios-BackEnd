import { useEffect, useState } from "react";
import { getServicos } from "../services/api";
import ProcedureCard from "../components/ProcedureCard/ProcedureCard";
import ScheduleModal from "../components/ScheduleModal/ScheduleModal";
import Shearchbar from "../components/Shearchbar";
import "../styles/Servicos.css";
function Servicos() {
  const [servicos, setServicos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [selectedService, setSelectedService] = useState(null);
  const [searchTerm, setSearchTerm] = useState("");

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

  const handleSearchChange = (e) => setSearchTerm(e.target.value);

  const filteredServicos = servicos.filter((s) => {
    const term = searchTerm.trim().toLowerCase();
    if (!term) return true;
    return (
      (s.nome && s.nome.toLowerCase().includes(term)) ||
      (s.descricao && s.descricao.toLowerCase().includes(term))
    );
  });

  return (
    <div className="container">
      <h1>Serviços</h1>

      <Shearchbar searchTerm={searchTerm} onSearchChange={handleSearchChange} />

      {error && <div className="alert alert-danger">{error}</div>}
      {loading && <p>Carregando...</p>}

      {!loading && filteredServicos.length > 0 && (
        <div className="servicos-grid">
          {filteredServicos.map((s) => (
            <ProcedureCard key={s.id} procedure={s} onAgendar={(p) => setSelectedService(p)} />
          ))}
        </div>
      )}

      {!loading && filteredServicos.length === 0 && <p>Nenhum serviço encontrado.</p>}

      <ScheduleModal procedure={selectedService} onClose={()=>setSelectedService(null)} />
    </div>
  );
}

export default Servicos;
