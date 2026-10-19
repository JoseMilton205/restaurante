<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID=(isset($_GET["txtID"]))?$_GET["txtID"]:"";

    // Proceso de borrado que busque la imagen y la pueda borrar
    $sentencia=$conexion->prepare("SELECT * FROM `tbl_colaboradores` WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_foto=$sentencia->fetch(PDO::FETCH_LAZY);

    if(isset($registro_foto['foto'])){
        if(file_exists("../../../images/colaboradores/".$registro_foto['foto'])){
            unlink("../../../images/colaboradores/".$registro_foto['foto']);
        }
    }

    // Borra en la base de datos
    $sentencia=$conexion->prepare("DELETE FROM tbl_colaboradores WHERE ID=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    header("Location:index.php");
}

$sentencia=$conexion->prepare("SELECT * FROM `tbl_colaboradores` ");
$sentencia->execute();
$lista_colaboradores=$sentencia->fetchAll(PDO::FETCH_ASSOC);

include("../../templates/header.php");
?>

<br/>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Info</th>
                        <th scope="col">Redes sociales</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($lista_colaboradores as $registro) { ?>
                    <tr class="">
                        <td><?php echo $registro['ID']; ?></td>
                        <td><?php echo $registro['titulo']; ?></td>
                        <td>
                            <img width="50" src="../../../images/colaboradores/<?php echo $registro['foto']; ?>" />
                        </td>
                        <td>
                            <?php echo $registro['descripcion']; ?>
                        </td>
                        <td>
                            <?php echo $registro['linkfacebook']; ?><br/>
                            <?php echo $registro['linkinstagram']; ?><br/>
                            <?php echo $registro['linklinkedin']; ?>
                        </td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="editar.php?txtID=<?php echo $registro['ID']; ?>" role="button">Editar</a>
                            |
                            <a name="" id="" class="btn btn-danger" 
                            href="index.php?txtID=<?php echo $registro['ID']; ?>" 
                            role="button">Borrar</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php"); ?>