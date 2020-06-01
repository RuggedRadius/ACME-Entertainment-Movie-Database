var base = "https://api.themoviedb.org/3/search/movie?api_key=";
var imgURLBase = "https://image.tmdb.org/t/p/w600_and_h900_bestv2";
var api_key = "f2e15980f239d4c99375ace9706067c5";

var movies = document.getElementsByClassName("movie-details");

console.log("Loading " + movies.length + " image(s)...");
for (var i = 0; i < movies.length; i++)
{
    // Get title
    var movieTitle = movies[i].id;

    // Get image
    var img = document.getElementsByClassName("movie-poster")[0];

    // Fix query
    var query = FixQuery(movieTitle);
    console.log("Searching for movie: " + query);

    // Generate request
    var request = GenerateRequest(query);

    // Get and load image
    GetImageURLbyQuery(request, img); //, movies[i]
}


function FixQuery(query) {
    query = query.replace(' ', '+');
    return query;
}

function GenerateRequest(query) {
    return "https://api.themoviedb.org/3/search/movie?api_key=f2e15980f239d4c99375ace9706067c5&query=" + query;
}

function GetImageURLbyQuery(request, imgBox) {
    // Fetch JSON containing poster url
    var imageURL = "./images/download.png";

    console.log("Fetching JSON... " + request);

    $.getJSON(request, function (data) {
        //data is the JSON string
        if (data == null) {
            imageURL = "./images/download.png";
        }
        if (data["results"][0] == null) {
            imageURL = "./images/download.png";
        }
        else {
            imageURL = imgURLBase + data["results"][0]["poster_path"];
            // console.log("Image URL: " + imageURL);

            var bgURL = imgURLBase + data["results"][0]["backdrop_path"];
            // console.log(bgURL);
            document.getElementById("bg-img").style.backgroundImage = "url(" + bgURL + ")";

            document.getElementById('movie-overview').innerText = data["results"][0]["overview"];
        }
        // imgBox.src = imageURL;
        document.getElementsByClassName("movie-poster-large")[0].src = imageURL;
    });
}