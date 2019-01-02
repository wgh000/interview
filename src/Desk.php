<?php

class Desk
{
    private $figures = [];

    private $moves = 0;

    public function __construct()
    {
        $this->figures['a'][1] = new Rook(false);
        $this->figures['b'][1] = new Knight(false);
        $this->figures['c'][1] = new Bishop(false);
        $this->figures['d'][1] = new Queen(false);
        $this->figures['e'][1] = new King(false);
        $this->figures['f'][1] = new Bishop(false);
        $this->figures['g'][1] = new Knight(false);
        $this->figures['h'][1] = new Rook(false);

        $this->figures['a'][2] = new Pawn(false);
        $this->figures['b'][2] = new Pawn(false);
        $this->figures['c'][2] = new Pawn(false);
        $this->figures['d'][2] = new Pawn(false);
        $this->figures['e'][2] = new Pawn(false);
        $this->figures['f'][2] = new Pawn(false);
        $this->figures['g'][2] = new Pawn(false);
        $this->figures['h'][2] = new Pawn(false);

        $this->figures['a'][7] = new Pawn(true);
        $this->figures['b'][7] = new Pawn(true);
        $this->figures['c'][7] = new Pawn(true);
        $this->figures['d'][7] = new Pawn(true);
        $this->figures['e'][7] = new Pawn(true);
        $this->figures['f'][7] = new Pawn(true);
        $this->figures['g'][7] = new Pawn(true);
        $this->figures['h'][7] = new Pawn(true);

        $this->figures['a'][8] = new Rook(true);
        $this->figures['b'][8] = new Knight(true);
        $this->figures['c'][8] = new Bishop(true);
        $this->figures['d'][8] = new Queen(true);
        $this->figures['e'][8] = new King(true);
        $this->figures['f'][8] = new Bishop(true);
        $this->figures['g'][8] = new Knight(true);
        $this->figures['h'][8] = new Rook(true);
    }

    public function move($move)
    {
        if (!preg_match('/^([a-h])(\d)-([a-h])(\d)$/', $move, $match)) {
            throw new \RuntimeException('Not valid parameters');
        }

        list($xFrom, $yFrom, $xTo, $yTo) = [$match[1], $match[2], $match[3], $match[4]];

        $figure = $this->getFigure($xFrom, $yFrom);

        if (!$figure || !$this->canMove($figure, $xFrom, $xTo, $yFrom, $yTo)) {
            throw new \RuntimeException('Cannot move');
        }

        $figure->incrementMoves();

        $this->figures[$xTo][$yTo] = $figure;
        unset($this->figures[$xFrom][$yFrom]);

        $this->moves++;
    }

    /**
     * @param $xVar
     * @param $yVar
     *
     * @return Figure
     */
    public function getFigure($xVar, $yVar)
    {
        if (is_int($xVar)) {
            $xVar = $this->toString($xVar);
        }

        return isset($this->figures[$xVar][$yVar]) ? $this->figures[$xVar][$yVar] : null;
    }

    public function canMove(Figure $figure, $xFrom, $xTo, $yFrom, $yTo)
    {
        if ($this->isBlackTurn() !== $figure->getIsBlack()) {
            return false;
        }

        if (!$figure->canMove($this, $this->toDecimal($xFrom), $this->toDecimal($xTo), $yFrom, $yTo)) {
            return false;
        }

        return true;
    }

    public function dump()
    {
        for ($y = 8; $y >= 1; $y--) {
            echo "$y ";
            for ($x = 'a'; $x <= 'h'; $x++) {
                if (isset($this->figures[$x][$y])) {
                    echo $this->figures[$x][$y];
                } else {
                    echo '-';
                }
            }
            echo "\n";
        }
        echo "  abcdefgh\n";
    }

    private function toDecimal($xChar)
    {
        return ord($xChar) - 97;
    }

    private function toString($xChar)
    {
        return chr($xChar + 97);
    }

    /**
     * @return bool
     */
    protected function isBlackTurn()
    {
        return 1 === $this->moves % 2;
    }
}
