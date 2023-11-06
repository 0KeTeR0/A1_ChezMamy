/* the current step of the form */
var cstep = 1;
/* the form selected : student or senior */
var selected = "";


/**
 * remove the "show" class
 * from all the elements
 */
function clear_shown(){
    let elems = document.getElementsByClassName("show");

    while(elems.length>0){
        elems[0].classList.remove("show");
    }
}


/**
 * hide all the previously
 * shown elements
 * and show the student form
 * with its first step
 */
function switch_form_etu(){
    /* only for the appearance of the button */
    let elems = document.getElementsByClassName("btn-selected");
    for(let i=0;i<elems.length;i++){
        elems[i].classList.remove("btn-selected");
    }
    document.getElementById("jeSuisEtudiant").classList.add("btn-selected");


    clear_shown();
    selected="student";
    cstep=1;
    document.getElementsByClassName("registerStep")[0].innerHTML="Etape <span>"+cstep.toString()+"</span>/5";
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
    /* only for the appearance of the button */
    let elems = document.getElementsByClassName("btn-selected");
    for(let i=0;i<elems.length;i++){
        elems[i].classList.remove("btn-selected");
    }
    document.getElementById("jeSuisSenior").classList.add("btn-selected");


    clear_shown();
    selected="senior";
    cstep=1;
    document.getElementsByClassName("registerStep")[0].innerHTML="Etape <span>"+cstep.toString()+"</span>/5";
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
        if(cstep === 1) {
            if (!validateCoordonnesEtudiant()){
                is_valid = false;
            }
        }
        if(is_valid){
            cstep+=1;
            document.getElementsByClassName("registerStep")[0].innerHTML="Etape <span>"+cstep.toString()+"</span>/5";
            document.getElementById("Etudiant_etape"+(cstep-1).toString()).classList.remove("show");
            document.getElementById("Etudiant_etape"+cstep.toString()).classList.add("show");
            scroll(0,0);
        }
    }
    else{
        for (const el of document.getElementById("Senior_etape"+(cstep).toString()).querySelectorAll("[required]")) {
            if (!el.reportValidity()) {
                is_valid=false;
            }
        }
        if(cstep === 1) {
            if (!validateCoordonnesSenior()){
                is_valid = false;
            }
        }
        if(is_valid) {
            cstep+=1;
            document.getElementsByClassName("registerStep")[0].innerHTML="Etape <span>"+cstep.toString()+"</span>/5";
            document.getElementById("Senior_etape" + (cstep - 1).toString()).classList.remove("show");
            document.getElementById("Senior_etape" + cstep.toString()).classList.add("show");
            scroll(0,0);
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

/**
 * show the details input
 * for the allergies
 */
function show_allergies(){
    document.getElementById("allergies_champ").classList.add("show");
}

/**
 * hide the details input
 * for the allergies
 */
function hide_allergies(){
    document.getElementById("allergies_champ").classList.remove("show");
}

/**
 * show the complementary details
 * of the 2nd type of housing
 */
function show_eco(){
    document.getElementById("housing2").classList.add("show");
}

/**
 * hide the complementary details
 * of the 2nd type of housing
 */
function hide_eco(){
    document.getElementById("housing2").classList.remove("show");
}

/**
 * show the complementary details
 * of the 2nd type of housing
 */
function show_solid(){
    document.getElementById("housing3").classList.add("show");
}

/**
 * hide the complementary details
 * of the 2nd type of housing
 */
function hide_solid(){
    document.getElementById("housing3").classList.remove("show");
}


/**
 * show the complementary details
 * of the animal details in the senior
 * form
 */
function show_animals(){
    document.getElementsByClassName("Select-animal")[0].classList.add("show");
}

/**
 * hide the complementary details
 * of the animal details in the senior
 * form
 */
function hide_animals(){
    document.getElementsByClassName("Select-animal")[0].classList.remove("show");
}

/**
 * show the complementary details
 * of the kids field in the senior
 * form
 */
function show_grandkids(){
    let list = document.getElementsByClassName("grand-kids");
    for (let i =0;i<list.length;i++){
        list[i].classList.add("show");
    }
}

/**
 * hide the complementary details
 * of the kids field in the senior
 * form
 */
function hide_grandkids(){
    let list = document.getElementsByClassName("grand-kids");
    for (let i =0;i<list.length;i++){
        list[i].classList.remove("show");
    }
}

/**
 * check if at least one of two field is filled in the Student's form
 * @returns {boolean} False if the two field are empty
 */
function validateCoordonnesEtudiant() {
    if (student_form.phone.value == '' && student_form.email.value == '') {
        alert('Vous devez saisir au moins un numéro de téléphone ou une addresse email');
        return false;
    }
    else return true;
}

/**
 * check if at least one of two field is filled in the Senior's form
 * @returns {boolean} False if the two field are empty
 */
function validateCoordonnesSenior() {
    if (senior_form.phone.value == '' && senior_form.email.value == '') {
        alert('Vous devez saisir au moins un numéro de téléphone ou une addresse email');
        return false;
    }
    else return true;
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

document.getElementById("allergie_oui").addEventListener("click",show_allergies);
document.getElementById("allergie_non").addEventListener("click",hide_allergies);

document.getElementById("lgmtEco+").addEventListener("click",show_eco);
document.getElementById("lgmtGratuit").addEventListener("click",hide_eco);
document.getElementById("lgmtGratuit").addEventListener("click",hide_solid);
document.getElementById("lgmtEco+").addEventListener("click",hide_solid);
document.getElementById("lgmtSolid").addEventListener("click",hide_eco);
document.getElementById("lgmtSolid").addEventListener("click",show_solid);

document.getElementById("animal_oui").addEventListener("click",show_animals);
document.getElementById("animal_non").addEventListener("click",hide_animals);

document.getElementById("oui_enfants").addEventListener("click",show_grandkids);
document.getElementById("non_enfants").addEventListener("click",hide_grandkids);
