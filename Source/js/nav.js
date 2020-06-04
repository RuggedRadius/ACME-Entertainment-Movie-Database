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
    document.getElementById("navMenu").style.width = '100%';
    document.getElementById("navMenu").style.height = '100%';
}


function hideMenu() {
    document.getElementById("navMenu").style.width = '0px';
    document.getElementById("navMenu").style.height = '0px';
    setTimeout(function() {
        // document.getElementById("navMenu").style.display = 'none';
    }, 250);

}