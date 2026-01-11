import React from 'react';
import './ProcedureCard.css';

const resolveImageSrc = (imgPath) => {
  if (!imgPath) return '';
  if (imgPath.startsWith('http') || imgPath.startsWith('//')) return imgPath;
  const apiBase = (import.meta.env.VITE_API_BASE_URL || '').replace(/\/api\/?$/i, '') || window.location.origin;
  return `${apiBase}/storage/${imgPath}`;
};

// Supondo que a estrutura da procedure seja: {id, nome, descricao, imagem}
const ProcedureCard = ({ procedure, onAgendar }) => {
  const resolved = procedure.imagem_url || procedure.imagem || procedure.imagemUrl || procedure.image || '';
  const imageSrc = resolveImageSrc(resolved);

  const PLACEHOLDER = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='400' height='300'><rect width='100%' height='100%' fill='%23e5e7eb'/><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='%23999' font-family='Arial' font-size='20'>Sem imagem</text></svg>";
  return (
    <div className="procedure-card">
      
      {/* Imagem */}
      <img
        src={imageSrc || PLACEHOLDER}
        alt={procedure.nome}
        className="procedure-image"
        onError={(e) => {
          if (e.target.src !== PLACEHOLDER) e.target.src = PLACEHOLDER;
        }}
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
