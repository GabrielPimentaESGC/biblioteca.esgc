<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Exportar Dados</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        h2 {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 10px;
        }

        form {
            background-color: #fff;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            display: block;
            margin-bottom: 20px;
        }

        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
    </style>
</head>
<body>
    <h2>Exportar Dados</h2>
    <form action="gerar_exportacao.php" method="POST">
        <label for="data_inicial">Data Inicial:</label>
        <input type="date" name="data_inicial" id="data_inicial" required>

        <label for="data_final">Data Final:</label>
        <input type="date" name="data_final" id="data_final" required>

        <input type="hidden" name="formato" value="excel">
        <input type="submit" value="Exportar">
    </form>
</body>
</html>
