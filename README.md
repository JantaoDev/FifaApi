# About

It`s a simple api.fifa.com implementation written in PHP.

It allows you get matches schedule and information, provided by API.

# Setup

Add followings to `composer.json` to install package via composer:

```json
{
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/JantaoDev/FifaApi"
        }
    ],
    "require": {
        "jantaodev/fifa-api": "dev-master"
    }
}
```

# Usage

Basic usage:

```php
$api = new \JantaoDev\FifaApi\FifaApi(17, 254645, 'en-GB');

$competition = $api->getCompetition();
echo "This is {$competition->getSeasonName()} season of {$competition->getName()}\n";

echo "Shedule:\n";
$schedule = $api->getSchedule();
foreach ($schedule as $matchSchedule) {
    /* @var \JantaoDev\FifaApi\Model\MatchSchedule $matchSchedule */
    printf(
        "| %-15s | %-15s | %17s UTC | %-30s | %3s |\n",
        ($matchSchedule->getHomeTeam() ? $matchSchedule->getHomeTeam()->getName() : ''),
        ($matchSchedule->getAwayTeam() ? $matchSchedule->getAwayTeam()->getName() : ''),
        $matchSchedule->getDate()->format('d.m.Y H:i'),
        $matchSchedule->getStadium(),
        ($matchSchedule->getStatus() == \JantaoDev\FifaApi\Model\Match::STATUS_PLAYED ? $matchSchedule->getHomeTeamScore().':'.$matchSchedule->getAwayTeamScore() : "")
    );
}
```

Live match events:

```php
$match = $api->getMatch($matchSchedule);
echo "Events:\n";
foreach ($match->getEvents() as $event) {
    /* @var \JantaoDev\FifaApi\Model\Event\Event $event */
    if ($event instanceof \JantaoDev\FifaApi\Model\Event\Goal) {
        $goalTypes = [
            \JantaoDev\FifaApi\Model\Event\Goal::GOAL_PENALTY => 'Penalty',
            \JantaoDev\FifaApi\Model\Event\Goal::GOAL_OWN => 'Owngoal',
            \JantaoDev\FifaApi\Model\Event\Goal::GOAL_REGULAR => 'Goal'
        ];
        printf("%s by %s at %s\n", $goalTypes[$event->getGoal()] ?? '', $event->getPlayer()->getName(), $event->getMatchTime());
    } elseif ($event instanceof \JantaoDev\FifaApi\Model\Event\Booking) {
        $cardTypes = [
            \JantaoDev\FifaApi\Model\Event\Booking::CARD_YELLOW => 'Yellow card',
            \JantaoDev\FifaApi\Model\Event\Booking::CARD_RED => 'Red card',
            \JantaoDev\FifaApi\Model\Event\Booking::CARD_DOUBLE_YELLOW => 'Double yellow card',
            \JantaoDev\FifaApi\Model\Event\Booking::CARD_ALL => 'All cards'
        ];
        printf("%s to %s at %s\n", $cardTypes[$event->getCard()] ?? '', $event->getPlayer()->getName(), $event->getMatchTime());
    } elseif ($event instanceof \JantaoDev\FifaApi\Model\Event\Substitution) {
        printf("Substitution: %s => %s at %s\n", $event->getPlayerOff()->getName(), $event->getPlayer()->getName(), $event->getMatchTime());
    }
}
```

Live match updates:

```php
$newEvents = $api->updateMatch($match);
echo "New events:\n";
foreach ($newEvents as $event) {
    // ...
}
```

# World Cup 2018

For get information about World Cup 2018 use following ids:

`$competitionId = 17`

`$seasonId = 254645`

# Notes

The project under development.