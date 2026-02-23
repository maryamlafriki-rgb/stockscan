function ProductPage(){
    function handleSelect (productId){
        console.loge ("produit selectionne:",productId);

    }
    return <ProductDetails productId={42} onSelect={handleSelect}/>;
}
function ProductDetails({productId,onSelect}){
    
    return (
        <div>
            <p>Produit #{productId}</p>
            <button onClick={()=> onSelect(productId)}> selectiner ce produit </button>
        </div>
    )
}
export default ProductPage;