<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formato = $_POST["formato"];

    if ($formato === "excel") {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="exportacao.csv"');

        // Saída do cabeçalho do CSV
        echo "Data; Hora; NProcesso; Atividade; Nome da Pessoa\n";

        // Inclua o arquivo de conexão com o banco de dados
        require_once("conexao.php");

        // Consulta ao banco de dados para recuperar os dados desejados
        $sql = "SELECT registros.data, registros.hora, registros.nprocesso, registros.atividade, users.Nome 
                FROM registros 
                LEFT JOIN users ON registros.nprocesso = users.Processo"; 

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Saída dos dados
                echo $row["data"] . "; " . $row["hora"] . "; " . $row["nprocesso"] . "; " . $row["atividade"] . "; " . $row["Nome"] . "\n";
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
