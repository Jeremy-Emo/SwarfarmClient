<?php


namespace SwarfarmClient\Client;


use SwarfarmClient\AbstractClass\AbstractClient;
use SwarfarmClient\Entity\Building;
use SwarfarmClient\Exception\ClientException;

class BuildingsClient extends AbstractClient
{
    const BUILDINGS_URL = "buildings/";

    /**
     * GET /api/v2/buildings/
     * @param array|null $queryData
     * @return array
     * @throws ClientException
     */
    public function getBuildings(?array $queryData = null) : array
    {
        $url = self::BUILDINGS_URL;
        if(!empty($queryData)) {
            $url .= $this->generateQuerySetFromArray($queryData);
        }
        $results = $this->requestApi($url, 'GET');

        $monsters = [];
        foreach ($results['results'] as $result) {
            $monsters[] = new Building($result);
        }

        return $monsters;
    }

    /**
     * GET /api/v2/buildings/{id}
     * @param int $id
     * @param array|null $queryData
     * @return Building|null
     * @throws ClientException
     */
    public function getBuilding(int $id, ?array $queryData = null) : ?Building
    {
        $url = self::BUILDINGS_URL . $id . '/';
        if(!empty($queryData)) {
            $url .= $this->generateQuerySetFromArray($queryData);
        }
        $result = $this->requestApi($url, 'GET');

        return (!empty($result) ? new Building($result) : null);
    }
}