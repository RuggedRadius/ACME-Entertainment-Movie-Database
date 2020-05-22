// // Get stuff
// var base = "https://api.themoviedb.org/3/search/movie?api_key=";
// var api_key = "f2e15980f239d4c99375ace9706067c5";
// var qryString = base + api_key + "&query=" + "Jack+Reacher";
var base = "https://api.themoviedb.org/3/search/movie?api_key=";
var imgURLBase = "https://image.tmdb.org/t/p/w600_and_h900_bestv2";
var api_key = "f2e15980f239d4c99375ace9706067c5";
var movies = document.getElementsByClassName("movie-display");


console.log("Loading " + movies.length + " image(s)...");
for (var i = 0; i < movies.length; i++) {

    // Get title
    var movieTitle = movies[i].id;

    // Get image
    var img = movies[i].getElementsByClassName("movie-poster")[0];

    // Fix query
    var query = FixQuery(movieTitle);
    console.log("Searching for movie: " + query);

    // Generate request
    var request = GenerateRequest(query);

    // Get and load image
    GetImageURLbyQuery(request, img);
}




var discoveries = document.getElementsByClassName("discover-display");
console.log("Loading " + discoveries.length + " image(s)...");
for (var i = 0; i < discoveries.length; i++) {

    // Get title
    var movieTitle = discoveries[i].id;

    // Get image
    var img = discoveries[i].getElementsByClassName("movie-poster")[0];

    // Fix query
    var query = FixQuery(movieTitle);
    console.log("Searching for movie: " + query);

    // Generate request
    var request = GenerateRequest(query);

    // Get and load image
    GetImageURLbyQuery(request, img);
}







function FixQuery(query) {
    // Remove anything after a '('
    var bsIndex = query.indexOf('(');
    if (bsIndex >= 0) {
        query = query.substring(0, bsIndex);
    }

    // var bsIndex = query.indexOf(':');
    // if (bsIndex >= 0) {
    //     query = query.substring(0, bsIndex);
    // }

    // query = query.replace(':', '');
    query = query.replace(' ', '+');
    query = query.replace(' ', '+');
    query = query.replace(' ', '+');
    query = query.replace(' ', '+');
    query = query.replace(' ', '+');
    query = query.replace(' ', '+');
    query = query.replace(' ', '+');
    query = query.replace(' ', '+');
    query = query.replace(' ', '+');
    return query;
}

function GenerateRequest(query) {
    return "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=" + query;
}




function GetImageURLbyQuery(request, imgBox) {
    // Fetch JSON containing poster url
    var imageURL;
    console.log("Fetching JSON...");
    $.getJSON(request, function (data) {
        //data is the JSON string
        if (data["results"][0] == null) {
            imageURL = "./images/download.png";
        }
        else {
            if (data["results"][0]["poster_path"] != null && data["results"][0]["poster_path"] != "")
            {
                imageURL = imgURLBase + data["results"][0]["poster_path"];
                console.log("Image URL: " + imageURL);
            }
            else {
                imageURL = "./images/download.png";
            }
        }
        imgBox.src = imageURL;
    });
}




// var request = base + api_key + "&query=" + "The+Matrix";
// $.getJSON(request, function (data) {
//     //data is the JSON string
//     // Display movie poster
//     var movie = document.getElementById("movie-display");

//     for (var i = 0; i < 5; i++) {
//         console.log(data["results"][i]["original_title"]);
//         movie.innerHTML = data["results"][i]["title"];
//         var imgURLBase = "https://image.tmdb.org/t/p/w600_and_h900_bestv2";
//         var imgURL = imgURLBase + data["results"][i]["poster_path"];
//         movie.innerHTML += "<image src='" + imgURL + "' width='200px'></image>";
//     }

//     // console.log(data["results"][0]["original_title"]);
//     // movie.innerHTML = data["results"][0]["title"];
//     // var imgURLBase = "https://image.tmdb.org/t/p/w600_and_h900_bestv2";
//     // var imgURL = imgURLBase + data["results"][0]["poster_path"];
//     // movie.innerHTML += "<image src='" + imgURL + "' width='200px'></image>";
// });









//  Fetch a poster based on movie ID
// request = "https://api.themoviedb.org/3/movie/550?api_key=" + api_key;
// $.getJSON(request, function (data) {
//     //data is the JSON string
//     // Sample Image URL = "https://image.tmdb.org/t/p/w600_and_h900_bestv2/aQvJ5WPzZgYVDrxLX4R6cLJCEaQ.jpg";
//     var imgURLBase = "https://image.tmdb.org/t/p/w600_and_h900_bestv2";
//     var imgURL = imgURLBase + data["poster_path"];

//     // Display movie poster
//     var movie = document.getElementById("movie-display");
//     movie.innerHTML = "<image src='" + imgURL + "' width='500px'></image>";
// });


