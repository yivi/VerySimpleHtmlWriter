<?php

namespace Yivoff\VerySimpleHtmlWriter;


interface Compilable
{

    /**
     * @return string
     */
    public function compile(  ) : string;

}