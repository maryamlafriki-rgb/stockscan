import { useDispatch } from "react-redux"

export default function Actions(){
    const dispatch =useDispatch()
    return<>
    
    <button onClick={() =>
        dispatch(resetAbsence())
    }> Reset absence</button>
    
    

    
    </>
}