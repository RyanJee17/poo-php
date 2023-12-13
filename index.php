<?php

/*
 * This file is part of the OpenClassRoom PHP Object Course.
 *
 * (c) Grégoire Hébert <contact@gheb.dev>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

require_once('Lobby/Looby.php');
require_once('Player/QueuingPlayer.php');
require_once('Player/Player.php');
require_once('Player/AbstractPlayer.php');
require_once('Player/BlitzPlayer.php');

use App\MatchMaker\Player\Player;
use App\MatchMaker\Player\AbstractPlayer;

$greg = new App\MatchMaker\Player\BlitzPlayer('greg');
$jade = new App\MatchMaker\Player\BlitzPlayer('jade');

$lobby = new App\MatchMaker\Lobby\Lobby();
$lobby->addPlayers($greg, $jade);

var_dump($lobby->findOponents($lobby->queuingPlayers[0]));

exit(0);
