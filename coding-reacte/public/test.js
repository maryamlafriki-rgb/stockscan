function startbox({label,value,color}){
    return(
        <div style={{bortherleft:`4px solid ${color},padding:"12px"`}}>
            <h4> {label}</h4>
            <strong>{value}</strong>
        </div>
    );
}
function dashboard(){
    return(
        <>
        <startbox label='session active'value={876}color='green' />
        <startbox label='taux de coversation'value='4.2%'color='bleux' />
        </>
      );
}