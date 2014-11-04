<?php


class Alchemist implements ReversibleInterface
{
    private $is_dissolved;
    private $is_reversible;
    private $element1;
    private $element2;

    /**
     * @param $element1
     * @param $element2
     */
    public function __construct($element1, $element2)
    {
        $this->element1 = $element1;
        $this->element2 = $element2;
        $this->dissolve();
    }


    /**
     * dissolve process
     */
    private function dissolve()
    {
        if (($this->element1 instanceof Metal) && ($this->element2 instanceof Acid) ||
            ($this->element2 instanceof Metal) && ($this->element1 instanceof Acid)
        ) $this->is_dissolved = true;
        else $this->is_dissolved = false;
    }

    /**
     * @return bool
     */
    public function isDissolved()
    {
        return (bool)$this->is_dissolved;
    }

    public function ReversibleProcess()
    {
        if (time() % 10) $this->is_reversible = false;
        else $this->is_reversible = true;
    }

    /**
     * @return bool
     */
    public function isReversible()
    {
        return (bool)$this->is_reversible;
    }

} 