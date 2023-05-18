<?php

if(empty($_GET['id_categorie']) && empty($_GET['id_collaborator']) && empty($_GET['idSolicitud']))
{
    echo("No se reciben parámetros");
}
else
{
    $id_categorie = $_GET['id_categorie'];
    $id_collaborator = $_GET['id_collaborator'];
    $idSolicitud = $_GET['idSolicitud'];

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clerprem</title>

    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">

</head>
<body>



</body>
</html>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'question',
        title: 'Otorgar permisos:',
        text: 'Al "ACEPTAR" los permisos, el usuario colaborador tendrá acceso a la categoría seleccionada. Si "RECHAZA" la solicitud podrá cambiarla en otro momento.',
        showConfirmButton: true,
        showDenyButton: true,
        confirmButtonText: "ACEPTAR",
        confirmButtonColor: 'green',
        denyButtonText: "RECHAZAR",
        denyButtonColor: 'red',
    }).then((respuesta) => {
        if(respuesta.isConfirmed)
        {
    
            window.location="aprovate.php?id_categorie=<?php echo $id_categorie; ?>&idSolicitud=<?php echo $idSolicitud; ?>&id_collaborator=<?php echo $id_collaborator; ?>"
            
        }else if(respuesta.isDenied)
        {
            Swal.fire({
                icon: 'info',
                title: 'La solicitud fue rechazada.',
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: 'Ok',
                confirmButtonColor: 'blue',
            }).then((resq) => {
                if(resq)
                {
                    window.location="updateSolicitud.php?idSolicitud=<?php echo $idSolicitud; ?>&status=RECHAZADO"
                }
            })
        }
    })
</script>

<?php
}

?>