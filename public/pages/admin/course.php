<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<style>

.drop-zone {
  border: 2px dashed #ccc;
  padding: 20px;
  text-align: center;
  cursor: pointer;
}

.drop-zone.hover {
  border-color: #333;
}

.drop-zone span {
  display: block;
  margin-bottom: 10px;
}


</style>
<form action="#" method="POST">
<div class="drop-zone">
    <span>Arrastra y suelta archivos PDF aquí o haz clic para seleccionar uno</span>
    <input type="file" id="pdf-file-input" accept="application/pdf" required>
  </div>
  <button name="enviar">Enviar</button>
</form>
  
  

<script>

// Obtener el input de archivo y la zona de soltar
const pdfFileInput = document.getElementById('pdf-file-input');
const dropZone = document.querySelector('.drop-zone');

// Agregar el evento dragover para evitar el comportamiento predeterminado del navegador
dropZone.addEventListener('dragover', (e) => {
  e.preventDefault();
  dropZone.classList.add('hover');
});

// Agregar el evento dragleave para restablecer la clase del elemento
dropZone.addEventListener('dragleave', () => {
  dropZone.classList.remove('hover');
});

// Agregar el evento drop para manejar la carga del archivo PDF
dropZone.addEventListener('drop', (e) => {
  e.preventDefault();

  // Restablecer la clase del elemento
  dropZone.classList.remove('hover');

  // Obtener el archivo PDF
  const pdfFile = e.dataTransfer.files[0];

  // Mostrar el nombre del archivo seleccionado en el input de archivo
  pdfFileInput.value = pdfFile.name;
});


</script>

</body>
</html>