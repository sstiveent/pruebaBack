<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Cotización</title>
</head>
<body>
    <p>Hola! Han solicitado una cotización de un vehiculo.</p>
    <p>Estos son los datos del usuario:</p>
    <ul>
        <li>Nombre: {{ $cotizacion->nombre }}</li>
        <li>Teléfono: {{ $cotizacion->celular }}</li>
        <li>Email: {{ $cotizacion->email }}</li>
        <li>Modelo: {{ $cotizacion->modelo  }}</li>
    </ul>
</body>
</html>
