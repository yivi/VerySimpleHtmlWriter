<?php

namespace Yivoff\VerySimpleHtmlWriter;

class HtmlWriterService
{

    /**
     * @param string $tag
     *
     * @return Compilable
     */
    public function tag( string $tag ): Compilable
    {

        return new Tag( $tag, null, null );
    }

    /**
     * @param string $tag
     *
     * @return Compilable
     */
    public function fragment( string $tag ): Compilable
    {

        return new Fragment( $tag );
    }

}