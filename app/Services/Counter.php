<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class Counter
{


    private $timeout;

    public function __construct($timeout)
    {
          $this->timeout = $timeout;
    }

public function increment(string $key, array $tags = null)
{

    $sessionId = session()->getId();
    $counterKey = "{$key}-counter";
    $usersKey = "{$key}-users";


        $users = Cache::get($usersKey, []);
        $usersUpdate = [];
        $diffrence = 0;
        $now = now();

        foreach ($users as $session => $lastVisit) {
            if ($now->diffInMinutes($lastVisit) >= $this->timeout) {
                $diffrence--;
            } else {
                $usersUpdate[$session] = $lastVisit;
            }
        }

        if(
            !array_key_exists($sessionId, $users)
            || $now->diffInMinutes($users[$sessionId]) >= $this->timeout
        ) {
            $diffrence++;
        }

        $usersUpdate[$sessionId] = $now;
        Cache::forever($usersKey, $usersUpdate);

        if (!Cache::has($counterKey)) {
            Cache::forever($counterKey, 1);
        } else {
            Cache::increment($counterKey, $diffrence);
        }

        $counter = Cache::get($counterKey);

}


}
