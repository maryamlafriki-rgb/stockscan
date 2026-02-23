export const selectAllProducts = state => state.products;


export const selectProductById = (state, id) =>
state.products.find(p => p.id === Number(id));


export const selectProductsByCategory = (state, category) =>
state.products.filter(p => p.category === category);


