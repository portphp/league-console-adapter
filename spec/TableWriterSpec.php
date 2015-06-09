<?php

namespace spec\Port\LeagueConsole;

use League\CLImate\CLImate;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TableWriterSpec extends ObjectBehavior
{
    function let(CLImate $climate)
    {
        $this->beConstructedWith($climate);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Port\LeagueConsole\TableWriter');
    }

    function it_writes_items(CLImate $climate)
    {
        $climate->table(Argument::type('array'))->shouldBeCalled();

        $this->prepare();

        $this->writeItem([
            'first'  => 'The first',
            'second' => 'Second property',
        ]);

        $this->writeItem([
            'first'  => 'Another first',
            'second' => 'Last second',
        ]);

        $this->finish();
    }
}
