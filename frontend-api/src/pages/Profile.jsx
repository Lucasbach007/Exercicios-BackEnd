import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { updateUserFoto } from "../services/api";

function Profile() {
  const [user, setUser] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const stored = localStorage.getItem("user");
    if (!stored) {
      navigate("/login");
      return;
    }
    setUser(JSON.parse(stored));
  }, [navigate]);

  const handleUploadFoto = async (e) => {
    const file = e.target.files[0];
    if (!file) return;

    try {
      const result = await updateUserFoto(user.id, file);

      const updatedUser = {
        ...user,
        foto: result.foto,
      };

      setUser(updatedUser);
      localStorage.setItem("user", JSON.stringify(updatedUser));

      alert("Foto atualizada com sucesso!");
    } catch (error) {
      console.error(error);
      alert("Erro ao atualizar foto");
    }
  };

  if (!user) return null;

  return (
    <div>
      <div style={{ display: 'flex', gap: 16, alignItems: 'center' }}>
        <img
          src={
            user.foto
              ? `${import.meta.env.VITE_API_BASE_URL.replace("/api", "")}/storage/${user.foto}`
              : "/avatar.png"
          }
          width={150}
          alt={user.name || user.nome || 'Avatar'}
          onError={(e) => { e.target.src = '/avatar.png'; }}
        />

        <div>
          <h2>{user.name || user.nome}</h2>
          <p>{user.email}</p>
          <input type="file" onChange={handleUploadFoto} />
        </div>
      </div>
    </div>
  );
}

export default Profile;
