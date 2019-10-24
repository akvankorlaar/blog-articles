Imagine you have a picture with red, blue and green tiles.
Your job is to write a program that finds the size of the largest connected field.
Connected meaning that a color has to be connected by a field with the same color
on the left, right, top or bottom. 

![colorfields](/images/colorfield.png)

As you can see, in the image the solution would be the 7 connected green fields.

While this seems simple, what makes this
puzzle interesting is that it involves many different programming techniques,
and so I thought it would be fun to write a blog about it.

If you're up for a challenge, you could try to program
the puzzle in your favorite programming language, and come back later to 
see if you have a similar solution. Many different solutions are possible, and
the one listed below is only one of the possible implementations.

## The solution

First thing you need to consider is how you want to represent the two-dimensional grid.
The simplest solution I can think of is just making an array of arrays,
in which 1 = red, 2 = blue, and 3 = green.
So you will have:

```php

$data = [[1, 2, 2, 3],
         [2, 2, 3, 3],
         [3, 3, 3, 3],
         [2, 2, 2, 2],
        ];

```

The second thing we could do is make a class that accepts our data.

```php

class ColorFieldCounter {

    /**
     * Two dimensional data field
     */
    private $data;

    public function __construct(array $data) {
        $this->data = $data;
    }
}

```

When counting, an important consideration is that we need 
a way to store which fields we have been before, because you only
want to count each field once. We can treat our 4x4 grid as 
a set of coordinates with an x-axis and a y-axis. So top left would be point (1,4)
and bottom right would be point (4,1). We can make use of this when storing
where we've already been by adding these coordinates in key value pairs
in an associative array. So if we've been to point (4,1), we store this value
by setting `$visited[$x . $y] = true;`
We can use these values to look up if we've been there without having
to loop through everything again. 

In PHP, an associative array is implemented as a hash map underneath, so checking if something has been visited is pretty fast.

```php

class ColorFieldCounter {

    /**
     * Two dimensional data field
     */
    private $data;

    /**
     * All visited fields
     */
    private $visited = [];

    public function __construct(array $data) {
        $this->data = $data;
    }

    private function visited(int $x, int $y): bool {
        return isset($this->visited[$x . $y]);
    }

    private function markVisited(int $x, int $y): void {
        $this->visited[$x . $y] = true;
    }
}

```

Next we'll want a method for looking up the neighbours of a given coordinate.
You'll have to do some collision detection for this. Also remember we only want
the fields that have the same color.

```php
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
```

Now comes the real tricky part. You can't just count the color that occurs
most in the grid, because you have to look if everything is connected. So imagine
you started at a certain point, you'll have to check all its neighbours if
the point is connected to others of the same color. After this,
you have to check the neighbours of the neighbours, and afterwards the
neighbours of the neighbours of the neighbours ...

You can solve this in different ways. In this blog I chose a depth-first
recursive search algorithm.

```php

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

```

This checks for any point how many of the same color are connected. We
start by marking the current field as visited. Afterwards we get all the neighbours
that have the same color. If there aren't any connected to the current point
 the function terminates as 1 + 0 = 1.

Imagine there are three blue fields connected to each other (for example points (2,1), (3,1 and (4,1) of the example).
When you call this algorithm on the first point, it will first mark itself as visited.
It will find one other connected neighbour with the same color: the second point. After
calling this point, and marking it, this point will also only find one other point,
despite having 2 neighbours with the same color, because the first one has already been marked. 
The last point will not find any other connected neighbours, so our third call terminates with 1 + 0.
Now we start backtracking. The first result will be passed on to the second call for the second point,
and so our second call will terminate in 1 + 1 = 2. Now we're back at the call that started
at our original point, which will now terminate with 1 + 2 = 3.

This is a [depth-first search algorithm](https://en.wikipedia.org/wiki/Depth-first_search),
 because the algorithm always explores the first neighbour it encounters, as far as it can,
before starting to backtrack.

Now that the hard part is over, we just need something to call this function
for every point in our grid, and store the result. This can be done by just doing two loops. 
Afterwards, the largest field is found by taking the largest number of the resulting array.


```php

    public function extractLargestField(): int {
        $all_connected_numbers = [];
        foreach ($this->data as $index => $data_row) {
            foreach ($data_row as $index2 => $data_point) {
                $all_connected_numbers[] = $this->countConnectedToField($data_point, $index, $index2, 0);
                //clean up again for next loop
                $this->visited = [];
            }
        }

        return max($all_connected_numbers);
    }
```

Now let's run it.

```php
$data = [[1, 2, 2, 3],
    [2, 2, 3, 3],
    [3, 3, 3, 3],
    [2, 2, 2, 2],
];

$color_field_counter = new ColorFieldCounter($data);
var_dump($color_field_counter->extractLargestField());
```

Assuming you named the file ColorFieldCounter.php, running
```php ColorFieldCounter.php ``` in the terminal
should return 7.

## Improvements

Naturally this approach does have a few drawbacks. Most importantly this was
only a very small field, but imagine we had a two-dimensional field with a size
of 50.000 by 50.000 tiles. A recursive function can only call
itself so many times before a [stack overflow](https://en.wikipedia.org/wiki/Stack_buffer_overflow) occurs ,
so our algorithm won't work there. A better approach would be to make
an [iterative](https://www.techiedelight.com/depth-first-search/) solution,
instead of the recursive one we made.

Also, strictly speaking we do not have to clear the visited array every time we searched through
a point. We only have to start a depth-first search on any point on a field to find the number
of connected points of that field, and so it is not necessary to do another search if any point of
 the field is already in the visited array.

In my next blog, I plan to refactor this algorithm to an iterative solution.
