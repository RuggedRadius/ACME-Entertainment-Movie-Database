var base = "https://api.themoviedb.org/3/search/movie?api_key=";
var imgURLBase = "https://image.tmdb.org/t/p/w600_and_h900_bestv2";
var api_key = "f2e15980f239d4c99375ace9706067c5";

var images = document.getElementsByClassName("movie-poster");

console.log("Loading " + images.length + " image(s)...");
for (var i = 0; i < images.length; i++) {
    // Get title
    var movieTitle = images[i].id;

    // Get image
    var img = images[i];

    // Fix query
    var query = FixQuery(movieTitle);
    console.log("Searching for movie: " + query);

    // Generate request
    var request = GenerateRequest(query);

    // Get and load image
    GetImageURLbyQuery(request, img, images[i]);
}


function FixQuery(query) {


    // Remove anything after a '('
    var bsIndex = query.indexOf('(');
    if (bsIndex >= 0) {
        query = query.substring(0, bsIndex);
    }


    // Remove anything after a ':'
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
    var imageURL = "./images/download.png";

    // Debug
    // console.log("Fetching JSON... " + request);

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
            document.getElementById("bg-img").style.background = "url(" + bgURL + ");";
            document.getElementById('movie-overview').innerText = data["results"][0]["overview"];
        }
        imgBox.src = imageURL;








    });
}

// $("#btnAddList").on('click', function () {
//     jQuery.ajax({
//         type: 'POST',
//         url: document.location.href,
//         dataType: 'json',
//         data: { functionname: 'add', arguments: [true] },
//         success: function (data) {
//             //data returned from php
//             alert("Hocus Pocus");

//         }
//     });
// });
