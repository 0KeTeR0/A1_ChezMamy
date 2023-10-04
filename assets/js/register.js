/* the current step of the form */
var cstep = 1;
/* the form selected : student or senior */
var selected = "senior";


/**
 * remove the "show" class
 * from all the elements
 */
function clear_shown(){
    if(cstep!=1){
        if(selected=="senior"){
            document.getElementById("Senior_etape"+cstep.toString()).classList.remove("show");
        }
        else{
            document.getElementById("Etudiant_etape"+cstep.toString()).classList.remove("show");
        }
    }
    let elems = document.getElementsByClassName("show");
    for(let i=0;i<elems.length;i++){
        elems[i].classList.remove("show");
    }
}


/**
 * hide all the previously
 * shown elements
 * and show the student form
 * with its first step
 */
function switch_form_etu(){
    clear_shown()
    selected="student";
    cstep=1;
    document.getElementById("student_form").classList.add("show");
    document.getElementById("Etudiant_etape"+cstep.toString()).classList.add("show");
}


/**
 * hide all the previously
 * shown elements
 * and show the senior form
 * with its first step
 */
function switch_form_sen(){
    clear_shown()
    selected="senior";
    cstep=1;
    document.getElementById("senior_form").classList.add("show");
    document.getElementById("Senior_etape"+cstep.toString()).classList.add("show");
}


/**
 * hide the current step of the form
 * and show the next one if all the required
 * fields are satisfied.
 */
function next_step(){
    let is_valid=true;
    if(selected=="student"){
        for (const el of document.getElementById("Etudiant_etape"+(cstep).toString()).querySelectorAll("[required]")) {
            if (!el.reportValidity()) {
                is_valid=false;
            }
        }
        if(is_valid){
            cstep+=1;
            document.getElementsByClassName("registerStep")[0].innerHTML="Etape <span>"+cstep.toString()+"</span>/5";
            document.getElementById("Etudiant_etape"+(cstep-1).toString()).classList.remove("show");
            document.getElementById("Etudiant_etape"+cstep.toString()).classList.add("show");
        }
    }
    else{
        for (const el of document.getElementById("Senior_etape"+(cstep).toString()).querySelectorAll("[required]")) {
            if (!el.reportValidity()) {
                is_valid=false;
            }
        }
        if(is_valid) {
            cstep+=1;
            document.getElementsByClassName("registerStep")[0].innerHTML="Etape <span>"+cstep.toString()+"</span>/5";
            document.getElementById("Senior_etape" + (cstep - 1).toString()).classList.remove("show");
            document.getElementById("Senior_etape" + cstep.toString()).classList.add("show");
        }
    }
}

/**
 * hide the current step of the form
 * and show the previous one
 */
function previous_step(){
    cstep-=1;
    document.getElementsByClassName("registerStep")[0].innerHTML="Etape <span>"+cstep.toString()+"</span>/5";
    if(selected=="student"){
        document.getElementById("Etudiant_etape"+(cstep+1).toString()).classList.remove("show");
        document.getElementById("Etudiant_etape"+cstep.toString()).classList.add("show");
    }
    else{
        document.getElementById("Senior_etape"+(cstep+1).toString()).classList.remove("show");
        document.getElementById("Senior_etape"+cstep.toString()).classList.add("show");
    }
}

/* we bind the buttons to the right functions */
document.getElementById("jeSuisEtudiant").addEventListener("click",switch_form_etu);
document.getElementById("jeSuisSenior").addEventListener("click",switch_form_sen);

let elems= document.getElementsByClassName("registerNextStep");
for(i=0;i<elems.length;i++ ){
    elems[i].addEventListener("click",next_step);
}

elems = document.getElementsByClassName("registerPreviousStep");
for(i=0;i<elems.length;i++){
    elems[i].addEventListener("click",previous_step);
}