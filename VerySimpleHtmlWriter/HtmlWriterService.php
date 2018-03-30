<?php

namespace Yivoff\VerySimpleHtmlWriter;

class HtmlWriterService
{

    /**
     * @param string $tag
     *
     * @return Tag
     */
    public function tag( string $tag ): Tag
    {

        return new Tag( $tag, null, null );
    }

    /**
     * @param string $literal
     *
     * @return Fragment
     */
    public function fragment( string $literal ): Fragment
    {

        return new Fragment( $literal );
    }

    /**
     * @param string $label
     *
     * @return Layout
     */
    public function layout( string $label ) : Layout
    {
        return new Layout( $label );
    }

}