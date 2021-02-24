<?php


namespace App\AsientoContable\Tools;


trait NestedsetTrait
{
    public function buildNestedset(array $items, $parentId = '0')
    {
        $branch = array();

        foreach ($items as $element) {
            if ($element['parent_id'] == $parentId) {
                $children = self::buildNestedset($items, $element['code']);
                if ($children) {
                    $element['children'] = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;

    }

}
