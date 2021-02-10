<?php 

/** implementa redirect para urls amigaveis */
function redireciona(string $url): void
{
     // post redirect get
     header("Location: $url");
     die();
}