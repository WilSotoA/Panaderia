const slider = document.querySelector("#slider");
let sliderSection = document.querySelectorAll(".slidersection");
let sliderSectionLast = sliderSection[sliderSection.length -1];
 
const btnLeft = document.querySelector("#flechaizquierda");
const btnRight = document.querySelector("#flechaderecha");

slider.insertAdjacentElement("afterbegin", sliderSectionLast);

function Next() {
    let sliderSectionFirst = document.querySelectorAll(".slidersection")[0];
    slider.style.marginLeft = "-200%";
    slider.style.transition = "all 0.5s";
    setTimeout(function(){
        slider.style.transition = "none";
        slider.insertAdjacentElement('beforeend', sliderSectionFirst);
        slider.style.marginLeft = "-100%";
    }, 500);
}

function Prev() {
    let sliderSection = document.querySelectorAll(".slidersection");
    let sliderSectionLast = sliderSection[sliderSection.length -1];
    slider.style.marginLeft = "0";
    slider.style.transition = "all 0.5s";
    setTimeout(function(){
        slider.style.transition = "none";
slider.insertAdjacentElement("afterbegin", sliderSectionLast);
        slider.style.marginLeft = "-100%";
    }, 500);
}

btnRight.addEventListener('click', function(){
    Next();
});
btnLeft.addEventListener('click', function(){
    Prev();
});

setInterval(function(){
    Next();
},5000);