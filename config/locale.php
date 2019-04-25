<?php

return [

    /*
     * Show language selector
     *
     * @var bool
     */
    'status' => true,

    /*
     * Lenguajes disponibles
     *
     * Agrega el código de lenguaje al siguiente array
     * El código debe tener el mismo nombre que en la carpeta de lenguajes
     * Asegurate de que estén en orden alfabetico
     *
     * El seleccionador de lenguaje no se verá en front si solo hay un lenguaje en el array
     *
     * @var array
     */
    'languages' => [
        /*
         * Key is the Laravel locale code
         * Index 0 del sub-array es el Carbon locale code
         * Index 1 del sub-array es el PHP locale code para setlocale()
         * Index 2 del sub-array es true o false si usa RTL (right-to-left) css para el lenguaje
         */

        'en'    => ['en', 'en_US', false],
        'es'    => ['es', 'es_ES', false],
    ],
];