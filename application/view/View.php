<?php

namespace View;

class View
{
    static function showResult($rows)
    {
        header('Content-Type: application/json');
        print_r(json_encode($rows));
    }
}