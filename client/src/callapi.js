$(document).ready(function(){

    const apiUrl="/apiVilles/server";

    //requete Ajax pour l'endpoint /ville/{code_postal}
    $("#cityCode").click(function(e){
        e.preventDefault();
        code = $("input[name='cityCode']").val();
        $.ajax({
            url : apiUrl+"/ville/"+code,
            method : "GET",
            dataType : "json"

        })
        // en cas de réussite
        .done(function(res){
            let data = JSON.stringify(res,null,2);
            $("#resCityCode").empty();
            $("#resCityCode").append("<p><strong>Results</strong></p><pre>"+data+"</pre>");
            $("#resCityCode").append("<p> <strong>Sample</strong> </p><ul>");
            for(var id in res) {
                $("#resCityCode").append("<li> The city with the Id <i>"+ id + "</i> is <i>"+res[id].cityName +"</i> and it counts <i>"+ res[id].population +"</i> citizens. </li>");
            }
            $("#resCityCode").append("</ul>");
        })

        //en cas d'echec
        .fail(function(error){
            $("#resCityCode").empty();
            $("#resCityCode").append("<p> An error occured : </p>\n <pre>"+ JSON.stringify(error,null,2))+ "</pre>";
        })

        .always(function(){
        });
    });

    //requete Ajax pour l'endpoint /population/{code_postal}
    $("#popCode").click(function(e){
        e.preventDefault();
        code = $("input[name='popCode']").val();
        $.ajax({
            url : apiUrl+"/population/"+code,
            method : "GET",
            dataType : "json"

        })
        // en cas de réussite
        .done(function(res){
            let data = JSON.stringify(res,null,2);
            $("#respopCode").empty();
            $("#respopCode").append("<p><strong>Results</strong></p><pre>"+data+"</pre>");
            $("#respopCode").append("<p> <strong>Sample</strong> </p><ul>");
            for(var id in res) {
                $("#respopCode").append("<li> The city with the Id <i>"+ id + "</i> counts <i>"+ res[id].population +"</i> citizens. </li>");
            }
            $("#respopCode").append("</ul>");
        })

        //en cas d'echec
        .fail(function(error){
            $("#respopCode").empty();
            $("#respopCode").append("<p>An error occured : </p> <pre>"+ JSON.stringify(error,null,2))+ "</pre>";
        })

        .always(function(){
        });
    });

     //requete Ajax pour l'endpoint /superficie/{code_postal}
     $("#areaCode").click(function(e){
        e.preventDefault();
        code = $("input[name='areaCode']").val();
        $.ajax({
            url : apiUrl+"/superficie/"+code,
            method : "GET",
            dataType : "json"

        })
        // en cas de réussite
        .done(function(res){
            let data = JSON.stringify(res,null,2);
            $("#resareaCode").empty();
            $("#resareaCode").append("<p><strong>Results</strong></p><pre>"+data+"</pre>");
            $("#resareaCode").append("<p> <strong>Sample</strong> </p><ul>");
            for(var id in res) {
                $("#resareaCode").append("<li> The city with the Id <i>"+ id + "</i> has an area of <i>"+ res[id].area +"</i> km<sup>2</sup>. </li>");
            }
            $("#resareaCode").append("</ul>");
        })

        //en cas d'echec
        .fail(function(error){
            $("#resareaCode").empty();
            $("#resareaCode").append("<p>An error occured : </p> <pre>"+ JSON.stringify(error,null,2))+ "</pre>";
        })

        .always(function(){
        });
    });

    //requete Ajax pour l'endpoint /villes/{departement}
    $("#deptCode").click(function(e){
        e.preventDefault();
        code = $("input[name='deptCode']").val();
        $.ajax({
            url : apiUrl+"/villes/"+code,
            method : "GET",
            dataType : "json"

        })
        // en cas de réussite
        .done(function(res){
            let data = JSON.stringify(res,null,2);
            $("#resdeptCode").empty();
            $("#resdeptCode").append("<p><strong>Results</strong></p><pre>"+data+"</pre>");
            $("#resdeptCode").append("<p> <strong>Sample</strong> </p><ul>");
            for(var id in res) {
                $("#resdeptCode").append("<li> The city with the Id <i>"+ id + "</i> is in the departement <i>"+ res[id].dept +"</i>. </li>");
            }
            $("#resdeptCode").append("</ul>");
        })

        //en cas d'echec
        .fail(function(error){
            $("#resdeptCode").empty();
            $("#resdeptCode").append("<p>An error occured : </p> <pre>"+ JSON.stringify(error,null,2))+ "</pre>";
        })

        .always(function(){
        });
    });

    //requete Ajax pour l'endpoint /villes/{departement}/{canton}
    $("#cantonCode").click(function(e){
        e.preventDefault();
        code = $("input[name='deptcantonCode']").val();
        canton = $("input[name='cantonCode']").val();
        console.log("dept : "+code);
        console.log("canton :" + canton);
        $.ajax({
            url : apiUrl+"/villes/"+code+"/"+canton,
            method : "GET",
            dataType : "json"

        })
        // en cas de réussite
        .done(function(res){
            let data = JSON.stringify(res,null,2);
            console.log(res);
            $("#rescantonCode").empty();
            $("#rescantonCode").append("<p><strong>Results</strong></p><pre>"+data+"</pre>");
            $("#rescantonCode").append("<p> <strong>Sample</strong> </p><ul>");
            for(var id in res) {
                $("#rescantonCode").append("<li> The city with the Id <i>"+ id + "</i> is in the departement <i>"+ res[id].dept +"</i> and in the canton <i>"+ res[id].canton +"</i></li>");
            }
            $("#rescantonCode").append("</ul>");
        })

        //en cas d'echec
        .fail(function(error){
            $("#rescantonCode").empty();
            $("#rescantonCode").append("<p>An error occured : </p> <pre>"+ JSON.stringify(error,null,2))+ "</pre>";
        })

        .always(function(){
        });
    });

});