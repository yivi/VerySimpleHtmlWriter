<?php

namespace Yivoff\VerySimpleHtmlWriter;


use Traversable;

class Layout implements Compilable, \IteratorAggregate
{

    /**
     * @var Compilable[]
     */
    private $compilables;
    /**
     * @var string
     */
    private $label;

    /**
     * CompilableCollection constructor.
     *
     * @param string       $label
     * @param Compilable[] $compilables
     */
    public function __construct( string $label, Compilable ... $compilables )
    {

        $this->label       = $label;
        $this->compilables = $compilables;
    }


    /**
     * @return string
     */
    public function compile(): string
    {
        $output = '';
        foreach ( $this->compilables as $compilable ) {
            $output .= $compilable->compile();
        }

        return $output;
    }

    public function addParts( Compilable ... $parts ) : Layout
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