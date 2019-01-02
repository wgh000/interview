<?php

class Figure
{
    protected $isBlack;
    protected $moves = 0;

    public function __construct($isBlack)
    {
        $this->isBlack = $isBlack;
    }

    /** @noinspection PhpToStringReturnInspection */
    public function __toString()
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * @param Desk $desk
     * @param      $xFrom
     * @param      $xTo
     * @param      $yFrom
     * @param      $yTo
     *
     * @return bool
     *
     * @throws Exception
     */
    public function canMove(Desk $desk, $xFrom, $xTo, $yFrom, $yTo)
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * @return mixed
     */
    public function getIsBlack()
    {
        return $this->isBlack;
    }

    /**
     */
    public function incrementMoves()
    {
        $this->moves++;
    }

    /**
     * @return int
     */
    public function getMoves()
    {
        return $this->moves;
    }
}
