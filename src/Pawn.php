<?php

class Pawn extends Figure
{
    public function __toString()
    {
        return $this->isBlack ? '♟' : '♙';
    }

    public function canMove(Desk $desk, $xFrom, $xTo, $yFrom, $yTo)
    {
        $absY = $yTo - $yFrom;
        $absX = abs($xTo - $xFrom);

        if (!$this->isValidMove($absX, $absY)) {
            return false;
        }

        if (1 === $absX && 1 === $absY) {
            return $this->canCapture($desk, $xTo, $yTo);
        }

        if (2 === $absY && 0 === $this->getMoves()) {
            return $this->canMoveDouble($desk, $xTo, $yTo);
        }

        return true;
    }

    private function isValidMove($absX, $absY)
    {
        if ($absY > 0 && $this->getIsBlack() === true) {
            return false;
        }

        if ($absY < 0 && $this->getIsBlack() === false) {
            return false;
        }

        if ($absY > 2) {
            return false;
        }

        if ($absX > 1) {
            return false;
        }

        if (2 === $absY && $this->getMoves() > 0) {
            return false;
        }

        return true;
    }

    /**
     * @param Desk $desk
     * @param      $xTo
     * @param      $yTo
     *
     * @return bool
     */
    private function canCapture(Desk $desk, $xTo, $yTo)
    {
        $destination = $desk->getFigure($xTo, $yTo);
        if (!$destination) {
            return false;
        }

        if ($destination->getIsBlack() === $this->getIsBlack()) {
            return false;
        }

        return true;
    }

    /**
     * @param Desk $desk
     * @param      $xTo
     * @param      $yTo
     *
     * @return bool
     */
    private function canMoveDouble(Desk $desk, $xTo, $yTo)
    {
        if ($this->getIsBlack()) {
            $tmp = $yTo + 1;
        } else {
            $tmp = $yTo - 1;
        }

        $middle = $desk->getFigure($xTo, $tmp);
        if ($middle) {
            return false;
        }

        return true;
    }
}
