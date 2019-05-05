<?php

    /**
     * Dump object and exit.
     *
     * @param mixed $obj
     */
    function dd($obj)
    {
        die(var_dump($obj));
    }

    /**
     * Output object to browser in readable format.
     *
     * @param array $obj
     */
    function json_dump($obj)
    {
        header('Content-Type: application/json');
        echo json_encode($obj, JSON_PRETTY_PRINT);
        exit;
    }
