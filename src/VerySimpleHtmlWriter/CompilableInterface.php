<?php

namespace Yivoff\VerySimpleHtmlWriter;


interface CompilableInterface
{

    /**
     * @param string $encoding
     *
     * @return string
     */
    public function compile( $encoding = 'UTF-8' ) : string;

}