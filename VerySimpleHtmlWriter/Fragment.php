<?php

namespace Yivoff\VerySimpleHtmlWriter;


class Fragment implements Compilable
{

    /**
     * @var string
     */
    private $content;

    /**
     * Fragment constructor.
     *
     * @param string $content
     */
    public function __construct( string $content )
    {

        $this->content = $content;
    }

    /**
     * @return string
     */
    public function compile(): string
    {
        return $this->content;
    }
}