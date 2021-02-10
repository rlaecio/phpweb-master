<?php


$mysql = new mysqli("192.168.1.3", "root", "secret", "blog");
$mysql->set_charset('utf8');

if($mysql == FALSE) {
    echo 'Erro na conexão';
}