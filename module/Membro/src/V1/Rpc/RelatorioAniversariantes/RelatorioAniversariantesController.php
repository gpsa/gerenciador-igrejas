<?php

namespace Membro\V1\Rpc\RelatorioAniversariantes;

use Application\Entity\PessoaMembro;
use Doctrine\ORM\EntityManager;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Laminas\Http\Headers;
use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\ApiTools\ApiProblem\ApiProblem;
use Laminas\ApiTools\ApiProblem\ApiProblemResponse;
use Laminas\ApiTools\Doctrine\QueryBuilder\Filter\Service\ORMFilterManager;
use Laminas\ApiTools\Doctrine\QueryBuilder\OrderBy\Service\ORMOrderByManager;
use ZfrCors\Service\CorsService;

class RelatorioAniversariantesController extends AbstractActionController
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var ORMFilterManager
     */
    private $filterManager;
    /**
     * @var ORMOrderByManager
     */
    private $orderByManager;


    /**
     * CORS
     * @var CorsService
     */
    private $cors;

    public function __construct(EntityManager $em, ORMFilterManager $filterManager, ORMOrderByManager $orderByManager, CorsService $cors)
    {
        $this->em = $em;
        $this->filterManager = $filterManager;
        $this->orderByManager = $orderByManager;
        $this->cors = $cors;
        return $this;
    }

    public function relatorioAniversariantesAction()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->select('row')
            ->from(PessoaMembro::class, 'row')
            ->andWhere('row.state = 1');

        $metadata = $this->em->getMetadataFactory()->getMetadataFor(PessoaMembro::class); // $e->getEntity() using doctrine resource event
        $this->filterManager->filter($queryBuilder, $metadata, $_GET['filter']);
        $this->orderByManager->orderBy($queryBuilder, $metadata, $_GET['order-by']);

        $result = $queryBuilder->getQuery()->iterate();

        /* @var $request \Laminas\ApiTools\ContentNegotiation\Request */
        $request = $this->getRequest();

        // Create new Spreadsheet object
        $spreadsheet = new Spreadsheet();

        // Set document properties
        $spreadsheet->getProperties()->setCreator('Maarten Balliauw')
            ->setLastModifiedBy('Maarten Balliauw')
            ->setTitle('Office 2007 XLSX Test Document')
            ->setSubject('Office 2007 XLSX Test Document')
            ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
            ->setKeywords('office 2007 openxml php')
            ->setCategory('Test result file');

        // Add some data
        $sheet = $spreadsheet->setActiveSheetIndex(0);

        // Cabeçalho
        $sheet->setCellValue('A1', 'Membro')
            ->setCellValue('B1', 'Data')
            ->setCellValue('C1', 'Contato');

        $i = 1;
        $limpaFones = function ($row) {
            return !empty(preg_replace("![^0-9]!", "", $row));
        };

        foreach ($result as $rowArray) {
            ++$i;
            /* @var $row \Application\Entity\PessoaMembro */
            $row = $rowArray[0];

            $sheet->setCellValue("A{$i}", $row->getNome())
                ->setCellValue("B{$i}", $row->getDataNascimento()->format("d/m/Y"))
                ->setCellValue("C{$i}", implode(" | ", array_filter([$row->getTelefoneCelular(), $row->getTelefoneComercial()], $limpaFones)));
        }

        # Formatacao: Primeira Linha
        $sheet->getStyle('A1:C1')
            ->applyFromArray([
                'font' => [
                    'bold' => true,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => 'f2f2f2f2',
                    ],
                ]
            ]);

        # Formatacao: Largura
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);

        # Formatacao: Bordas
        /** Borders for all data */
        $sheet->getStyle('A1:C' . ($i + 1))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '00000000'],
                ],
            ],
        ]);
        //
        //        $filtros = $request->getQuery('filter');
        //        $fromTo = (isset($filtros[0]['from']) ? sprintf)

        /* @var $response \Laminas\Http\PhpEnvironment\Response */
        $response = $this->getResponse();
        $response->setHeaders((new Headers())->addHeaders([
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            // Redirect output to a client’s web browser (Xlsx)
            'Content-Disposition' => 'attachment;filename="relatorio-aniversariantes.xlsx"'
        ]));

        try {
            // ZFR-CORs
            !$this->cors->isCorsRequest($request) ?: $this->cors->populateCorsResponse($request, $response);
        } catch (\Exception $e) {
            $response->setHeaders((new Headers())->addHeaders(['Content-Type' => 'application/json']));
            return new ApiProblemResponse(new ApiProblem(422, $e->getMessage()));
        }

        $response->sendHeaders();


        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        //        exit;

        return $response->setContent(null);
    }
}
