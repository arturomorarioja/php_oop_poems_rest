<?php

class Utils 
{
    public static function leave(int $statusCode = 400): void
    {
        http_response_code($statusCode);
        header('Location: ..');
        exit;
    }

    /**
     * Adds HATEOAS links to the data it receives as a parameter
     * 
     * @param  array  Entity information to add the HATEOAS links to
     * @return string The information to be served by the API including its corresponding HATEOAS links
     */    
    public static function addHATEOAS(array $information = []): string
    {
        if ($information) {
            $result['data'] = $information;
        }

        $result['_links'] = [
            [
                'rel'  => 'authors',
                'href' => 'http://localhost/api/authors',
                'type' => 'GET'
            ],
            [
                'rel'  => 'authors',
                'href' => 'http://localhost/api/authors/<author_name>',
                'type' => 'GET'
            ],
            [
                'rel'  => 'authors',
                'href' => 'http://localhost/api/authors/<author_name>/poems',
                'type' => 'GET'
            ],
            [
                'rel'  => 'authors',
                'href' => 'http://localhost/api/authors/<author_name>/poems/<poem_title>',
                'type' => 'GET'
            ],
        ];    
        return json_encode($result);
    }
}