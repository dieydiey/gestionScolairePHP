


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <?php 
        $controller = isset($_GET["controller"]) ? strtolower($_GET["controller"]) : "security";

        if($controller=="security") {
            include_once "../src/Controllers/securite.controller.php";
        } elseif($controller=="rp") {
            include_once "../src/Controllers/respo.controller.php";
        } elseif($controller=="attache") {
            include_once "../src/Controllers/attache.controller.php";
        } elseif($controller=="etudiant") {
            include_once "../src/Controllers/etudiant.controller.php";
        }else{
            include_once "../src/Controllers/error.controller.php";
        }
        
       
    ?>



</body>
</html>

