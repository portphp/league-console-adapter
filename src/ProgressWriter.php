<?php

namespace Port\LeagueConsole;

use Port\Reader\CountableReader;
use Port\Writer;
use League\CLImate\CLImate;
use League\CLImate\TerminalObject\Dynamic\Progress;

/**
 * Writes progressbar using League CLImate
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class ProgressWriter implements Writer
{
    /**
     * @var CLImate
     */
    protected $climate;

    /**
     * @var Progress
     */
    protected $progress;

    /**
     * @var CountableReader
     */
    protected $reader;

    /**
     * @var integer
     */
    protected $count;

    /**
     * @param CLImate         $climate
     * @param CountableReader $reader
     */
    public function __construct(CLImate $climate, CountableReader $reader)
    {
        $this->climate = $climate;
        $this->reader  = $reader;
    }

    /**
     * {@inheritdoc}
     */
    public function prepare()
    {
        $this->count = $this->reader->count();
        $this->progress = $this->climate->progress($this->count);
    }

    /**
     * {@inheritdoc}
     */
    public function writeItem(array $item)
    {
        $this->progress->advance();
    }

    /**
     * {@inheritdoc}
     */
    public function finish()
    {
        $this->progress->current($this->count);
    }
}
