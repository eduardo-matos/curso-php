<?php

setcookie('nome_usuario', 'eduardo', time() + 86400);

echo $_COOKIE['nome_usuario'];

// cookie existe?
isset($_COOKIE['nome_usuario']); // true
