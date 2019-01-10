<?php

class Pawn extends Figure
{
    public function __toString()
    {
        return $this->isBlack ? '♟' : '♙';
    }

    public function getIntermediates($xFrom, $xTo, $yFrom, $yTo): array
    {
        if (abs($yFrom - $yTo) > 1) {
            if ($this->getIsBlack()) {
                $yTmp = $yTo + 1;
            } else {
                $yTmp = $yTo - 1;
            }

            return [[$xTo, $yTmp]];
        }

        return [];
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
        if ($xFrom !== $xTo) {
            return true;
        }

        return false;
    }

    /**
     * @param       $xFrom
     * @param       $xTo
     * @param       $yFrom
     * @param       $yTo
     * @param array $intermediates
     *
     * @return bool
     */
    public function canMove($xFrom, $xTo, $yFrom, $yTo, array $intermediates): bool
    {
        $absY = $yTo - $yFrom;
        $absX = abs($xTo - $xFrom);

        if ($absY > 0 && $this->getIsBlack() === true) {
            return false;
        }

        if ($absY < 0 && $this->getIsBlack() === false) {
            return false;
        }

        $absY = abs($absY);

        if ($absY > 2) {
            return false;
        }

        if ($absX > 1) {
            return false;
        }

        if (2 === $absY && $this->getMoves() > 0) {
            return false;
        }

        if (2 === $absY && count($intermediates)) {
            return false;
        }

        if (2 === $absY && 0 === $this->getMoves()) {
            return $this->canMoveDouble($intermediates);
        }

        return true;
    }

    /**
     * @param array $cells
     *
     * @return bool
     */
    private function canMoveDouble(array $cells)
    {
        foreach ($cells as $cell) {
            if ($cell) {
                return false;
            }
        }

        return true;
    }
}
