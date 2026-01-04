import { useEffect } from "react";
import { useAuth } from "../context/AuthContext";

function Logout() {
  const { logout } = useAuth();

  useEffect(() => {
    logout();
  }, []);

  return <p>Saindo...</p>;
}

export default Logout;
