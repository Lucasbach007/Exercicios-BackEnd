import api from "./axios";

/* =======================
   AUTH
======================= */

export async function registerUser(data) {
  const response = await api.post("/register", data);
  return response.data;
}

export async function loginUser(data) {
  const response = await api.post("/login", data);
  return response.data;
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
  if (data.imagem instanceof File) {
    const formData = new FormData();
    formData.append("nome", data.nome);
    formData.append("descricao", data.descricao || "");
    formData.append("preco", data.preco);
    formData.append("duracao_minutos", data.duracao_minutos || "");
    formData.append("imagem", data.imagem);

    const response = await api.post("/servicos", formData, {
      headers: {
        "Content-Type": "multipart/form-data",
      },
    });

    return response.data;
  }

  const response = await api.post("/servicos", data);
  return response.data;
}
