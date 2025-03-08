let menuVisible = false;

function toggleMenu() {
    const menuContainer = document.getElementById('menu-container');
    const content = document.querySelector('.content');

    if (menuVisible) {
        menuContainer.classList.remove('visible');
        content.classList.remove('shifted');
    } else {
        menuContainer.classList.add('visible');
        content.classList.add('shifted');
    }
    menuVisible = !menuVisible;
}

