// src/App.jsx
import { Routes, Route } from "react-router-dom";
import Servicos from "./pages/Servicos";
import Produtos from "./pages/Produtos";
import CreateServico from "./pages/CreateServico";
import CreateProduto from "./pages/CreateProduto";
import Navbar from "./components/Navbar";
import Register from "./pages/Register";
import Login from "./pages/Login";
import Logout from "./pages/Logout";
import Profile from "./pages/Profile";
function App() {
  return (
      <>
        <Navbar />
        <Routes>
          <Route path="/" element={<Servicos />} />
          <Route path="/login" element={<Login/>} />
          <Route path="/servicos/criar" element={<CreateServico />} />
          <Route path="/produtos" element={<Produtos />} />
          <Route path="/produtos/criar" element={<CreateProduto />} />
          <Route path="/register" element={<Register />} />
          <Route path="/logout" element={<Logout />} />
          <Route path="/profile" element={<Profile />} />
        </Routes>
      </>
  );
}

export default App;
