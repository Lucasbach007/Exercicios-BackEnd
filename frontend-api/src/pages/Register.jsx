import { useState } from "react";
import { registerUser } from "../services/api";
import { useNavigate } from "react-router-dom";

function Register() {
  const navigate = useNavigate();

  const [form, setForm] = useState({
    name: "",
    email: "",
    password: "",
    password_confirmation: ""
  });

  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  function handleChange(e) {
    setForm({
      ...form,
      [e.target.name]: e.target.value
    });
  }

  async function handleSubmit(e) {
    e.preventDefault();
    setError("");
    setLoading(true);

    try {
      const response = await registerUser(form);

      console.log("Usuário criado:", response);

      // 👉 se vier token
      if (response.token) {
        localStorage.setItem("token", response.token);
      }

      navigate("/login"); // ou /home
    } catch (err) {
      setError(err.message || "Erro ao cadastrar");
    } finally {
      setLoading(false);
    }
  }

  return (
    <div>
      <h2>Cadastro</h2>

      {error && <p style={{ color: "red" }}>{error}</p>}

      <form onSubmit={handleSubmit}>
        <input
          type="text"
          name="name"
          placeholder="Nome"
          onChange={handleChange}
          required
        />

        <input
          type="email"
          name="email"
          placeholder="Email"
          onChange={handleChange}
          required
        />

        <input
          type="password"
          name="password"
          placeholder="Senha"
          onChange={handleChange}
          required
        />

        <input
          type="password"
          name="password_confirmation"
          placeholder="Confirmar senha"
          onChange={handleChange}
          required
        />

        <button type="submit" disabled={loading}>
          {loading ? "Cadastrando..." : "Cadastrar"}
        </button>
      </form>
    </div>
  );
}

export default Register;
