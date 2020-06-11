function unsubscribe() {
    document.getElementById("monthly").checked = false;
    document.getElementById("burst").checked = false;
    document.getElementById("btn-submit").innerText = "Update My Subscription";
}

function clearUnsubscribeCheck() {
    document.getElementById("remove").checked = false;
    document.getElementById("btn-submit").innerText = "Subscribe";
}