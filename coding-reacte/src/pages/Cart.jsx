import { useSelector } from "react-redux";
import { Link } from "react-router-dom";
import { selectAllProducts } from "../features/products/productsSelectors";

export default function Products() {
  const products = useSelector(selectAllProducts);

  return (
    <div>
      <h2>Produits</h2>
      {products.map(p => (
        <div key={p.id}>
          <img src={p.thumbnail} width="100" />
          <h4>{p.title}</h4>
          <p>{p.price} $</p>
          <Link to={`/products/${p.id}`}>Détails</Link>
        </div>
      ))}
    </div>
  );
}




