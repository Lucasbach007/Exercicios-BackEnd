import api from "./axios";

/* =======================
   AUTH
======================= */

export async function registerUser(data) {
  try {
    const response = await api.post("/register", data);
    return response.data;
  } catch (err) {
    if (err.response && err.response.data) throw err.response.data;
    throw err;
  }
}

export async function loginUser(data) {
  try {
    const response = await api.post("/login", data);
    return response.data;
  } catch (err) {
    if (err.response && err.response.data) throw err.response.data;
    throw err;
  }
}

export async function logoutUser() {
  const response = await api.post("/logout");
  return response.data;
}

/* =======================
   USUÁRIO
======================= */

export async function updateUserFoto(userId, fotoFile) {
  const formData = new FormData();
  formData.append("foto", fotoFile);

  const response = await api.post(
    `/usuarios/${userId}/foto`,
    formData,
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    }
  );

  return response.data;
}

/* =======================
   SERVIÇOS
======================= */

export async function getServicos() {
  const response = await api.get("/servicos");
  return response.data;
}

export async function createServico(data) {
  try {
    if (data.imagem instanceof File) {
      const formData = new FormData();
      formData.append("nome", data.nome);
      formData.append("descricao", data.descricao || "");
      formData.append("preco", data.preco);
      formData.append("duracao_minutos", data.duracao_minutos || "");
      formData.append("imagem", data.imagem);

      const response = await api.post("/servicos", formData);

      return response.data;
    }

    const response = await api.post("/servicos", data);
    return response.data;
  } catch (err) {
    if (err.response && err.response.data) throw err.response.data;
    throw err;
  }
}

/* =======================
   PRODUTOS
======================= */

export async function getProdutos() {
  const response = await api.get("/produtos");
  return response.data;
}

export async function createProduto(data) {
  try {
    if (data.imagem instanceof File) {
      const formData = new FormData();
      formData.append("nome", data.nome);
      formData.append("descricao", data.descricao || "");
      formData.append("preco", data.preco);
      formData.append("estoque", data.estoque || 0);
      formData.append("imagem", data.imagem);

      const response = await api.post("/produtos", formData);
      return response.data;
    }

    const response = await api.post("/produtos", data);
    return response.data;
  } catch (err) {
    if (err.response && err.response.data) throw err.response.data;
    throw err;
  }
}

export async function deleteProduto(produtoId) {
  const response = await api.delete(`/produtos/${produtoId}`);
  return response.data;
}
