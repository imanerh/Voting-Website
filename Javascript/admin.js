function modify() {
    
    var eid = document.getElementById("election_id").value;
    var etitle = document.getElementById("election_title").value;
    var edesc = document.getElementById("election_description").value;
    var estart = document.getElementById("election_start_date").value;
    var eend = document.getElementById("election_end_date").value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
        }
    }
    xhttp.open("GET", "modify.php?election_id="+eid+"&election_title"+etitle+"&election_description"+edesc+"&election_start_date"+estart+"&election_end_date"+eend, true);
    xhttp.send();
}