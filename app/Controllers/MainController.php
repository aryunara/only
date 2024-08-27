<?php

namespace Controllers;

class MainController
{
    public function getMain(): void
    {
        require_once './../Views/main.php';
    }

}