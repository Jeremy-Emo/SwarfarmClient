<?php


namespace SwarfarmClient;


use SwarfarmClient\Client\MonstersClient;

class SwarfarmApiClient
{
    /**
     * @var string|null
     */
    private $user_pk;

    /**
     * @var mixed
     */
    private $lastClientInstantiate;

    /**
     * SwarfarmApiClient constructor.
     * @param string|null $user_pk
     */
    public function __construct(?string $user_pk = null)
    {
        $this->user_pk = $user_pk;
    }

    /**
     * @return MonstersClient
     */
    public function monsterRoutes() : MonstersClient
    {
        if (!($this->lastClientInstantiate instanceof MonstersClient)) {
            $this->lastClientInstantiate = new MonstersClient();
        }
        return $this->lastClientInstantiate;
    }
}