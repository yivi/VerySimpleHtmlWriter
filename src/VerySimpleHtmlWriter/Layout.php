<?php

namespace Yivoff\VerySimpleHtmlWriter;


use Traversable;

class Layout implements CompilableInterface, \IteratorAggregate
{

    /**
     * @var CompilableInterface[]
     */
    private $compilables;
    /**
     * @var string
     */
    private $label;

    /**
     * CompilableCollection constructor.
     *
     * @param string                $label
     * @param CompilableInterface[] $compilables
     */
    public function __construct( string $label, CompilableInterface ... $compilables )
    {

        $this->label       = $label;
        $this->compilables = $compilables;
    }


    /**
     * @param string $encoding
     *
     * @return string
     */
    public function compile($encoding = 'UTF-8'): string
    {
        $output = '';
        foreach ( $this->compilables as $compilable ) {
            $output .= $compilable->compile($encoding);
        }

        return $output;
    }

    public function addParts( CompilableInterface ... $parts ) : Layout
    {

        $this->compilables = array_merge($this->compilables, $parts);

        return $this;
    }

    /**
     * Retrieve an external iterator
     *
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        return new \ArrayIterator( $this->compilables );
    }
}