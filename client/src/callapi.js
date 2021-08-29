$(document).ready(function(){

    const apiUrl="/apiVilles/server";

    //requete Ajax pour l'endpoint GET /ville/{code_postal}
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

    //requete Ajax pour l'endpoint GET /population/{code_postal}
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

     //requete Ajax pour l'endpoint GET /superficie/{code_postal}
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

    //requete Ajax pour l'endpoint GET /villes/{departement}
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

    //requete Ajax pour l'endpoint GET /villes/{departement}/{canton}
    $("#cantonCode").click(function(e){
        e.preventDefault();
        code = $("input[name='deptcantonCode']").val();
        canton = $("input[name='cantonCode']").val();
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

    //requete Ajax pour l'endpoint GET /villes/{code_postal}/{id}
    $("#cityId").click(function(e){
        e.preventDefault();
        code = $("input[name='cityCodeId']").val();
        id = $("input[name='cityId']").val();
        console.log("dept : "+code);
        console.log("canton :" + id);
        $.ajax({
            url : apiUrl+"/ville/"+code+"/"+id,
            method : "GET",
            dataType : "json"

        })
        // en cas de réussite
        .done(function(res){
            let data = JSON.stringify(res,null,2);
            console.log(res);
            $("#resCityId").empty();
            $("#resCityId").append("<p><strong>Results</strong></p><pre>"+data+"</pre>");
            $("#resCityId").append("<p> <strong>Sample</strong> </p><ul>");
                $("#resCityId").append("<li> The city with the Id <i>"+ res.id + "</i> is <i>"+res.cityName +"<i/> in the departement <i>"+ res.dept +"</i> and it counts <i>"+ res.population +"</i> citizens</li>");
            $("#resCityId").append("</ul>");
        })

        //en cas d'echec
        .fail(function(error){
            $("#resCityId").empty();
            $("#resCityId").append("<p>An error occured : </p> <pre>"+ JSON.stringify(error,null,2))+ "</pre>";
        })

        .always(function(){
        });
    });

    //requete Ajax pour l'endpoint POST /ville
    $("#cityIdAdd").click(function(e){
        e.preventDefault();
        cityName = $("input[name='addCityName']").val();
        postCode = $("input[name='addCityCode']").val();
        dept = $("input[name='addCityDept']").val();
        canton = $("input[name='addCityCanton']").val();
        population = $("input[name='addCityPop']").val();
        density = $("input[name='addCityDensity']").val();
        area = $("input[name='addCitySup']").val();
        $.ajax({
            url : apiUrl+"/ville",
            method : "POST",
            dataType : "json",
            data : {
                "cityName" : cityName,
                "postCode" : postCode,
                "dept" : dept,
                "canton" : canton,
                "population" : population,
                "density" : density,
                "area": area
            }

        })
        // en cas de réussite
        .done(function(res){
            let data = JSON.stringify(res,null,2);
            console.log(res);
            $("#resAddCity").empty();
            $("#resAddCity").append("<p><strong>Results</strong></p><pre>"+data+"</pre>");
            $("#resAddCity").append("<p> <strong>Sample</strong> </p>");
                $("#resAddCity").append("the request records "+ res +" entry");
        })

        //en cas d'echec
        .fail(function(error){
            $("#resAddCity").empty();
            $("#resAddCity").append("<p>An error occured : </p> <pre>"+ JSON.stringify(error,null,2))+ "</pre>";
        })

        .always(function(){
        });
    });

    //requete Ajax pour l'endpoint PUT /ville/{code_postal}/{id}
    $("#cityUpdate").click(function(e){
        e.preventDefault();
        code= $("input[name='targetCode']").val();
        cityName = $("input[name='newCityName']").val();
        postCode = $("input[name='newCityCode']").val();
        dept = $("input[name='newCityDept']").val();
        canton = $("input[name='newCityCanton']").val();
        population = $("input[name='newCityPop']").val();
        density = $("input[name='newCityDensity']").val();
        area = $("input[name='newCitySup']").val();
        id= $("#idCity").val();
        if(!id){
            urlUpdate=apiUrl+"/ville/"+code
        }
        else{
            urlUpdate=apiUrl+"/ville/"+code+"/"+id;
        }
        $.ajax({
            url : urlUpdate,
            method : "PUT",
            dataType : "json",
            data : {
                "cityName" : cityName,
                "postCode" : postCode,
                "dept" : dept,
                "canton" : canton,
                "population" : population,
                "density" : density,
                "area": area
            }

        })
        // en cas de réussite
        .done(function(res){
            let data = JSON.stringify(res,null,2);
            console.log(res);
            $("#resUpdateCity").empty();
            $("#idCity").remove();
            $("#labelId").remove();
            $("#resUpdateCity").append("<p><strong>Results</strong></p><pre>"+data+"</pre>");
            console.log(Object.keys(res).length);
            if (Object.keys(res)[0]=="id"){
                $("#resUpdateCity").append("<p> <strong>Sample</strong> </p>");
                $("#resUpdateCity").append("the request update "+ res.cityName +" with the new parameters ");
            }else{
                $("input[name='targetCode']").after("<label id='labelId' for='idCity'> Selectionner la ville à modifier : </label><br><select id='idCity' name='update'><select>");
                for(var id in res){
                    $("#idCity").append("<option value='"+id +"' id='"+id+"'>"+ res[id].cityName+"</option>");
                }
            }

        })

        //en cas d'echec
        .fail(function(error){
            $("#resUpdateCity").empty();
            $("#resUpdateCity").append("<p>An error occured : </p> <pre>"+ JSON.stringify(error,null,2))+ "</pre>";
        })

        .always(function(){
        });
    });


});