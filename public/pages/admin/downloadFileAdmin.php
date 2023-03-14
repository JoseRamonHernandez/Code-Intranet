
<?php

if(!empty(isset($_GET['nameFile'])) && !empty(isset($_GET['nameCourse'])) && !empty(isset($_GET['idCourse'])) && !empty(isset($_GET['idCategorie'])) && !empty(isset($_GET['nameCategorie'])))
{

    $idCourse = $_GET['idCourse'];
    $idCategorie = $_GET['idCategorie'];
    $nameCategorie = $_GET['nameCategorie'];
    $nameCourse = $_GET['nameCourse'];

    $nameFile = $_GET['nameFile'];

        $url = "../documents/$nameFile";



        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($url));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($url));
        ob_clean();
        flush();
        readfile($url);

        ?>

        <script>
            window.location= "./selectCourses.php?nameCourse=<?php echo $nameCourse; ?>&idCourse=<?php echo $idCourse; ?>&idCategorie=<?php echo $idCategorie; ?>&nameCategorie=<?php echo $nameCategorie; ?>"
        </script>

        <?php

}else{
    echo("Sin Resultados");
}
?>