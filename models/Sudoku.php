<?php
class Sudoku {
    public static function generateBoard($difficulty) {
        $preFilled = [
            'easy' => 40,
            'medium' => 30,
            'hard' => 20
        ];

        $completeBoard = self::generateCompleteBoard();
        $board = $completeBoard;

        $cellsToRemove = 81 - ($preFilled[$difficulty] ?? 30);
        while ($cellsToRemove > 0) {
            $row = rand(0, 8);
            $col = rand(0, 8);
            if ($board[$row][$col] !== 0) {
                $board[$row][$col] = 0;
                $cellsToRemove--;
            }
        }

        return ['board' => $board, 'solution' => $completeBoard];
    }

    private static function generateCompleteBoard() {
        $board = self::generateEmptyBoard();
        self::fillBoard($board, 0, 0);
        return $board;
    }

    private static function fillBoard(&$board, $row, $col) {
        if ($row === 9) return true;
        $nextRow = $col === 8 ? $row + 1 : $row;
        $nextCol = ($col + 1) % 9;
        $numbers = range(1, 9);
        shuffle($numbers);

        foreach ($numbers as $num) {
            if (self::isValidNumber($board, $row, $col, $num)) {
                $board[$row][$col] = $num;
                if (self::fillBoard($board, $nextRow, $nextCol)) return true;
                $board[$row][$col] = 0;
            }
        }

        return false;
    }

    private static function isValidNumber($board, $row, $col, $num) {
        if (in_array($num, $board[$row])) return false;
        if (in_array($num, array_column($board, $col))) return false;

        $startRow = floor($row / 3) * 3;
        $startCol = floor($col / 3) * 3;
        for ($i = 0; $i < 3; $i++) {
            for ($j = 0; $j < 3; $j++) {
                if ($board[$startRow + $i][$startCol + $j] === $num) return false;
            }
        }

        return true;
    }

    private static function generateEmptyBoard() {
        return array_fill(0, 9, array_fill(0, 9, 0));
    }
}
?>
