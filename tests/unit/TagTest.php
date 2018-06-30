<?php

use Yivoff\VerySimpleHtmlWriter\CompilableInterface;
use Yivoff\VerySimpleHtmlWriter\Tag;

class TagTest extends \Codeception\MockeryModule\Test
{

    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testEmptyTagNoAttributes()
    {
        $hr = new Tag( 'hr', null, null );

        $this->assertEquals( '<hr />', $hr->compile() );
    }

    public function testEmptyTagWithAttribute()
    {
        $i = new Tag( 'i', null, ['class' => 'item'] );

        $this->assertEquals( "<i class='item' />", $i->compile() );
    }

    public function testEmptyTagWithMultipleAttributes()
    {
        $i = new Tag( 'i', null, ['class' => 'item', 'data-test' => 'foo', 'id' => 'baz'] );

        $this->assertEquals( "<i class='item' data-test='foo' id='baz' />", $i->compile() );
    }

    public function testWithContentNoAttributes()
    {
        /** @var CompilableInterface $mockCompilable */
        $mockCompilable = \Mockery::mock( CompilableInterface::class )
                                  ->shouldReceive( ['compile' => 'foo bar!'] )
                                  ->getMock();

        $h1 = new Tag( 'h1', $mockCompilable, null );

        $this->assertEquals( "<h1>foo bar!</h1>", $h1->compile() );
    }

    public function testWithContentMultipleAttributes()
    {

        /** @var CompilableInterface $mockCompilable */
        $mockCompilable = \Mockery::mock( CompilableInterface::class )
                                  ->shouldReceive( ['compile' => 'foo bar!'] )
                                  ->getMock();

        $div = new Tag( 'div', $mockCompilable, ['class' => 'main', 'id' => 'baz'] );

        $this->assertEquals( "<div class='main' id='baz'>foo bar!</div>", $div->compile() );
    }

    public function testWithContentLeftOpen()
    {

        /** @var CompilableInterface $mockCompilable */
        $mockCompilable = \Mockery::mock( CompilableInterface::class )
                                  ->shouldReceive( ['compile' => 'foo bar!'] )
                                  ->getMock();

        $div = new Tag( 'div', $mockCompilable, ['class' => 'main', 'id' => 'baz'] );

        $div->leaveOpen();

        $this->assertEquals( "<div class='main' id='baz'>foo bar!", $div->compile() );
    }

    public function testWithContentButJustClose()
    {

        /** @var CompilableInterface $mockCompilable */
        $mockCompilable = \Mockery::mock( CompilableInterface::class )
                                  ->shouldReceive( ['compile' => 'foo bar!'] )
                                  ->getMock();

        $div = new Tag( 'div', $mockCompilable, ['class' => 'main', 'id' => 'baz'] );

        $div->justClose();

        $this->assertEquals( "</div>", $div->compile() );
    }

    public function testNonsenseShouldOnlyClose() {

        /** @var CompilableInterface $mockCompilable */
        $mockCompilable = \Mockery::mock( CompilableInterface::class )
                                  ->shouldReceive( ['compile' => 'foo bar!'] )
                                  ->getMock();

        $div = new Tag( 'div', $mockCompilable, ['class' => 'main', 'id' => 'baz'] );

        $div->leaveOpen()->justClose();

        $this->assertEquals( "</div>", $div->compile() );
    }
}