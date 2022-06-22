
private function seedScores(TennisGameApplication $game, int $firstPlayerScore, int $secondPlayerScore): void
{
$highestScore = max($firstPlayerScore, $secondPlayerScore);
for ($i = 0; $i < $highestScore; $i++) {
if ($i < $firstPlayerScore) {
$game->wonPoint('player1');
}
if ($i < $secondPlayerScore) {
$game->wonPoint('player2');
}
}
}