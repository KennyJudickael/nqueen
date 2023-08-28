<?php
    function is_safe($echiquier, $row, $col, $n) {
        for ($i = 0; $i < $row; $i++) {
            if ($echiquier[$i][$col] == 1) {
                return false;
            }
        }

        for ($i = $row, $j = $col; $i >= 0 && $j >= 0; $i--, $j--) {
            if ($echiquier[$i][$j] == 1) {
                return false;
            }
        }

        for ($i = $row, $j = $col; $i >= 0 && $j < $n; $i--, $j++) {
            if ($echiquier[$i][$j] == 1) {
                return false;
            }
        }

        return true;
    }

    function solve_nqueen($echiquier, $row, $n, &$solutions) {
        if ($row == $n) {
            $solutions[] = $echiquier;
            return;
        }

        for ($col = 0; $col < $n; $col++) {
            if (is_safe($echiquier, $row, $col, $n)) {
                $echiquier[$row][$col] = 1;
                solve_nqueen($echiquier, $row + 1, $n, $solutions);
                $echiquier[$row][$col] = 0;
            }
        }
    }

    function solve($n) {
        $echiquier = array_fill(0, $n, array_fill(0, $n, 0));
        $solutions = [];
        solve_nqueen($echiquier, 0, $n, $solutions);
        return $solutions;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $n = intval($_POST["n"]);
        $solutions = solve($n);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>N-Queens Solver</title>
    
</head>
<body>
    <h1>N-Queens Solver</h1>
    
    <div id="solveForm">
        <form method="post">
            <label for="n">Entrez le nombre de reines :</label>
            <input type="text" id="n" name="n">
            <button type="submit" id="solveButton">Résoudre</button>
        </form>
    </div>
    
    <p style="text-align: center;">Nombre de reines : <?php echo isset($_POST["n"]) ? intval($_POST["n"]) : ""; ?></p>
    
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Affichez le nombre de solutions en bas du formulaire
        echo '<div style="text-align: center"><h3>Nombre total de solutions trouvées : ' . count($solutions) . '</h3></div>';
    ?>
        <div id="solutionContainer">
    <?php
            foreach ($solutions as $index => $solution) {
                echo '<div class="solution">';
                echo '<h2>Solution ' . ($index + 1) . '</h2>';
                echo '<div class="chessboard" style="--n: ' . count($solution) . ';">';
                
                foreach ($solution as $row) {
                    echo '<div class="row">';
                    foreach ($row as $cell) {
                        echo '<div class="cell ' . ($cell === 1 ? 'queen' : '') . '">' . ($cell === 1 ? 'Q' : '') . '</div>';
                    }
                    echo '</div>';
                }
                
                echo '</div></div>';
            }
        }
    ?>
        </div>

    <h3 id="solutionCount"></h3>

</body>
</html>
