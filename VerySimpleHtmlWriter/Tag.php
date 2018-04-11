<?php

namespace Yivoff\VerySimpleHtmlWriter;


class Tag implements Compilable
{

    /**
     * @var string
     */
    private $tag;
    /**
     * @var null|Compilable
     */
    private $content;
    /**
     * @var array|null
     */
    private $attributes;

    /** @var bool */
    private $leaveOpen = false;

    /** @var bool */
    private $justClose = false;

    /**
     * Tag constructor.
     *
     * @param string          $tag
     * @param null|Compilable $content
     * @param array|null      $attributes
     */
    public function __construct( string $tag, ?Compilable $content, ?array $attributes )
    {

        $this->tag        = $tag;
        $this->content    = $content;
        $this->attributes = $attributes;
    }

    /**
     * @param Compilable $content
     *
     * @return Tag
     */
    public function content( Compilable $content ): Tag
    {
        $this->content = $content;

        return $this;
    }

    public function getContent(): Compilable
    {
        return $this->content;
    }

    /**
     * @return bool
     */
    public function hasContent()
    {
        return $this->content instanceof Compilable;
    }

    /**
     * @param string $attr
     * @param string $value
     *
     * @return Tag
     */
    public function attribute( string $attr, string $value ): Tag
    {
        $this->attributes[$attr] = $value;

        return $this;
    }

    /**
     * @param string $attr
     *
     * @return Tag
     */
    public function removeAttribute( string $attr ): Tag
    {
        if ( isset( $this->attributes[$attr] ) ) {
            unset( $this->attributes[$attr] );
        }

        return $this;
    }

    /**
     * @param string $encoding
     *
     * @return string
     */
    public function compile( $encoding = 'UTF-8' ): string
    {
        // If we just want to close an errant tag, let's leave this party as early as possible.
        if ( $this->justClose ) {
            return $this->compileCloseTag();
        }

        // first, we want an open tag, with all its attributes
        $html = $this->compileOpenTag( $encoding );

        // if we have content on this tag, let's get that content compiled!
        if ( $this->hasContent() ) {
            $html .= $this->content->compile( $encoding );

            // if for some reason we do not want the close tag on this baby, it is fine.
            if ( ! $this->leaveOpen ) {
                $html .= $this->compileCloseTag();
            }
        }

        return $html;

    }

    private function compileCloseTag(): string
    {
        $html = "</" . $this->tag . '>';

        return $html;
    }

    /**
     * @param string $encoding
     *
     * @return string
     */
    private function compileOpenTag( $encoding = 'UTF-8' ): string
    {

        $html       = "<" . $this->tag;
        $attributes = $this->compileAttributes( $encoding );

        if ( ! empty( $attributes ) ) {
            $html .= " $attributes";
        }

        // if we do have content, then let's carry on.
        if ( $this->hasContent() ) {
            $html .= '>';
        } else {
            // but if we do not have content, it must be a self-closed tag
            $html .= ' />';
        }

        return $html;
    }

    /**
     * @param string $encoding
     *
     * @return string
     */
    private function compileAttributes( $encoding = 'UTF-8' ): string
    {
        if ( empty( $this->attributes ) ) {
            return "";
        }

        $attributes = [];
        foreach ( $this->attributes as $attribute => $value ) {
            $attribute    = htmlspecialchars( $attribute, ENT_QUOTES | ENT_HTML5, $encoding );
            $value        = htmlspecialchars( $value, ENT_QUOTES | ENT_HTML5, $encoding );
            $attributes[] = "$attribute='$value'";
        }

        return implode( ' ', $attributes );
    }

    public function leaveOpen( bool $bool = true ): Tag
    {
        $this->leaveOpen = $bool;

        return $this;
    }

    public function justClose( bool $bool = true ): Tag
    {
        $this->justClose = $bool;

        return $this;
    }


    // Convienience Methods

    /**
     * Convenience method to add a "class" to a tag.
     *
     * @param string $class
     *
     * @return Tag
     */
    public function addClass( string $class ): Tag
    {

        if ( ! isset( $this->attributes['class'] ) ) {
            $this->attributes['class'] = $class;
        } else {
            $this->attributes['class'] .= " $class";
        }

        return $this;
    }

    /**
     * Convenience method to set the "id" of a tag.
     *
     * @param string $id
     *
     * @return Tag
     */
    public function id( string $id ): Tag
    {


        $this->attributes['id'] = $id;

        return $this;
    }

    /**
     * Convenience method to set the "value" of an input
     *
     * @param string $value
     *
     * @return Tag
     */
    public function value( string $value ): Tag
    {

        $this->attributes['value'] = $value;

        return $this;
    }

    /**
     * Convenience method to set the "name" of an input.
     *
     * @param string $name
     *
     * @return Tag
     */
    public function name( string $name ): Tag
    {
        $this->attributes['name'] = $name;

        return $this;
    }
}