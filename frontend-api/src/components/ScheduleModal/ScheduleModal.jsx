import "./ScheduleModal.css";

const ScheduleModal = ({ procedure, onClose }) => {
  if (!procedure) return null;

  return (
    <div className="modal-overlay">
      <div className="modal-content">
        <div className="modal-header">
          <h2>Agendar: {procedure.nome}</h2>
          <button className="modal-close" onClick={onClose}>×</button>
        </div>

        {procedure.duracao != null && <p>Duração: {procedure.duracao || procedure.duracao_minutos || ''} minutos</p>}
        {procedure.preco != null && <p>Preço: R$ {Number(procedure.preco).toFixed(2)}</p>}

        <form onSubmit={(e) => { e.preventDefault(); alert("Agendamento confirmado!"); onClose(); }}>
          <div className="modal-form-group">
            <label className="modal-label">Nome:</label>
            <input className="modal-input" type="text" placeholder="Seu nome" required />
          </div>

          <div className="modal-form-group">
            <label className="modal-label">Data e Hora:</label>
            <input className="modal-input" type="datetime-local" required />
          </div>

          <div className="modal-buttons">
            <button className="modal-button modal-button-submit" type="submit">Confirmar Agendamento</button>
            <button className="modal-button modal-button-cancel" type="button" onClick={onClose}>Cancelar</button>
          </div>
        </form>

      </div>
    </div>
  );
};

export default ScheduleModal;
