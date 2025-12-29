<?php

namespace App\Traits;

trait Fields
{
    public function convertJSONToFields($fields)
    {
        $fieldsToRender = [];
        if ($fields) {
            foreach ($fields as $key => $field) {
                array_push($fieldsToRender, [
                    'ftype' => isset($field['ftype']) ? $field['ftype'] : 'input',
                    'type' => isset($field['type']) ? $field['type'] : 'text',
                    'id' => 'custom['.$field['key'].']',
                    'name' => isset($field['title']) && $field['title'] != '' ? $field['title'] : $field['key'],
                    'placeholder' => isset($field['placeholder']) ? $field['placeholder'] : '',
                    'separator' => isset($field['separator']) ? $field['separator'] : null,
                    'value' => isset($field['value']) ? $field['value'] : '',
                    'required' => false,
                    'data' => isset($field['data']) ? $field['data'] : [],
                ]);
            }
        }

        return $fieldsToRender;
    }

    public function encodeItem($data)
    {
        if (is_array($data)) {
            $encoded = [];
            foreach ($data as $key => $value) {
                $encoded[$key] = strip_tags($value);
            }

            return $encoded;
        }

        return strip_tags($data);
    }
}
