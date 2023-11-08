

//Open the burger menu
function OpenBurger(){
    document.getElementById('menu').classList.toggle('active');
}


//close the burger menu
function CloseBurger(){
    document.getElementById('menu').classList.toggle('active');
}

document.getElementsByClassName("menuBurger")[0].addEventListener("click", OpenBurger);

document.getElementsByClassName("closeMenu")[0].addEventListener("click", CloseBurger);
