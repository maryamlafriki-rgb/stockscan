import { useParams } from "react-router-dom";
import { useDispatch, useSelector } from "react-redux";
import { selectProductById } from "../features/products/productsSelectors";
import { addToCart } from "../features/cart/cartActions";

export default function ProductDetails() {
  const { id } = useParams();
  const dispatch = useDispatch();
  const product = useSelector(state => selectProductById(state, id));

  return (
    <div>
      <h2>{product.title}</h2>
      <img src={product.thumbnail} width="150" />
      <p>Prix : {product.price} $</p>
      <button onClick={() => dispatch(addToCart(product))}>
        Ajouter au panier
      </button>
    </div>
  );
}