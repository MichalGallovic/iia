<?php
// object to array -> with help of our friend stack overflow
// http://snipplr.com/view/64104/

function object_to_array($data)
{
    if(is_array($data) || is_object($data))
    {
        $result = array();

        foreach($data as $key => $value) {
            $result[$key] = object_to_array($value);
        }

        return $result;
    }

    return $data;
}