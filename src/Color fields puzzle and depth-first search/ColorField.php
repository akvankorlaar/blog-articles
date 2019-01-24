<?php

class ColorField {

    /**
     * Two dimensional data field
     * @var array
     */
    private $data;

    /**
     * All visited fields
     * @var array
     */
    private $visited = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    public function calculateLargestField(): int {
        $field_sizes = [];
        foreach ($this->data as $x_index => $data_row) {
            foreach ($data_row as $y_index => $color) {
                $field_sizes[] = $this->countConnectedToField($color, $x_index, $y_index, 0);
                //clean up again for next loop
                $this->visited = [];
            }
        }

        return max($field_sizes);
    }

    private function countConnectedToField(int $color, int $x, int $y): int {
        $this->markVisited($x, $y);

        $neighbours = $this->getNeighbours($color, $x, $y);

        $total_fields = 0;
        foreach ($neighbours as $neighbour) {
            if (!$this->visited($neighbour[0], $neighbour[1])) {
                $total_fields += $this->countConnectedToField($color, $neighbour[0], $neighbour[1]);
            }
        }

        return 1 + $total_fields;
    }

    private function visited(int $x, int $y): bool {
        return isset($this->visited[$x . $y]);
    }

    private function markVisited(int $x, int $y): void {
        $this->visited[$x . $y] = true;
    }

    private function getNeighbours(int $color, int $x, int $y): array {
        $neighbours = [];
        if (isset($this->data[$x - 1][$y]) && $color === $this->data[$x - 1][$y]) {
            $neighbours[] = [$x - 1, $y];
        }
        if (isset($this->data[$x + 1][$y]) && $color === $this->data[$x + 1][$y]) {
            $neighbours[] = [$x + 1, $y];
        }
        if (isset($this->data[$x][$y - 1]) && $color === $this->data[$x][$y - 1]) {
            $neighbours[] = [$x, $y - 1];
        }
        if (isset($this->data[$x][$y + 1]) && $color === $this->data[$x][$y + 1]) {
            $neighbours[] = [$x, $y + 1];
        }

        return $neighbours;
    }
}

$data = [[1, 2, 2, 3],
    [2, 2, 2, 3],
    [3, 3, 3, 3],
    [3, 2, 2, 2],
];

$color_field = new ColorFieldCounter($data);
var_dump($color_field->extractLargestField());
