<?php

namespace Yivoff\VerySimpleHtmlWriter;


use Traversable;

class CompilableCollection implements Compilable, \IteratorAggregate
{

    /**
     * @var Compilable[]
     */
    private $compilables;

    public function __construct( Compilable ... $compilables )
    {

        $this->compilables = $compilables;
    }


    public function compile(): string
    {
        $output = '';
        foreach ( $this->compilables as $compilable ) {
            $output .= $compilable->compile();
        }

        return $output;
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