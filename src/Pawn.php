<?php

class Pawn extends Figure
{
    // после первого хода менять на 1
    protected $moveLenLimit = 2;

    public function checkMoveDirection($from, $to, $figures)
    {
        $xFrom = $from[0];
        $yFrom = $from[1];
        $xTo   = $to[0];
        $yTo   = $to[1];

        // по горизонтали нельзя
        if ($yFrom == $yTo && $xFrom != $xTo) {
            throw new \Exception("Incorrect move direction");
        }

        // не ходить назад
        $dirWay = $yFrom - $yTo;

        if ($this->isBlack && $dirWay < 0
            || !$this->isBlack && $dirWay > 0
        ) {
            throw new \Exception('Don\'t go back');
        }

        // длина и направление
        $moveLen = abs($dirWay);
        $horizLen = abs(ord($xFrom) - ord($xTo));

        if ($horizLen > 1) {
            throw new \Exception('Incorrect move');
        }

        $moveForward = $xFrom == $xTo;

        if (!$moveForward) {
            // по диагонали
            if ($moveLen > 1                                       // так можно только на одну клетку
                || empty($figures[$xTo][$yTo])                     // так можно, если позиция занята
                || $figures[$xTo][$yTo]->isBlack == $this->isBlack // так можно, только если позиция занята противником
            ) {
                throw new \Exception('Incorrect move');
            }
        } else {
            // прибавка направления "вперёд" относительно цвета фигуры
            $fvInc = $this->isBlack ? -1 : 1;

            if ($moveLen > $this->moveLenLimit                                                 // по прямой
                || !empty($figures[$xFrom][($fvInc + $yFrom)])                                 // только на пустые клетки
                || 2 == $this->moveLenLimit && !empty($figures[$xFrom][(2 * $fvInc + $yFrom)]) // только на пустые клетки #2
            ) {
                throw new \Exception('Incorrect move');
            }
        }

        $this->moveLenLimit = 1;
    }

    public function __toString()
    {
        return $this->isBlack ? '♟' : '♙';
    }
}
