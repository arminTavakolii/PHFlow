<?php

namespace System\Database\Traits;

trait HasAttributes
{
    private function registerAttribute($object, string $attribute, $value)
    {
        $this->inCastsAttributes($attribute) == true ? $object->$attribute = $this->castDecodeValue($attribute, $value) : $object->$attribute = $value;
    }


    protected function arrayToAttributes(array $array, $object = null)
    {
        if (!$object) {
            $className = get_called_class();
            $object = new $className;
        }
        foreach ($array as $attribute => $value) {
            if ($this->inHiddenAttributes($attribute))
                continue;
            $this->registerAttribute($object, $attribute, $value);
        }
        return $object;
    }

    protected function arrayToObjects(array $array)
    {
        $collection = [];

        foreach ($array as $value) {
            $object = $this->arrayToAttributes($value);
            array_push($collection, $object);
        }

        $this->collection = $collection;
    }

    private function inHiddenAttributes($attribute)
    {
        return in_array($attribute, $this->hidden);
    }
}
