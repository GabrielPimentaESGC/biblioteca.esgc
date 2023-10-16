<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formato = $_POST["formato"];

    if ($formato === "excel") {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="exportacao.csv"');

        // Saída do cabeçalho do CSV
        echo "Data; Hora; NProcesso; Nome da Pessoa\n";

        // Inclua o arquivo de conexão com o banco de dados
        require_once("conexao.php");

        // Consulta ao banco de dados para recuperar os dados desejados
        $sql = "SELECT data, hora, nprocesso FROM registros"; // Adicione outros campos se necessário

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Consulta para obter o nome da pessoa com base no nprocesso
                $nprocesso = $row["nprocesso"];
                $sqlNome = "SELECT Nome FROM users WHERE Processo = '$nprocesso'";
                $resultNome = $conn->query($sqlNome);
                $nome = ($resultNome->num_rows > 0) ? $resultNome->fetch_assoc()["Nome"] : "";

                // Saída dos dados
                echo $row["data"] . "; " . $row["hora"] . "; " . $row["nprocesso"] . "; " . $nome . "\n";
            }
        } else {
            echo "Não foram encontrados resultados para o intervalo de datas especificado.";
        }

        // Feche a conexão com o banco de dados
        $conn->close();
    } else {
        echo "Formato de exportação inválido.";
    }
} else {
    echo "Requisição inválida.";
}
?>
