function notify(msg, length, redirection) {
    console.log("Sending notification...");
    // Create div
    var note = document.createElement("div");
    note.className = "notification";
    note.innerHTML = "<p>" + msg + "</p>";
    note.style.opacity = 0;
    document.body.appendChild(note);

    // Fade In
    setTimeout(function () {
        note.style.opacity = 1;
    }, 0);

    // Timeout
    setTimeout(function () {
        // Fade Out
        note.style.opacity = 0;

        // Destroy Timeout
        setTimeout(function () {
            // Destroy
            note.parentNode.removeChild(note);

            // Redirect page
            if (redirection != null) {
                window.location = redirection;
            }
        }, 1000);
    }, length);
}

function bePatient() {
    console.log("Sending notification...");
    // Create div
    var note = document.createElement("div");
    note.className = "notification";
    note.innerHTML = "<p id='notify-p'>Please be patient while the chart is loading...</p>";
    note.style.opacity = 0;
    document.body.appendChild(note);

    // Fade In

    setTimeout(function () {
        note.style.opacity = 1;
    }, 0);

    // Flash
    setInterval(function () {
        note.style.color = "#000000";
        setTimeout(function () {
            note.style.color = "#FFFFFF";
        }, 500);
    }, 1000);

    // Scroll
    var text = document.getElementById("notify-p");

    var pos = 100;
    setInterval(function () {
        text.style.transform = 'translateX(' + pos + 'vw)';
        pos--;
        // for (var i = 100; i > -100; i++) {
        //     text.style.transform = 'translateX(' + i + 'vw)';
        //     setTimeout(function () { }, 500);
        // }
    }, 50);
    setInterval(function () {
        pos = 100;
    }, 10000);

    // Timeout
    setTimeout(function () {
        // Fade Out
        note.style.opacity = 0;

        // Destroy Timeout
        setTimeout(function () {
            // Destroy
            note.parentNode.removeChild(note);
        }, 1000);
    }, 60000);
}

