window.onload = (e) => {
    navUserDropdown = document.getElementById('navUserDropdown');
    navUserDropdownIcon = document.getElementById('navUserDropdownIcon');

    userButton = document.getElementById('userButton');

    userButton.addEventListener('click', function () {
        if (navUserDropdown.style.display == 'flex') {
            navUserDropdown.style.display = 'none'
            navUserDropdownIcon.style.transform = 'rotate(0deg)'
        }
        else {
            navUserDropdown.style.display = 'flex'
            navUserDropdownIcon.style.transform = 'rotate(-180deg)'
        }
    });

}
