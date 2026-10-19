<?php
session_start();
if ($_POST) {
    include("bd.php");
    $usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
    $password = isset($_POST["password"]) ? $_POST["password"] : "";

    $sentencia = $conexion->prepare("
        SELECT *, count(*) as n_usuario 
        FROM tbl_usuarios 
        WHERE usuario = :usuario 
        AND password = :password
    ");

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->execute();

    $lista_usuarios = $sentencia->fetch(PDO::FETCH_LAZY);
    $n_usuario = $lista_usuarios["n_usuario"];

    if ($n_usuario >= 1) {
        $_SESSION["usuario"] = $lista_usuarios["usuario"];
        $_SESSION["logueado"] = true;
        header("Location:index.php");
        exit();
    } else {
        $mensaje = "Usuario o contraseña incorrectos...";
    }
}
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | Panel de Administración</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            padding: 40px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .login-header h2 {
            font-weight: 600;
            color: #333;
        }

        .login-header p {
            color: #777;
            font-size: 0.9rem;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
            margin-bottom: 5px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25 row rgba(118, 75, 162, 0.25);
            border-color: #764ba2;
        }

        .btn-primary {
            background: #764ba2;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: #5a3782;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            font-size: 0.85rem;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            <h2>Bienvenido</h2>
            <p>Ingresa tus credenciales para continuar</p>
        </div>

        <?php if (isset($mensaje)) { ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>¡Error!</strong> <?php echo $mensaje; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php } ?>

        <form action="login.php" method="post">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input type="text" class="form-control" name="usuario" placeholder="Ej: admin" required>
            </div>

            <div class="mb-4">
                <label class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted">&copy; 2026 Restaurante Admin</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>