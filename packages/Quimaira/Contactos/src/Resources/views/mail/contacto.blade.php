<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
</head>

<body>
    <h1 style="font-family: arial; background:#000; color:white; padding: 40px 20px; margin:0;">
        {{ config('app.name') }}</h1>
    <div style="border: 1px solid #000; padding: 30px 20px;">
        <p style="font-family: arial; margin:0;">
            <br />
            <strong>Datos de contacto:</strong><br />
        <div>
            <label>Nombre: {{ $data->nombre }}</label><br />
            <label>Empresa: {{ $data->empresa }}</label><br />
            <label>Correo electrónico: {{ $data->email }}</label><br />
            <label>Teléfono: {{ $data->telefono }}</label><br />
            <label>Estado: {{ $data->estado }}</label><br />
            <label>Ciudad: {{ $data->ciudad }}</label><br />
            <label>Mensaje: {{ $data->mensaje }}</label><br />
        </div>
        </p>
    </div>
</body>

</html>
