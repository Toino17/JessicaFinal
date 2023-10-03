const gif = document.getElementById('animated-gif');
    setTimeout(function() {
        gif.src = 'img/Logojessica.png'; 
    }, 2600); 

const toggleBtn = document.querySelector('.toggle_btn')
    const toggleBtnIcon = document.querySelector('.toggle_btn')
    const dropDownMenu = document.querySelector('.dropdown_menu')

    toggleBtn.onclick = function() {
        dropDownMenu.classList.toggle('open')
        const isOpen = dropDownMenu.classList.contains('open')
    }