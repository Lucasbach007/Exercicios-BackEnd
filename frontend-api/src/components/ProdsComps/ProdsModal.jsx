import "./ScheduleModal.css";

const ProdModal = ({ product, onClose }) => {
  if (!product) return null;

  return (
    <div className="modal-overlay">
      <div className="modal-content">
        <div className="modal-header">
          <h2>Comprar: {product.nome}</h2>
          <button className="modal-close" onClick={onClose}>×</button>
        </div>

        <p>Marca: {product.marca}</p>
        <p>Preço: R$ {Number(product.preco || product.price || 0).toFixed(2)}</p>

        <form onSubmit={(e) => { e.preventDefault(); alert("COMPRA EFETUADA!"); onClose(); }}>
          <div className="modal-form-group">
            <label className="modal-label">Nome:</label>
            <input className="modal-input" type="text" placeholder="Seu nome" required />
          </div>

          <div className="modal-form-group">
            <label className="modal-label">Quantidade:</label>
            <input className="modal-input" type="number" min="1" defaultValue="1" required />
          </div>

          <div className="modal-buttons">
            <button className="modal-button modal-button-submit" type="submit">Confirmar Compra</button>
            <button className="modal-button modal-button-cancel" type="button" onClick={onClose}>Cancelar</button>
          </div>
        </form>

      </div>
    </div>
  );
};

export default ProdModal;
