<?php
// Conectar ao banco de dados (substitua 'localhost', 'username', 'password' e 'database' com suas próprias configurações)
$conn = new mysqli('localhost', 'username', 'password', 'database');

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Preparar a declaração SQL para inserir um novo evento no histórico
$sql = "INSERT INTO historico (evento, data_hora) VALUES (?, NOW())";
$stmt = $conn->prepare($sql);

// Verificar se a declaração SQL está pronta
if ($stmt === false) {
    die("Erro ao preparar a declaração SQL: " . $conn->error);
}

// Bind dos parâmetros e execução da declaração SQL
$evento = "Evento ocorreu"; // Substitua esta string com o evento real
$stmt->bind_param("s", $evento);
$stmt->execute();

// Verificar se a execução foi bem-sucedida
if ($stmt->affected_rows > 0) {
    echo "Evento registrado com sucesso no histórico.";
} else {
    echo "Erro ao registrar evento no histórico: " . $stmt->error;
}

// Fechar a declaração e a conexão
$stmt->close();
$conn->close();
// Conectar ao banco de dados (substitua 'localhost', 'username', 'password' e 'database' com suas próprias configurações)
$conn = new mysqli('localhost', 'username', 'password', 'database');

// Verificar a conexão
if ($conn->connect_error) {
    die("Erro ao conectar ao banco de dados: " . $conn->connect_error);
}

// Consulta SQL para obter o histórico de eventos
$sql = "SELECT evento, data_hora FROM historico ORDER BY data_hora DESC";
$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Exibir os resultados
    while ($row = $result->fetch_assoc()) {
        echo "Evento: " . $row["evento"] . " - Data/Hora: " . $row["data_hora"] . "<br>";
    }
} else {
    echo "Nenhum evento no histórico.";
}

// Fechar a conexão
$conn->close();
?>
