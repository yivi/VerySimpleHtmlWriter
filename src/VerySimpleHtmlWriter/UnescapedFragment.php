<?php


namespace Yivoff\VerySimpleHtmlWriter;


class UnescapedFragment implements CompilableInterface
{

    /**
     * @var string
     */
    private $content;

    public function __construct( string $content )
    {

        $this->content = $content;
    }

    /**
     * @param string $encoding (is ignored because it is rendered unescaped)
     *
     * @return string
     */
    public function compile( $encoding = 'UTF-8' ): string
    {
        return $this->content;
    }
}