$("#movie-details-filter").height($('.movie-details').height() + 200);
var elemDetails = document.getElementsByClassName("movie-details")[0];
var elemFilter = document.getElementById("movie-details-filter");

console.log("Display filter adjusted to fit content.");
console.log($('.movie-details').height());
console.log($("#movie-details-filter").height());