import { combineReducers } from "redux";
import productsReducer from "../features/products/productsReducer";
import cartReducer from "../features/cart/cartReducer";

export default combineReducers({
  products: productsReducer,
  cart: cartReducer
});  