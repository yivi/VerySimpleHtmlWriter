<?php

namespace VerySimpleHtmlWriter;


class Fragment implements Compilable
{

    /**
     * @var string
     */
    private $content;

    public function __construct( string $content )
    {

        $this->content = $content;
    }

    public function compile(): string
    {
        return $this->content;
    }
}