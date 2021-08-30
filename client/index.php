<?php
/*
    Authors: Thibaut
    Created on: 2021/08/21
    Last Update: 2021/08/21
    Version: 0.0.1
    Comments: manuel d'utilisation de l'api REST
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="src/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="src/callapi.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to use</title>
</head>
<body>
    <?php
        $displayResult="";
        require_once("config.php");
        require_once("callapi.php");
        
    ?>
    <h1>How to use "<i> ApiVilles </i>"</h1>
    <table>
        <thead>
            <tr>
                <th>Action</th>
                <th>Verb</th>
                <th>Endpoint</th>
                <th>Description</th>
                <th>Result</th>
                <th>Test</th>
            </tr>
        </thead>
        <tbody>
            <tr class ="pair">
                <td>Get all informations about a city or several cities</td>
                <td>GET</td>
                <td>/ville/{code_postal}</td>
                <td>
                    Get all informations about a city or several cities with its post code. <br> <i>{code_postal} : </i> is the post code of the city (required).<br>
                    It will returns a JSON object like the following one if successed, an error message if an error occured.
                </td>
                <td>
                    <pre>
{
    id:{
        "id": 1,
        "dept": 1,
        "cityName": "Ozan",
        "postCode": 1190,
        "canton": 26,
        "population": 618,
        "density": 93,
        "area": "6.6"
    }
}
                    </pre>
                </td>
                <td>
                    <form action="" method="GET">
                        <label for="cityCode">code_postal : </label>
                        <input type="text" name="cityCode">
                        <input type="submit" value="Tester" id="cityCode">
                    </form>
                    <div id="resCityCode">
                    <?= $displayResult; ?>
                    </div>
                </td>
            </tr>
            <tr class ="impair">
                <td>Get the population of a city</td>
                <td>GET </td>
                <td>/population/{code_postal}</td>
                <td> 
                    Get the population of a city or several cities with its post code.<br> <i>{code_postal} : </i> is the post code of the city (required). <br>
                    It will returns a JSON object like the following one if successed, an error message if an error occured.
                </td>
                <td>
                    <pre>
{
    id:{
        "population": 618
    }
}
                    </pre>
                </td>
                <td>
                    <form action="" method="GET">
                        <label for="popCode">code_postal : </label>
                        <input type="text" name="popCode">
                        <input type="submit" value="Tester" id ="popCode">
                    </form>
                    <div id="respopCode">
                    <?= $displayResult; ?>  
                    </div> 
                </td>
            </tr>
            <tr class ="pair">
                <td>Get the area of a city</td>
                <td>GET</td>
                <td>/superficie/{code_postal}</td>
                <td>Get the area of a city or several cities with its post code.<br> <i>{code_postal} : </i> is the post code of the city (required). <br>
                    It will returns a JSON object like the following one if successed, an error message if an error occured.
                </td>
                <td>
                    <pre>
{
    id:{
        "area": "6.6"
    }
}
                    </pre>
                </td>
                <td>
                    <form action="" method="GET">
                        <label for="areaCode">code_postal : </label>
                        <input type="text" name="areaCode">
                        <input type="submit" value="Tester" id ="areaCode">
                    </form>
                    <div id="resareaCode">
                    <?= $displayResult; ?>  
                    </div>
                </td>
            </tr>
            <tr class ="impair">
                <td>Get the cities in a departement</td>
                <td>GET</td>
                <td>/villes/{departement}</td>
                <td> Get all the informations about all the cities in the departement.<br> <i>{departement} : </i> is the number of the departement (required). <br>
                    It will returns a JSON object like the following one if successed, an error message if an error occured.
                </td>
                <td>
                    <pre>
{
    id:{
        "id": 1,
        "dept": 1,
        "cityName": "Ozan",
        "postCode": 1190,
        "canton": 26,
        "population": 618,
        "density": 93,
        "area": "6.6"
    }
}
                    </pre>
                </td>
                <td>
                    <form action="" method="GET">
                        <label for="deptCode">departement : </label>
                        <input type="text" name="deptCode">
                        <input type="submit" value="Tester" id ="deptCode">
                    </form>
                    <div id="resdeptCode">
                    <?= $displayResult; ?>  
                    </div>
                </td>
            </tr>
            <tr class ="pair">
                <td>Get the cities by canton in a departement</td>
                <td>GET</td>
                <td>/villes/{departement}/{canton}</td>
                <td>
                Get all the informations about all the cities in the canton in the departement.<br> <i>{departement} : </i> is the number of the departement (required). <br>
                <i>{canton} : </i> is the number of the canton (required). <br>
                    It will returns a JSON object like the following one if successed, an error message if an error occured. <br>
                    <i>Note : if {departement} is undefined, it will requests the endpoint /villes/{departement} where {depratement}={canton}</i>
                </td>
                <td>
                    <pre>
{
    id:{
        "id": 1,
        "dept": 1,
        "cityName": "Ozan",
        "postCode": 1190,
        "canton": 26,
        "population": 618,
        "density": 93,
        "area": "6.6"
    }
}
                    </pre>
                </td>
                <td>
                    <form action="" method="GET">
                        <div>
                            <label for="deptcantonCode">departement : </label>
                            <input type="text" name="deptcantonCode">
                        </div>
                        <div>
                            <label for="cantonCode">canton : </label><br>
                            <input type="text" name="cantonCode">
                        </div>
                        <input type="submit" value="Tester" id ="cantonCode">
                    </form>
                    <div id="rescantonCode">
                    <?= $displayResult; ?>  
                    </div>
                </td>
            </tr>
            <tr class ="impair">
                <td>Get all informations about a city</td>
                <td>GET</td>
                <td>/ville/{code_postal}/{id}</td>
                <td>
                    Get all informations about a city with its id. <br>
                    <i>{code_postal} : </i> is the post code of the city (required).<br>
                     <i>{id} : </i> is the Id of the city (required).<br>
                    It will returns a JSON object like the following one if successed, an error message if an error occured.
                    <i>Note : If {code_postal} is undefined, it will requests the endpoint /ville/{code_postal} where {code_postal}={id}</i>
                </td>
                <td>
                    <pre>
{

    "id": 1,
    "dept": 1,
    "cityName": "Ozan",
    "postCode": 1190,
    "canton": 26,
    "population": 618,
    "density": 93,
    "area": "6.6"

}
                    </pre>
                </td>
                <td>
                    <form action="" method="GET">
                        <div>
                            <label for="cityCodeId">code_postal : </label>
                            <input type="text" name="cityCodeId">
                        </div>
                        <div>
                            <label for="cityId">Id : </label><br>
                            <input type="text" name="cityId">
                        </div>
                        <input type="submit" value="Tester" id="cityId">
                    </form>
                    <div id="resCityId">
                    <?= $displayResult; ?>
                    </div>
                </td>
            </tr>
            <tr class ="pair">
                <td>Add a new city</td>
                <td>POST</td>
                <td>/ville</td>
                <td>
                    Add a new city with the fields : <i>postCode</i> and <i>cityName</i> (required) <br>
                    then <i>dept</i>, <i>canton</i>, <i>population</i>, <i>density</i> and <i>area</i>
                    It will returns th number of added rows here 1 <br>
                    <i>Note : all the fields except <i>id</i> must be sends they can be empty, but they have to exists</i>
                </td>
                <td> 1 if successed , an error message if not.</td>
                <td>
                <form action="" method="GET">
                        <div>
                            <label for="addCityName">Nom : </label>
                            <input type="text" name="addCityName" required>
                        </div>
                        <div>
                            <label for="addCityCode">code_postal : </label><br>
                            <input type="text" name="addCityCode" required>
                        </div>
                        <div>
                            <label for="addCityDept">departement : </label>
                            <input type="text" name="addCityDept">
                        </div>
                        <div>
                            <label for="addCityCanton">canton : </label><br>
                            <input type="text" name="addCityCanton">
                        </div>
                        <div>
                            <label for="addCityPop">population : </label>
                            <input type="text" name="addCityPop">
                        </div>
                        <div>
                            <label for="addCityDensity">densite </label><br>
                            <input type="text" name="addCityDensity">
                        </div>
                        <div>
                            <label for="addCitySup">superficie : </label><br>
                            <input type="text" name="addCitySup">
                        </div>
                        <input type="submit" value="Tester" id="cityIdAdd">
                    </form>
                    <div id="resAddCity">
                    <?= $displayResult; ?>
                    </div>
                </td>
            </tr>
            <tr class ="impair">
                <td>Modify an existing city</td>
                <td>PUT</td>
                <td>/ville/{code_pstal}/{id}</td>
                <td>
                   Update a city with the fields : <i>postCode</i>, <i>cityName</i>, 
                    <i>dept</i>, <i>canton</i>, <i>population</i>, <i>density</i> and <i>area</i>. <br>
                    <i>{code_postal} : </i> is the post code of the city (required).<br>
                    <i>{id} : </i> is the Id of the city (optionnal).<br>
                    It will returns the modified entry<br>
                    <i>Note : if several cities have the same post code, it will return all these cities without modifications</i>
                </td>
                <td>
                    <pre>
{
    "id": 1,
    "dept": 1,
    "cityName": "Ozan",
    "postCode": 1190,
    "canton": 26,
    "population": 618,
    "density": 93,
    "area": "6.6"

} 
                    </pre>
                </td>
                <td>
                    <form action="" method="GET">
                        <div>
                            <label for="targetCode">code_postal : </label>
                            <input type="text" name="targetCode" required>
                        </div>
                        <hr>
                        <div>
                            <label for="newCityName">Nom : </label>
                            <input type="text" name="newCityName" >
                        </div>
                        <div>
                            <label for="newCityCode">code_postal : </label><br>
                            <input type="text" name="newCityCode">
                        </div>
                        <div>
                            <label for="newCityDept">departement : </label>
                            <input type="text" name="newCityDept">
                        </div>
                        <div>
                            <label for="newCityCanton">canton : </label><br>
                            <input type="text" name="newCityCanton">
                        </div>
                        <div>
                            <label for="newCityPop">population : </label>
                            <input type="text" name="newCityPop">
                        </div>
                        <div>
                            <label for="newCityDensity">densite </label><br>
                            <input type="text" name="newCityDensity">
                        </div>
                        <div>
                            <label for="newCitySup">superficie : </label><br>
                            <input type="text" name="newCitySup">
                        </div>
                        <input type="submit" value="Tester" id="cityUpdate">
                    </form>
                    <div id="resUpdateCity">
                    <?= $displayResult; ?>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>