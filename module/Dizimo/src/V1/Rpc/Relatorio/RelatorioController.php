<?php

namespace Dizimo\V1\Rpc\Relatorio;

use Application\Entity\FinancasDizimo;
use Doctrine\ORM\EntityManager;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Zend\Http\Headers;
use Zend\Mvc\Controller\AbstractActionController;
use ZF\ApiProblem\ApiProblem;
use ZF\ApiProblem\ApiProblemResponse;
use ZF\Doctrine\QueryBuilder\Filter\Service\ORMFilterManager;
use ZF\Doctrine\QueryBuilder\OrderBy\Service\ORMOrderByManager;
use ZfrCors\Service\CorsService;

class RelatorioController extends AbstractActionController
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

    public function relatorioAction()
    {
        $queryBuilder = $this->em->createQueryBuilder();
        $queryBuilder->select('row')
            ->from(FinancasDizimo::class, 'row');

        $metadata = $this->em->getMetadataFactory()->getMetadataFor(FinancasDizimo::class); // $e->getEntity() using doctrine resource event
        $this->filterManager->filter($queryBuilder, $metadata, $_GET['filter']);
        $this->orderByManager->orderBy($queryBuilder, $metadata, $_GET['order-by']);

        $result = $queryBuilder->getQuery()->iterate();

        /* @var $request \ZF\ContentNegotiation\Request */
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
            ->setCellValue('C1', 'Valor');

        $i = 1;

        foreach ($result as $rowArray) {
            ++$i;
            /* @var $row \Application\Entity\FinancasDizimo */
            $row = $rowArray[0];

            $sheet->setCellValue("A{$i}", $row->getMembro()->getNome())
                ->setCellValue("B{$i}", $row->getData())
                ->setCellValue("C{$i}", $row->getValor());
        }

        $sheet->setCellValue("B" . ($i + 1), "Total");
        $sheet->setCellValue("C" . ($i + 1), "=SUM(C2:C{$i})");

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
        # Formatacao: Moeda
        $sheet->getStyle('C2:C' . ($i + 1))
            ->getNumberFormat()
            ->setFormatCode('[$R$-416] #.##0,00;[RED]-[$R$-416] #.##0,00');

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

        /* @var $response \Zend\Http\PhpEnvironment\Response */
        $response = $this->getResponse();
        $response->setHeaders((new Headers())->addHeaders([
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            // Redirect output to a client’s web browser (Xlsx)
            'Content-Disposition' => 'attachment;filename="relatorio-dizimos.xlsx"',
            'Cache-Control' => 'max-age=0',
            // If you're serving to IE 9, then the following may be needed
            'Cache-Control' => 'max-age=1',
            // If you're serving to IE over SSL, then the following may be needed
            'Expires' => 'Mon, 26 Jul 1997 05:00:00 GMT', // Date in the past
            'Last-Modified' => '' . gmdate('D, d M Y H:i:s') . ' GMT', // always modified
            'Cache-Control' => 'cache, must-revalidate', // HTTP/1.1
            'Pragma' => 'public', // HTTP/1.0
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
