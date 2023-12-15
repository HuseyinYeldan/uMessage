navUserDropdown = document.getElementById('navUserDropdown');
userButton = document.getElementById('userButton');

userButton.addEventListener('click', function(){
    if(navUserDropdown.style.display == 'flex'){
        navUserDropdown.style.display = 'none'
        userButton.children[1].classList.add('fa-angle-down');

    }
    else{
        navUserDropdown.style.display = 'flex'
        userButton.children[1].classList.add('fa-angle-up');

    }
});
