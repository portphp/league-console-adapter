<?php

namespace spec\Port\LeagueConsole;

use League\CLImate\CLImate;
use League\CLImate\TerminalObject\Dynamic\Progress;
use Port\Reader\CountableReader;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ProgressWriterSpec extends ObjectBehavior
{
    function let(CLImate $climate, CountableReader $reader)
    {
        $this->beConstructedWith($climate, $reader);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Port\LeagueConsole\ProgressWriter');
    }

    function it_writes_items(CountableReader $reader, CLImate $climate, Progress $progress)
    {
        $reader->count()->willReturn(2);
        $climate->progress(2)->willReturn($progress);
        $progress->advance()->shouldBeCalledTimes(2);
        $progress->current(2)->shouldBeCalled();

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
