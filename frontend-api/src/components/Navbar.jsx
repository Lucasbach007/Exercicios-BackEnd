// src/components/Navbar.jsx
import { Link } from "react-router-dom";
import "./Navbar.css";
function Navbar() {
  return (
    <nav className="navbar">
      <div className="nav-container">
        <div className="nav-brand">
          <Link to="/" className="logo"></Link>
        </div>
        <ul className="nav-menu">
          <li><Link to="/">Serviços</Link></li>
          <li><Link to="/servicos/criar">+ Serviço</Link></li>
          <li><Link to="/login">Login</Link></li>
          <li><Link to="/produtos">Produtos</Link></li>
          <li><Link to="/produtos/criar">+ Produto</Link></li>
          <li><Link to="/register">Registrar</Link></li>
          <li><Link to="/logout">Sair</Link></li>
          <li><Link to="/profile">Perfil</Link></li>
        </ul>
      </div>
    </nav>
  );
}

export default Navbar;
