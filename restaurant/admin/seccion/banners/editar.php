<?php
include("../../bd.php");
include("../../templates/header.php");

$txtID = "";
$titulo = "";
$descripcion = "";
$link = "";

if(isset($_GET["txtID"])){
    $txtID = $_GET["txtID"];

    $sentencia = $conexion->prepare("SELECT * FROM tbl_banners WHERE ID = :id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    if($registro){
        $titulo = $registro["titulo"];
        $descripcion = $registro["descripcion"];
        $link = $registro["link"];
    }
}

if($_POST){
    $titulo = $_POST["titulo"] ?? "";
    $descripcion = $_POST["descripcion"] ?? "";
    $link = $_POST["link"] ?? "";
    $txtID = $_POST["txtID"] ?? "";      
    $nuevoID = $_POST["nuevoID"] ?? ""; 

    $check = $conexion->prepare("SELECT COUNT(*) FROM tbl_banners WHERE ID = :id");
    $check->bindParam(":id", $nuevoID);
    $check->execute();

    if($check->fetchColumn() > 0 && $nuevoID != $txtID){
        echo "<div class='alert alert-danger'>El ID ya existe.</div>";
    } else {

        $sentencia = $conexion->prepare("UPDATE tbl_banners 
            SET ID=:nuevoID, titulo=:titulo, descripcion=:descripcion, link=:link 
            WHERE ID=:id");

        $sentencia->bindParam(":nuevoID", $nuevoID);
        $sentencia->bindParam(":titulo", $titulo);
        $sentencia->bindParam(":descripcion", $descripcion);
        $sentencia->bindParam(":link", $link);
        $sentencia->bindParam(":id", $txtID);

        $sentencia->execute();

        header("Location:index.php");
        exit();
    }
}
?>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header">Editar Banner</div>

        <div class="card-body">
            <form method="post">

                <!-- ID ORIGINAL OCULTO -->
                <input type="hidden" name="txtID" value="<?php echo $txtID; ?>">

                <!-- ID EDITABLE -->
                <div class="mb-3">
                    <label class="form-label">ID</label>
                    <input type="number" class="form-control"
                        value="<?php echo $txtID; ?>"
                        name="nuevoID" required>
                </div>

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

                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="index.php" class="btn btn-secondary">Cancelar</a>

            </form>
        </div>

        <div class="card-footer text-muted">
            Edición de banners - Oruro
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>