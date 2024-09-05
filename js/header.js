// script.js


// Scrolling function
let lastScrollTop = 0;
const header = document.getElementById('header');

window.addEventListener('scroll', () => {
    const currentScroll = window.scrollY || document.documentElement.scrollTop;
    
    if (currentScroll > lastScrollTop) {
        // Scrolling down
        header.style.top = '-200px'; // Adjust according to the header height or more
    } else {
        // Scrolling up
        header.style.top = '0';
    }
    
    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
});


// pull down menu function
const menuItems = document.querySelectorAll('.menu-item');

menuItems.forEach(menuItem => {
    menuItem.addEventListener('click', (event) => {
        // prevent from trigger other elements
        event.stopPropagation();

        //console.log('Menu item clicked');

        const subMenu = menuItem.querySelector('.sub-menu');
        //console.log('Submenu before:', subMenu.classList.contains('active'));

        const isActive = subMenu.classList.contains('active');

        closeAllSubMenus(); // close all sub-menus first

        // Toggle current sub-menu only if it was not active
        if (!isActive) {
            //console.log('Submenu is not active, activating now');
            subMenu.classList.add('active');
        } else {
            //console.log('Submenu is active, no action taken');
        }

        //console.log('Submenu after:', subMenu.classList.contains('active'));
    });
});

function closeAllSubMenus() {
    menuItems.forEach(item => {
        const subMenu = item.querySelector('.sub-menu');
        if (subMenu) {
            subMenu.classList.remove('active');
        }
    });
}

// close all sub-menus when wherever except menu-items or sub-links are clicked
document.addEventListener('click', closeAllSubMenus);




