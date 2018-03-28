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

    public function content( Compilable $content ): Tag
    {
        $this->content = $content;

        return $this;
    }

    public function hasContent()
    {
        return ! is_null( $this->content );
    }

    public function attribute( string $attr, string $value ): Tag
    {
        $this->attributes[$attr] = $value;

        return $this;
    }

    public function removeAttribute( string $attr ): Tag
    {
        if ( isset( $this->attributes[$attr] ) ) {
            unset( $this->attributes[$attr] );
        }

        return $this;
    }

    public function compile(): string
    {
        $html       = "<" . $this->tag;
        $attributes = $this->compileAttributes();

        if ( ! empty( $attributes ) ) {
            $html .= " $attributes ";
        }

        if ( ! $this->hasContent() ) {
            $html .= '/>';
        } elseif ( $this->content instanceof Compilable ) {
            $html .= $this->content->compile();
            $html .= "</" . $this->tag . '>';
        }

        return $html;

    }


    private function compileAttributes(): string
    {
        $attributes = [];
        foreach ( $this->attributes as $attribute => $value ) {
            $attributes[] = "$attribute='$value'";
        }

        return implode( ' ', $attributes );
    }
}