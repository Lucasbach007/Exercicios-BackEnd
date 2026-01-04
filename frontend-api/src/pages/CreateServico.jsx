import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { createServico } from "../services/api";

function CreateServico() {
  const navigate = useNavigate();
  const [form, setForm] = useState({
    nome: "",
    descricao: "",
    preco: "",
    duracao_minutos: "",
    imagem: null
  });

  const [preview, setPreview] = useState(null);
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  function handleChange(e) {
    const { name, value } = e.target;
    setForm(prev => ({
      ...prev,
      [name]: value
    }));
  }

  function handleImageChange(e) {
    const file = e.target.files[0];
    if (file) {
      setForm(prev => ({
        ...prev,
        imagem: file
      }));
      // Criar preview da imagem
      const reader = new FileReader();
      reader.onloadend = () => {
        setPreview(reader.result);
      };
      reader.readAsDataURL(file);
    }
  }

  async function handleSubmit(e) {
    e.preventDefault();
    setError("");
    setLoading(true);

    try {
      // Validar campos obrigatórios
      if (!form.nome || !form.preco) {
        throw new Error("Nome e preço são obrigatórios");
      }

      const data = {
        nome: form.nome,
        descricao: form.descricao || null,
        preco: parseFloat(form.preco),
        duracao_minutos: form.duracao_minutos ? parseInt(form.duracao_minutos) : null,
        imagem: form.imagem
      };

      await createServico(data);
      navigate("/");
    } catch (err) {
      setError(err.message || "Erro ao criar serviço");
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="container">
      <div className="form-container">
        <h1>Adicionar Serviço</h1>

        {error && <div className="alert alert-danger">{error}</div>}

        <form onSubmit={handleSubmit}>
          <div className="form-group">
            <label htmlFor="nome">Nome *</label>
            <input
              type="text"
              id="nome"
              name="nome"
              placeholder="Nome do serviço"
              value={form.nome}
              onChange={handleChange}
              className="form-control"
              required
            />
          </div>

          <div className="form-group">
            <label htmlFor="descricao">Descrição</label>
            <textarea
              id="descricao"
              name="descricao"
              placeholder="Descrição do serviço"
              value={form.descricao}
              onChange={handleChange}
              className="form-control"
              rows="4"
            />
          </div>

          <div className="form-group">
            <label htmlFor="preco">Preço *</label>
            <input
              type="number"
              id="preco"
              name="preco"
              placeholder="0.00"
              value={form.preco}
              onChange={handleChange}
              className="form-control"
              step="0.01"
              min="0"
              required
            />
          </div>

          <div className="form-group">
            <label htmlFor="duracao_minutos">Duração (minutos)</label>
            <input
              type="number"
              id="duracao_minutos"
              name="duracao_minutos"
              placeholder="60"
              value={form.duracao_minutos}
              onChange={handleChange}
              className="form-control"
              min="0"
            />
          </div>

          <div className="form-group">
            <label htmlFor="imagem">Imagem</label>
            <input
              type="file"
              id="imagem"
              name="imagem"
              accept="image/*"
              onChange={handleImageChange}
              className="form-control"
            />
            {preview && (
              <div className="preview-container">
                <img src={preview} alt="Preview" className="preview-image" />
              </div>
            )}
          </div>

          <div className="form-actions">
            <button type="submit" disabled={loading} className="btn-primary">
              {loading ? "Criando..." : "Adicionar Serviço"}
            </button>
            <button 
              type="button" 
              onClick={() => navigate("/")} 
              className="btn-secondary"
            >
              Cancelar
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}

export default CreateServico;

