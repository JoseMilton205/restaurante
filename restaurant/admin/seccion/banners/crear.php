<?php
include("../../bd.php");


$titulo = "";
$descripcion = "";
$link = "";

if($_POST){

    $titulo = $_POST["titulo"] ?? "";
    $descripcion = $_POST["descripcion"] ?? "";
    $link = $_POST["link"] ?? "";


    $sentencia = $conexion->prepare("INSERT INTO tbl_banners (titulo, descripcion, link) 
    VALUES (:titulo, :descripcion, :link)");

    $sentencia->bindParam(":titulo", $titulo);
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->bindParam(":link", $link);

    $sentencia->execute();

    header("Location:index.php");
    exit();
}

include("../../templates/header.php");
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">Crear Banner</div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Titulo</label>
                    <input type="text" class="form-control" 
                        value="<?php echo $titulo; ?>" 
                        name="titulo" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Descripcion</label>
                    <input type="text" class="form-control" 
                        value="<?php echo $descripcion; ?>" 
                        name="descripcion" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Link</label>
                    <input type="text" class="form-control" 
                        value="<?php echo $link; ?>" 
                        name="link" required>
                </div>

                <button type="submit" class="btn btn-success">Crear banner</button>
                <a class="btn btn-secondary" href="index.php">Cancelar</a>

            </form>
        </div>

        <div class="card-footer text-muted">
            Ingreso de nuevos banners - Oruro
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>