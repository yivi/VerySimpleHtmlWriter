<?php
/**
 * User: yivi
 *
 */

namespace Yivoff\VerySimpleHtmlWriter;

interface WriterInterface
{

    /**
     * @param string $tag
     *
     * @return Tag
     */
    public function tag( string $tag ): Tag;

    /**
     * @param string $literal
     *
     * @return Fragment
     */
    public function fragment( string $literal ): Fragment;

    /**
     * @param string $label
     *
     * @return Layout
     */
    public function layout( string $label ): Layout;

    /**
     * @param string $literal
     *
     * @return UnescapedFragment
     */
    public function unescapedFragment( string $literal ): UnescapedFragment;
}