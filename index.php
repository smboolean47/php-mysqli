<?php
require_once __DIR__ . '/config.php';

$conn = new mysqli(DB_SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME);

if( $conn && $conn->connect_error ) {
    echo "Errore nella connessione: {$conn->connect_error}";
    die();
}

// Connessione è avvenuta con successo

$stmt = $conn->prepare("SELECT * FROM `departments` WHERE `id` = ?");
$stmt->bind_param('i', $id);

$id = $_GET['id'];

$stmt->execute();

$result = $stmt->get_result();

//$result = $conn->query($sql);

if( $result && $result->num_rows > 0 ) {

    while( $row = $result->fetch_assoc() ) {
        echo "<strong>{$row['name']}</strong> {$row['address']}, direttore: {$row['head_of_department']} <br>";
    }

} else if ( $result ) {
    echo "Nessun risultato";
} else {
    echo "Errore nella query";
}
