var displayed = false;

function toggleNav()
{
    console.log("Toggled nav menu");
    displayed = !displayed;
    if (displayed) {
        showMenu();
    }
    else {
        hideMenu();
    }
}

function showMenu() {
    document.getElementById("navMenu").style.display = 'flex';
}


function hideMenu() {
    document.getElementById("navMenu").style.display = 'none';
}