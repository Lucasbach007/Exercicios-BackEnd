import { useEffect, useState } from "react";
import { getServicos, deleteServico } from "../services/api";
import ProcedureCard from "../components/ProcedureCard/ProcedureCard";
import ScheduleModal from "../components/ScheduleModal/ScheduleModal";
import "../styles/Servicos.css";
function Servicos() {
  const [servicos, setServicos] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [selectedService, setSelectedService] = useState(null);

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
        <div className="servicos-grid">
          {servicos.map(s => (
            <ProcedureCard key={s.id} procedure={s} onAgendar={(p)=>setSelectedService(p)} />
          ))}
        </div>
      )}

      {!loading && servicos.length === 0 && <p>Nenhum serviço encontrado.</p>}

      <ScheduleModal procedure={selectedService} onClose={()=>setSelectedService(null)} />
    </div>
  );
}

export default Servicos;
