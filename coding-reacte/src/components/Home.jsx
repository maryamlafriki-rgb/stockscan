import { useSelector} from "react-redux"

 export default function Home(){
    const absences =useSelector(state=>state.absences)
     const theme =useSelector(state=>state.theme)
    return(

    
    <div>
<p>Absences: {absences}</p>
<p>Theme: {theme}</p>
    </div> 
    )
 }