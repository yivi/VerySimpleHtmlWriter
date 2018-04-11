<?php

namespace Yivoff\VerySimpleHtmlWriter;


interface Compilable
{

    /**
     * @param string $encoding
     *
     * @return string
     */
    public function compile( $encoding = 'UTF-8' ) : string;

}