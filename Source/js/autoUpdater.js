
var dbCount = 2306;
var currentID = 1;

updateMovie(currentID);
currentID++;
setInterval(function () {
    updateMovie(currentID);
    currentID++;
}, 2000);

function updateMovie(id) {
    // Open update window
    document.getElementById("frame-update").src = 'http://localhost:81/Project/Source/movie.php?id=' + id + '&download=true';
    notify("Updating movie ID: " + id + "...", 1000, null);
    window.open()
}

