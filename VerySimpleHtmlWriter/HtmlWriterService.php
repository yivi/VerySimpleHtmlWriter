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
     * @param string $tag
     *
     * @return Fragment
     */
    public function fragment( string $tag ): Fragment
    {

        return new Fragment( $tag );
    }

    /**
     * @param array $compilables
     *
     * @return CompilableCollection
     */
    public function collection( array $compilables ) : CompilableCollection
    {
        return new CompilableCollection( ... $compilables );
    }

}