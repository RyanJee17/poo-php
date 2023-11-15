<?php

const RESULT_WINNER = 1;
const RESULT_LOSER = -1;
const RESULT_DRAW = 0;
const RESULT_POSSIBILITIES = [RESULT_WINNER, RESULT_LOSER, RESULT_DRAW];

class Player
{
    public $level;
}

class Encounter
{
    function probabilityAgainst(Player $p1, Player $p2)
    {
        return 1 / (1 + (10 ** (($p2->level - $p1->level) / 400)));
    }

    function setNewLevel(Player $p1, Player $p2, int $playerOneResult)
    {
        if (!in_array($playerOneResult, RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s', implode(' or ', RESULT_POSSIBILITIES)));
        }

        $p1->level += (int) (32 * ($playerOneResult - $this->probabilityAgainst($p1, $p2)));
    }
}



$greg = new Player();
$jade = new Player();
$fight = new Encounter();

$greg->level = 400;
$jade->level = 800;

echo sprintf(
    'Greg à %.2f%% chance de gagner face a Jade',
    $fight->probabilityAgainst($greg, $jade) * 100
) . PHP_EOL;

// Imaginons que greg l'emporte tout de même.
$fight->setNewLevel($greg, $jade, RESULT_WINNER);
$fight->setNewLevel($jade, $greg, RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg->level,
    $jade->level
);

exit(0);