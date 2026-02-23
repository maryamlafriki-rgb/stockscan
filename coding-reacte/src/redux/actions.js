import { ADD_ABSENCE } from "./types"
import { RESET_ABSENCES } from "./types"
import { TOGGLE_THEME } from "./types"

export function addAbsence(nbrAbs){
    return {type:ADD_ABSENCE,
        payload:nbrAbs
    }
}
export function restAbsences(){
    return {type:RESET_ABSENCES,
          
    }
}
export function toggleTheme(resAbs){
    return {type:TOGGLE_THEME,
        payload:resAbs
    }
}
