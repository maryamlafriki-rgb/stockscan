export const selectProducts = (state) => state.products;

export const selectProductById = (state, productId) =>state.products.find(product => product.id === productId);

export const selectTotalPrice = (state) =>state.products.reduce((total, product) => total + product.price, 0);

