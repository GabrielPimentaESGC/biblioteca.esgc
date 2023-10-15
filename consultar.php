<?php
date_default_timezone_set('Europe/Lisbon'); // Define o fuso horário de Lisboa

require_once("conexao.php"); // Inclui o arquivo de conexão

$nome = $cargo = "";
$mostrarTurmaAno = true;
$registroEfetuado = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $processo = $_POST["processo"];
    $atividade = $_POST["atividade"];

    $sql = "SELECT Nome, Cargo, Ano, Turma FROM users WHERE Processo = '$processo'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nome = $row["Nome"];
        $cargo = $row["Cargo"];
        $ano = $row["Ano"];
        $turma = $row["Turma"];

        if ($cargo === "P" || $cargo === "AO") {
            $mostrarTurmaAno = false;
        }

        $horaAtual = date('H:i:s'); // Formato da hora (hr-min-seg)
        $dataAtual = date('d-m-Y'); // Formato da data (dia-mês-ano)

        if (isset($_POST['confirmar'])) {
            $sqlRegistro = "INSERT INTO registros (data, hora, nprocesso, atividade) VALUES ('$dataAtual', '$horaAtual', '$processo', '$atividade')";
            if ($conn->query($sqlRegistro) === TRUE) {
                $registroEfetuado = true;
            } else {
                echo "Erro: " . $sqlRegistro . "<br>" . $conn->error;
            }
        }
    } else {
        echo "Número de processo não encontrado!";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Confirmação de Aluno</title>
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

        .confirmation {
            background-color: #fff;
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: relative;
        }

        p {
            margin: 0;
        }

        .confirm-button {
            background-color: #333;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        .confirmation img {
            max-width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <h2>Confirmação de Aluno</h2>
    <div class="confirmation">
        <?php
        if (isset($nome)) {
            if (!$registroEfetuado) {
                echo "<p>Nome: $nome</p>";
                if ($mostrarTurmaAno) {
                    echo "<p>Ano: $ano</p>";
                    echo "<p>Turma: $turma</p>";
                }
                if ($cargo === "P") {
                    echo "<p>Cargo: Professor</p>";
                } elseif ($cargo === "AO") {
                    echo "<p>Cargo: Assistente Operacional</p>";
                }
            }
            if ($registroEfetuado) {
                echo '<img src="Gif.gif" alt="Confirmação">';
            }
        } else {
            echo "Número de processo não encontrado!";
        }
        ?>
        <?php if (!$registroEfetuado) { ?>
            <form action="consultar.php" method="POST">
                <input type="hidden" name="processo" value="<?php echo $processo; ?>">
                <input type="hidden" name="atividade" value="<?php echo $atividade; ?>">
                <button type="submit" name="confirmar" class="confirm-button">Confirmar Dados</button>
            </form>
        <?php } ?>
    </div>
</body>
</html>
