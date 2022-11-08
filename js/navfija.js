const nav = document.querySelector('.containernav');
window.addEventListener('scroll', function(){
    nav.classList.toggle('active', window.scrollY > 0);
})