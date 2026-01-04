import { createContext, useContext, useState } from "react";
import { loginUser, logoutUser } from "../services/api";
import { useNavigate } from "react-router-dom";

const AuthContext = createContext();

export function AuthProvider({ children }) {
  const [user, setUser] = useState(
    JSON.parse(localStorage.getItem("user"))
  );
  const [token, setToken] = useState(
    localStorage.getItem("token")
  );

  const navigate = useNavigate();

  async function login(email, password) {
    const data = await loginUser({ email, password });

    localStorage.setItem("token", data.token);
    localStorage.setItem("user", JSON.stringify(data.user));

    setToken(data.token);
    setUser(data.user);

    navigate("/");
  }

  async function logout() {
    if (token) {
      try {
        await logoutUser(token);
      } catch (e) {
        console.error(e);
      }
    }

    localStorage.clear();
    setToken(null);
    setUser(null);
    navigate("/login");
  }

  return (
    <AuthContext.Provider value={{ user, token, login, logout }}>
      {children}
    </AuthContext.Provider>
  );
}

export function useAuth() {
  return useContext(AuthContext);
}
