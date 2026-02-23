import { ADD_TO_CART, REMOVE_FROM_CART, CLEAR_CART } from "./cartActions";

const initialState = { items: [] };

export default function cartReducer(state = initialState, action) {
  switch (action.type) {
    case ADD_TO_CART: {
      const existing = state.items.find(i => i.id === action.payload.id);
      if (existing) {
        return {
          ...state,
          items: state.items.map(i =>
            i.id === existing.id ? { ...i, quantity: i.quantity + 1 } : i
          )
        };
      }
      return {
        ...state,
        items: [...state.items, { ...action.payload, quantity: 1 }]
      };
    }

    case REMOVE_FROM_CART:
      return {
        ...state,
        items: state.items.filter(i => i.id !== action.payload)
      };

    case CLEAR_CART:
      return initialState;

    default:
      return state;
  }
}