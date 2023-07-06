<?php

namespace Guave\TeamBundle\Helper;

class RelationHelper
{
    public static function getRelation($relationIds, string $modelName): array
    {
        $result = [];

        if ($relationIds === false) {
            return $result;
        }

        $modelClass = new $modelName();
        $collection = $modelClass::findMultipleByIds($relationIds, ['return' => 'Collection']);
        if ($collection === null) {
            return $result;
        }

        foreach ($collection as $model) {
            $result[] = $model->row();
        }

        return $result;
    }
}
