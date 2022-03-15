var myElts = document.getElementsByClassName("nav-link")
for (let i = 0; i < myElts.length; i++) {
    if(myElts[i].textContent=="Liste des séries")
    myElts[i].style.color="red";
}