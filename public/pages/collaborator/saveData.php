<?php

function exception_error_handler($errno, $errstr, $errfile, $errline)
{
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

set_error_handler("exception_error_handler");

?>

<?php

if(empty($_GET['idCollaborator']) && empty($_GET['idCategorie']) && empty($_GET['idCourse']) && empty($_GET['count']) && empty($_GET['points']))
{
    echo("No se reciben parametros");
}
else
{
    $idCollaborator = $_GET['idCollaborator'];
    $idCategorie = $_GET['idCategorie'];
    $idCourse = $_GET['idCourse'];
    $count = $_GET['count'];
    $points = $_GET['points'];
 

    try
    {
        $registredCourses = "false";

        $coursesCompleted = json_decode(file_get_contents("http://localhost:3000/$idCollaborator/showCoursesCompleted"), true);

        for ($x=0; $x<count($coursesCompleted); $x++)
        {
            if($idCourse == $coursesCompleted[$x]['id_course'])
            {
                $registredCourses = "true";
            }

        }

        if($registredCourses == "false")
        {
        
        //Code para sacar el porcentaje obtenido del usuario al cuestionario
        $resultado = (100/$count) * $points; 

        if($resultado >= 80)
        {
               
                $url = "http://localhost:3000/$idCollaborator/coursesCompleted";

                $ch = curl_init($url);
                
                $jsonData = array(
                    'id_course' => $idCourse,
                    'calf' => $resultado
                );
                
                $jsonDataEncoded = json_encode($jsonData);
                
                curl_setopt($ch, CURLOPT_POST, 1);
                
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
                
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
                
                $result = curl_exec($ch);
                
                    ?>
                <!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Document</title>
                
                    <script src="sweetalert2.min.js"></script>
                <link rel="stylesheet" href="sweetalert2.min.css">
                
                </head>
                <body>
                    
                
                    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Felicidades haz pasado el Curso con: <?php echo $resultado;?>%',
                showConfirmButton: true,
                confirmButtonText: "Entendido",
                confirmButtonColor: "#1F4566",
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                
                    window.location="./showCourses.php?idCollaborator=<?php echo$idCollaborator;?>&idCategorie=<?php echo $idCategorie;?>" 
                } 
                    });
                            
                    </script>
                </body>
                </html>
        <?php
        }
        else
        {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Document</title>
            
                <script src="sweetalert2.min.js"></script>
            <link rel="stylesheet" href="sweetalert2.min.css">
            
            </head>
            <body>
                
            
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>Swal.fire({
            position: 'center',
            icon: 'error',
            title: 'Lo sentimos, no haz pasado el curso...',
            text: 'Tu calificación fue de: <?php echo $resultado;?>% y es menor a 80%. REPASA E INTENTALO NUEVAMENTE',
            showConfirmButton: true,
            confirmButtonText: "Entendido",
            confirmButtonColor: "#1F4566",
            }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            
                window.location="./showCourses.php?idCollaborator=<?php echo$idCollaborator;?>&idCategorie=<?php echo $idCategorie;?>" 
            } 
                });
                        
                </script>
            </body>
            </html>
    <?php
        }
    }
    else
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        
            <script src="sweetalert2.min.js"></script>
        <link rel="stylesheet" href="sweetalert2.min.css">
        
        </head>
        <body>
            
        
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>Swal.fire({
        position: 'center',
        icon: 'info',
        title: 'ERROR',
        text: 'Este curso ya ha sido registrado anteriormente.',
        showConfirmButton: true,
        confirmButtonText: "Entendido",
        confirmButtonColor: "#1F4566",
        }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
        
            window.location="./showCourses.php?idCollaborator=<?php echo$idCollaborator;?>&idCategorie=<?php echo $idCategorie;?>" 
        } 
            });
                    
            </script>
        </body>
        </html>
<?php
    }
    }catch(Exception $e)
    {
        echo ("ERR 404 NOT FOUND");
    }
}