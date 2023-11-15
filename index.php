<?php

class Player
{
    private $level;

    public function __construct(int $lvl)
    {
        $this->level = $lvl;
    }

    public function getLevel()
    {
        return $this->level;
    }

    public function setLevel($value)
    {
        $this->level = $value;
    }
}

class Encounter
{

    const RESULT_WINNER = 1;
    const RESULT_LOSER = -1;
    const RESULT_DRAW = 0;
    const RESULT_POSSIBILITIES = [self::RESULT_WINNER, self::RESULT_LOSER, self::RESULT_DRAW];

    public static function probabilityAgainst(Player $p1, Player $p2)
    {
        return 1 / (1 + (10 ** (($p2->getLevel() - $p1->getLevel()) / 400)));
    }

    public static function setNewLevel(Player $p1, Player $p2, int $playerOneResult)
    {
        if (!in_array($playerOneResult, self::RESULT_POSSIBILITIES)) {
            trigger_error(sprintf('Invalid result. Expected %s', implode(' or ', self::RESULT_POSSIBILITIES)));
        }

        $p1->setLevel($p1->getLevel() + (int) (32 * $playerOneResult - self::probabilityAgainst($p1, $p2)));
    }
}

$greg = new Player(400);
$jade = new Player(800);

echo sprintf(
    'Greg à %.2f%% chance de gagner face a Jade',
    Encounter::probabilityAgainst($greg, $jade) * 100
) . PHP_EOL;

// Imaginons que greg l'emporte tout de même.
Encounter::setNewLevel($greg, $jade, Encounter::RESULT_WINNER);
Encounter::setNewLevel($jade, $greg, Encounter::RESULT_LOSER);

echo sprintf(
    'les niveaux des joueurs ont évolués vers %s pour Greg et %s pour Jade',
    $greg->getLevel(),
    $jade->getLevel()
);

exit(0);