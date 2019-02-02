<?php
namespace Membro\V1\Rpc\RelatorioAniversariantes;

use ZfrCors\Service\CorsService;

class RelatorioAniversariantesControllerFactory
{
    public function __invoke($controllers)
    {
        return new RelatorioAniversariantesController($controllers->get('doctrine.entitymanager.orm_default'),
            $controllers->get('ZfDoctrineQueryBuilderFilterManagerOrm'),
            $controllers->get('ZfDoctrineQueryBuilderOrderByManagerOrm'),
            $controllers->get(CorsService::class)
        );
    }
}
