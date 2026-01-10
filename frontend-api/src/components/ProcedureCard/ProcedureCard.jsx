import React from 'react';
import './ProcedureCard.css';
// Supondo que a estrutura da procedure seja: {id, nome, descricao, imagemUrl}
const ProcedureCard = ({ procedure, onAgendar }) => {
  const imageSrc = procedure.imagem_url || procedure.imagem || procedure.imagemUrl || procedure.image || '';
  return (
    <div className="procedure-card">
      
      {/* Imagem */}
      <img 
        src={imageSrc} 
        alt={procedure.nome}
        className="procedure-image"
        onError={(e) => { e.target.style.display = 'none'; }}
      />
      
      {/* Conteúdo */}
      <div className="procedure-info">
        
        <h3 className="procedure-title">
          {procedure.nome}
        </h3>

        {procedure.descricao && (
          <p className="procedure-description">
            {procedure.descricao}
          </p>
        )}
        
        {procedure.preco != null && (
          <p className="procedure-price">R$ {Number(procedure.preco).toFixed(2)}</p>
        )}

        <button
          onClick={() => onAgendar && onAgendar(procedure)}
          className="procedure-button"
          style={{ "--procedure-color": procedure.cor || undefined }}
        >
          Agendar
        </button>
      </div>
    </div>
  );
};

export default ProcedureCard;
