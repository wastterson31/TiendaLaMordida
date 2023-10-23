@extends('Menu')

@section('start')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - La Mordida</title>
</head>
<body>
    <section class="form-container">
        <form action="" method="post">
            <h3>Register</h3>
            <input type="text" name="full_name" required placeholder="Nombre completo" maxlength="50" class="box">
            <input type="text" name="neighborhood" required placeholder="Barrio donde Vive" maxlength="50" class="box">
            <input type="number" name="phone_number" required placeholder="Numero telefonico" maxlength="20" class="box">
            <input type="text" name="username" required placeholder="Usuario" maxlength="20" class= "box " >
            <input type="password" name="password" required placeholder="Contraseña" maxlength="20" class="box">
            <input type="password" name="confirm_password" required placeholder="Confirmar contraseña" maxlength="20" class="box">
            <input type="submit" value="Crear cuenta" class="btn" name="submit">
            <p>¿Ya tienes una cuenta?</p>
            <a href="{{ route('Section') }}" class="option-btn" style="text-decoration: none">Iniciar seccion</a>
        </form>
    </section>
</body>
</html>

@endsection
