import { Link } from "react-router-dom";

export default function Navbar() {
  return (
    <nav>
      <Link to="/">Produits</Link> | <Link to="/cart">Panier</Link>
    </nav>
  );
}