const API_URL = import.meta.env.VITE_API_BASE_URL || "http://localhost:8000/api";

function authHeaders() {
  const token = localStorage.getItem('token');
  return token ? { Authorization: `Bearer ${token}` } : {};
}

export async function registerUser(data) {
  const response = await fetch(`${API_URL}/register`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
      ...authHeaders()
    },
    body: JSON.stringify(data)
  });

  const result = await response.json();

  if (!response.ok) {
    throw result;
  }

  return result;
}

export async function loginUser(data) {
  const response = await fetch(`${API_URL}/login`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json"
    },
    body: JSON.stringify(data)
  });

  const result = await response.json();

  if (!response.ok) {
    const message = result && result.message ? result.message : JSON.stringify(result);
    throw new Error(message);
  }

 

  return result;
}

export async function getProdutos() {
  const response = await fetch(`${API_URL}/produtos`, {
    headers: {
      "Accept": "application/json",
      ...authHeaders()
    }
  });

  if (!response.ok) throw await response.json();
  return response.json();
}

export async function getServicos() {
  const response = await fetch(`${API_URL}/servicos`, {
    headers: {
      "Accept": "application/json",
      ...authHeaders()
    }
  });

  if (!response.ok) throw await response.json();
  return response.json();
}

export async function createServico(data) {
  // Se tem imagem, usa FormData
  if (data.imagem instanceof File) {
    const formData = new FormData();
    formData.append('nome', data.nome);
    formData.append('descricao', data.descricao || '');
    formData.append('preco', data.preco);
    formData.append('duracao_minutos', data.duracao_minutos || '');
    formData.append('imagem', data.imagem);

    const response = await fetch(`${API_URL}/servicos`, {
      method: "POST",
      headers: {
        "Accept": "application/json",
        ...authHeaders()
      },
      body: formData
    });

    const result = await response.json();
    if (!response.ok) throw result;
    return result;
  }

  // Sem imagem, usa JSON
  const response = await fetch(`${API_URL}/servicos`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
      ...authHeaders()
    },
    body: JSON.stringify(data)
  });

  const result = await response.json();
  if (!response.ok) throw result;
  return result;
}

export async function deleteProduto(id) {
  const response = await fetch(`${API_URL}/produtos/${id}`, {
    method: 'DELETE',
    headers: {
      'Accept': 'application/json',
      ...authHeaders()
    }
  });

  if (!response.ok) throw await response.json();
  return true;
}

export async function deleteServico(id) {
  const response = await fetch(`${API_URL}/servicos/${id}`, {
    method: 'DELETE',
    headers: {
      'Accept': 'application/json',
      ...authHeaders()
    }
  });

  if (!response.ok) throw await response.json();
  return true;
}

export async function createProduto(data) {
  // Se tem imagem, usa FormData
  if (data.imagem instanceof File) {
    const formData = new FormData();
    formData.append('nome', data.nome);
    formData.append('descricao', data.descricao || '');
    formData.append('preco', data.preco);
    formData.append('estoque', data.estoque || 0);
    formData.append('imagem', data.imagem);

    const response = await fetch(`${API_URL}/produtos`, {
      method: "POST",
      headers: {
        "Accept": "application/json",
        ...authHeaders()
      },
      body: formData
    });

    const result = await response.json();
    if (!response.ok) throw result;
    return result;
  }

  // Sem imagem, usa JSON
  const response = await fetch(`${API_URL}/produtos`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      "Accept": "application/json",
      ...authHeaders()
    },
    body: JSON.stringify(data)
  });

  const result = await response.json();
  if (!response.ok) throw result;
  return result;
}
export async function logoutUser() {
  const response = await fetch(`${API_URL}/logout`, {
    method: "POST",
    headers: {
      "Accept": "application/json",
      ...authHeaders()
    }
  });

  if (!response.ok) {
    throw await response.json();
  }

  // limpa tudo no front
  localStorage.removeItem("token");
  localStorage.removeItem("user");

  return true;
}

export async function updateUserFoto(userId, fotoFile) {
  const formData = new FormData();
  formData.append("foto", fotoFile);

  const response = await fetch(`${API_URL}/usuarios/${userId}/foto`, {
    method: "POST",
    headers: {
      "Accept": "application/json",
      ...authHeaders()
    },
    body: formData
  });

  const result = await response.json();
  if (!response.ok) throw result;

  return result;
}
