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

    /**
     * @return bool
     */
    public function hasContent()
    {
        return ! is_null( $this->content );
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
     * @return string
     */
    public function compile(): string
    {
        $html       = "<" . $this->tag;
        $attributes = $this->compileAttributes();

        if ( ! empty( $attributes ) ) {
            $html .= " $attributes";
        }

        if ( ! $this->hasContent() ) {
            $html .= ' />';
        } elseif ( $this->content instanceof Compilable ) {
            $html .= '>';
            $html .= $this->content->compile();
            $html .= "</" . $this->tag . '>';
        }

        return $html;

    }

    private function compileCloseTag(): string
    {
        $html = "</" . $this->tag . '>';

        return $html;
    }

    private function compileOpenTag(): string
    {

        $html       = "<" . $this->tag;
        $attributes = $this->compileAttributes();

        if ( ! empty( $attributes ) ) {
            $html .= " $attributes";
        }

        if ( $this->hasContent() ) {
            $html .= ' />';
        } else {
            $html .= '>';
        }

        return $html;
    }

    /**
     * @return string
     */
    private function compileAttributes(): string
    {
        if ( empty( $this->attributes ) ) {
            return "";
        }

        $attributes = [];
        foreach ( $this->attributes as $attribute => $value ) {
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
}