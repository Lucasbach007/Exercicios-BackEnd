import './Prod.css';

const resolveImageSrc = (imgPath) => {
  if (!imgPath) return '';
  if (imgPath.startsWith('http') || imgPath.startsWith('//')) return imgPath;
  const apiBase = (import.meta.env.VITE_API_BASE_URL || '').replace(/\/api\/?$/i, '') || window.location.origin;
  return `${apiBase}/storage/${imgPath}`;
};

const ProdCard = ({ product, onComprar }) => {
  const resolved = product.imagem_url || product.imagem || product.image || '';
  const imageSrc = resolveImageSrc(resolved);

  const PLACEHOLDER = "data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='400' height='300'><rect width='100%' height='100%' fill='%23e5e7eb'/><text x='50%' y='50%' dominant-baseline='middle' text-anchor='middle' fill='%23999' font-family='Arial' font-size='20'>Sem imagem</text></svg>";
  return (
    <div className="product-card">
      <img src={imageSrc || PLACEHOLDER} alt={product.nome} className="product-image" onError={(e)=>{ if (e.target.src !== PLACEHOLDER) e.target.src = PLACEHOLDER }} />
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
