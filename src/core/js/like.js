function like(idPublication, idUtilisateur){
    console.log(idPublication);
    console.log(idUtilisateur);
    $.ajax({
        url: "/ProjetAnnuel/src/core/like.php",
        type: "POST",
        data: {
            idPublication: idPublication,
            idUtilisateur: idUtilisateur,

        },
        success: function (response) {
            var data = JSON.parse(response);
            // on augmente le nombre de like de la publicationù
            console.log(data);
            if (data.status == "error"){
                return 0;
            }
            else {var like = document.getElementById("like"+idPublication);
            like.innerHTML = parseInt(like.innerHTML) + 1;}
        },
        error: function(jqXHR, textStatus, errorThrown) {
            //console.log(textStatus, errorThrown);
        }
    });
}