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
     * @param $xFrom
     * @param $xTo
     * @param $yFrom
     * @param $yTo
     *
     * @return array
     */
    public function getIntermediates($xFrom, $xTo, $yFrom, $yTo): array
    {
        throw new \RuntimeException('Not implemented');
    }

    /**
     * @param $xFrom
     * @param $xTo
     * @param $yFrom
     * @param $yTo
     *
     * @return bool
     */
    public function mustCapture($xFrom, $xTo, $yFrom, $yTo): bool
    {
        return false;
    }

    /**
     * @param       $xFrom
     * @param       $xTo
     * @param       $yFrom
     * @param       $yTo
     *
     * @param array $intermediates
     *
     * @return bool
     *
     */
    public function canMove($xFrom, $xTo, $yFrom, $yTo, array $intermediates): bool
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
