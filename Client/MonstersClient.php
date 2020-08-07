<?php


namespace SwarfarmClient\Client;


use SwarfarmClient\AbstractClass\AbstractClient;
use SwarfarmClient\Entity\Monster;
use SwarfarmClient\Exception\ClientException;

class MonstersClient extends AbstractClient
{
    const MONSTERS_URL = "monsters/";

    /**
     * GET /api/v2/monsters/
     * @param array|null $queryData
     * @return array
     * @throws ClientException
     */
    public function getMonsters(?array $queryData = null) : array
    {
        $url = self::MONSTERS_URL;
        if(!empty($queryData)) {
            $url .= $this->generateQuerySetFromArray($queryData);
        }
        $results = $this->requestApi($url, 'GET');

        $monsters = [];
        foreach ($results['results'] as $result) {
            $monsters[] = new Monster($result);
        }

        return $monsters;
    }
}