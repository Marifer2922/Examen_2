window.addEventListener('DOMContentLoaded', function () {
    const botonMenu = document.getElementById('sidebarToggle');
    if (botonMenu) {
        botonMenu.addEventListener('click', function () {
            document.body.classList.toggle('sidenav-abierto');
        });
    }
});
