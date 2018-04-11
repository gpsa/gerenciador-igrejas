<?php
/**
 * Created by PhpStorm.
 * User: guilherme
 * Date: 03/02/18
 * Time: 20:04
 */

namespace Application\Filter\ORM;


use ZF\Doctrine\QueryBuilder\Filter\ORM\AbstractFilter;

class BirthDay extends AbstractFilter
{
    public function filter($queryBuilder, $metadata, $option)
    {
        if (isset($option['where'])) {
            if ($option['where'] === 'and') {
                $queryType = 'andWhere';
            } elseif ($option['where'] === 'or') {
                $queryType = 'orWhere';
            }
        }

        if (! isset($queryType)) {
            $queryType = 'andWhere';
        }

        if (! isset($option['alias'])) {
            $option['alias'] = 'row';
        }

        $format = isset($option['format']) ? $option['format'] : null;

        $from = $this->typeCastField($metadata, $option['field'], $option['from'], $format);
        $to = $this->typeCastField($metadata, $option['field'], $option['to'], $format);

        $fromParameter = uniqid('a1');
        $toParameter = uniqid('a2');

        $fomatDate = '%m-%d';

        $queryBuilder->$queryType(
            $queryBuilder
                ->expr()
                ->between(
                    sprintf("DATE_FORMAT(%s.%s, '%s')", $option['alias'], $option['field'], $fomatDate),
                    sprintf("DATE_FORMAT(:%s, '%s')", $fromParameter, $fomatDate),
                    sprintf("DATE_FORMAT(:%s, '%s')", $toParameter, $fomatDate)
                )
        );
        $queryBuilder->setParameter($fromParameter, $from);
        $queryBuilder->setParameter($toParameter, $to);
    }
}
