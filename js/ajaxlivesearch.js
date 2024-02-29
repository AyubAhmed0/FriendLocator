function showHint(str) {
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function () {
        let uic = document.getElementById("hint");
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText + "the respond");
            var data = JSON.parse(this.responseText);
            uic.innerHTML = "";
            data.forEach(function (obj) {
                uic.innerHTML += '<div class="list-group-item"><img src="' + obj.img + '">' + obj.username + '</div>';
            });
        }
    };
    let uic = document.getElementById("hint");
    if (str.length >= 1) {
        //send token to liveSearch.php
        xmlhttp.open("GET", "liveSearch.php?q=" + str + "&token=" + phpVars, true);
        xmlhttp.send();
        return;
    }
    if (str.length < 1) {
        uic.innerHTML = "no suggestion";
        return;
    }
}