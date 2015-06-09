<?php

namespace Port\LeagueConsole;

use League\CLImate\CLImate;
use Port\Writer;
use Port\Writer\WriterTemplate;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class TableWriter implements Writer
{
    use WriterTemplate;

    /**
     * @var CLImate
     */
    private $climate;

    /**
     * @var array
     */
    private $data;

    /**
     * @param CLImate $climate
     */
    public function __construct(CLImate $climate) {
        $this->climate = $climate;
    }

    /**
     * {@inheritdoc}
     */
    public function writeItem(array $item) {

        // Save headers
        if (empty($this->data)) {
            $this->data = array_keys($item);
        }

        $this->data[] = $item;
    }

    /**
     * {@inheritdoc}
     */
    public function finish() {
        $this->climate->table($this->data);
    }
}
