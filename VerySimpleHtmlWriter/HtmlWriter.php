<?php

namespace VerySimpleHtmlWriter;

class HtmlWriter
{

    public function tag( string $tag ): Compilable
    {

        return new Tag( $tag, null, null );
    }

    public function fragment( string $tag ): Compilable
    {

        return new Tag( $tag, null, null );
    }

}