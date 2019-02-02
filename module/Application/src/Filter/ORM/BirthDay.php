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

        if (!isset($queryType)) {
            $queryType = 'andWhere';
        }

        if (!isset($option['alias'])) {
            $option['alias'] = 'row';
        }

        $queryBuilder->$queryType(
            $queryBuilder
                ->expr()
                ->in(
                    sprintf("DATE_FORMAT(%s.%s, '%s')", $option['alias'], $option['field'], '%b'),
                    $option['months']
                )
        );
    }
}
