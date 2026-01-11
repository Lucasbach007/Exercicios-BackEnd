import './Prod.css';

const resolveImageSrc = (imgPath) => {
  if (!imgPath) return '';
  if (imgPath.startsWith('http') || imgPath.startsWith('//')) return imgPath;
  const apiBase = (import.meta.env.VITE_API_BASE_URL || '').replace(/\/api\/?$/i, '') || window.location.origin;
  return `${apiBase}/storage/${imgPath}`;
};

const ProdCard = ({ product, onComprar }) => {
  const imageSrc = resolveImageSrc(product.imagem_url || product.imagem || product.image || '');
  return (
    <div className="product-card">
      <img src={imageSrc} alt={product.nome} className="product-image" onError={(e)=>{e.target.style.display='none'}} />
      <div className="product-content">
        <div>
          <h3 className="product-title">{product.nome}</h3>
          {product.descricao && <p className="product-description">{product.descricao}</p>}
          {product.marca && <p><strong>Marca:</strong> {product.marca}</p>}
        </div>

        <div>
          <div className="product-price">R$ {Number(product.preco || product.price || 0).toFixed(2)}</div>
          <div className="product-footer">
            <button className="product-btn product-btn-add" onClick={() => onComprar && onComprar(product)}>Comprar</button>
            <button className="product-btn product-btn-view" onClick={() => alert('Ver detalhes ainda não implementado')}>Ver</button>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ProdCard;
