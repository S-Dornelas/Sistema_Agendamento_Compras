<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

echo "<footer>";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    if (isset($_SESSION['username'])) {
        echo "<p>Acessado por " . $_SESSION['username'] . " em " . date('d/m/y') . "</p>";
    } else {
        echo "<p>Erro: Nome de usuário não definido na sessão</p>";
    }
} else {
    echo "<p>Acesso não autenticado em " . date('d/m/y') . "</p>";
}
echo "<p>Desenvolvido por Sandro Dornelas & Pedro Bacovis</p>";
echo "</footer>";

$banco->close();
?>
