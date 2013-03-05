<?php

namespace Triangulum\WebsiteBundle\Helper;

use Symfony\Component\HttpFoundation\Response;

class JsonResponse extends Response
{
    public function __construct($data = array(), $status = 200, $headers = array())
    {
        if (is_array($data) && 0 === count($data)) {
            $data = new \ArrayObject();
        }

        parent::__construct(
            json_encode($data),
            $status,
            array_merge(array('Content-Type' => 'application/json'), $headers)
        );
    }
}
