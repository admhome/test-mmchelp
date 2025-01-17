<?php

class Figure
{
    protected $isBlack;

    public function __construct($isBlack)
    {
        $this->isBlack = $isBlack;
    }

    public function __get($property)
    {
        if (!in_array($property, ['isBlack'])) {
            throw new Exception('Invalid property');
        }

        return $this->$property;
    }

    public function checkMoveDirection($from, $to, $figures)
    {
        return true;
    }

    public function __toString()
    {
        throw new \Exception("Not implemented");
    }
}
