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
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How to use</title>
</head>
<body>
    <?php
        $displayResult="";
        require_once("config.php");
        require_once("callapi.php");
        
        $api=new callapi($client,$apiKey,$apiUrl);
    ?>
    <h1>How to use "<i> Fench cities Api </i>"</h1>
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
                <td>Get all informations about a city</td>
                <td>GET</td>
                <td>/ville/{code_postal}</td>
                <td>
                    Get all informations about a city with its post code <br> <i>{code_postal} : </i> is the post code of the city (required).<br>
                    It will return a JSON like the following one
                </td>
                <td>
                    <pre>
{
    "id": 1,
    "departement": 1,
    "nom": "Ozan",
    "code_postal": 1190,
    "canton": 26,
    "population": 618,
    "densite": 93,
    "surface": "6,6"
}
                    </pre>
                </td>
                <td>
                    <form action="" method="GET">
                        <label for="cityCode">Code postal : </label>
                        <input type="text" name="cityCode">
                        <input type="submit" value="Tester">
                    </form>
                    <?= $displayResult; ?>
                </td>
            </tr>
            <tr class ="impair">
                <td>Get the population of a city</td>
                <td>GET </td>
                <td>/population/{code_postal}</td>
                <td> 
                    Get the population of a city <br> <i>{code_postal} : </i> is the post code of the city (required). <br>
                    It will return a JSON like the following one
                </td>
                <td>
                    <pre>
{
    "population": 618
}
                    </pre>
                </td>
                <td>
                    <form action="" method="GET">
                        <label for="cityCode">Code postal : </label>
                        <input type="text">
                        <input type="submit" value="Tester">
                    </form>
                    <?= $displayResult; ?>   
                </td>
            </tr>
            <tr class ="pair">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class ="impair">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class ="pair">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class ="impair">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>