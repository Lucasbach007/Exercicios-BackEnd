import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";

function Profile() {
  const [user, setUser] = useState(null);
  const [foto, setFoto] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const stored = localStorage.getItem("user");
    if (!stored) {
      navigate("/login");
      return;
    }
    setUser(JSON.parse(stored));
  }, []);

  async function uploadFoto(e) {
    e.preventDefault();
    if (!foto) return;

    const formData = new FormData();
    formData.append("foto", foto);

    const res = await fetch(
      `${import.meta.env.VITE_API_BASE_URL}/usuarios/${user.id}/foto`,
      { method: "POST", body: formData }
    );

    const updated = await res.json();
    setUser(updated);
    localStorage.setItem("user", JSON.stringify(updated));
  }

  async function deletarConta() {
    if (!confirm("Deseja realmente excluir sua conta?")) return;

    await fetch(
      `${import.meta.env.VITE_API_BASE_URL}/usuarios/${user.id}`,
      { method: "DELETE" }
    );

    localStorage.clear();
    navigate("/login");
  }

  if (!user) return null;

  return (
    <div className="profile">
      <h1>Meu Perfil</h1>

      <img
        src={
          user.foto
            ? `${import.meta.env.VITE_API_BASE_URL.replace("/api", "")}/storage/${user.foto}`
            : "/avatar.png"
        }
        width={150}
      />

      <p><b>Nome:</b> {user.nome}</p>
      <p><b>Email:</b> {user.email}</p>

      <form onSubmit={uploadFoto}>
        <input type="file" onChange={e => setFoto(e.target.files[0])} />
        <button>Atualizar Foto</button>
      </form>

      <button onClick={deletarConta} style={{ color: "red" }}>
        Excluir Conta
      </button>
    </div>
  );
}

export default Profile;
