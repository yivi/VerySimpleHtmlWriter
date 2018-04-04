<?php


namespace VerySimpleHtmlWriter;


use Yivoff\VerySimpleHtmlWriter\Compilable;

class UnescapedFragment implements Compilable
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