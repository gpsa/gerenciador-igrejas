<?php

namespace Dizimo\V1\Rpc\Relatorio;

use ZfrCors\Service\CorsService;

class RelatorioControllerFactory
{
    public function __invoke($controllers)
    {
        return new RelatorioController($controllers->get('doctrine.entitymanager.orm_default'),
            $controllers->get('ZfDoctrineQueryBuilderFilterManagerOrm'),
            $controllers->get('ZfDoctrineQueryBuilderOrderByManagerOrm'),
            $controllers->get(CorsService::class)
        );
    }
}
