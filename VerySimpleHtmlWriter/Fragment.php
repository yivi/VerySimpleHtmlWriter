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
     * @param string $encoding
     *
     * @return string
     */
    public function compile( $encoding = 'UTF-8' ): string
    {
        return htmlspecialchars( $this->content, ENT_QUOTES | ENT_HTML5, $encoding );
    }
}