<?php

namespace App\Traits;


trait SortTrait
{
    protected function recur1($nested_array = [])
    {
        $counter = 0;

        $simplified_list = [];

        foreach ($nested_array as $k => $v) {

            $sort_order = $k + 1;
            $simplified_list[] = [
                "id" => $v['id'],
                "parent_id" => 0,
                "sort" => $sort_order
            ];

            if (!empty($v["children"])) {
                $counter += 1;
                $this->recur2($v['children'], $simplified_list, $v['id']);
            }
        }

        return $simplified_list;
    }

    private function recur2($sub_nested_array = [], &$simplified_list = [], $parent_id = NULL)
    {

        static $counter = 0;

        foreach ($sub_nested_array as $k => $v) {

            $sort_order = $k + 1;
            $simplified_list[] = [
                "id" => $v['id'],
                "parent_id" => $parent_id,
                "sort" => $sort_order
            ];

            if (!empty($v["children"])) {
                $counter += 1;
                return $this->recur2($v['children'], $simplified_list, $v['id']);
            }
        }
    }
}
