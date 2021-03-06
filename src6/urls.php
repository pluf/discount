<?php
return array(
    // ************************************************************* Discount
    array( // Find
        'regex' => '#^/find$#',
        'model' => 'Pluf_Views',
        'method' => 'findObject',
        'http-method' => 'GET',
        'params' => array(
            'model' => 'Discount_Discount',
            'listFilters' => array(
                'id',
                'name',
                'code',
                'type',
                'off_value',
                'user'
            ),
            'searchFields' => array(
                'code',
                'type',
                'name',
                'description'
            ),
            'sortFields' => array(
                'id',
                'code',
                'type',
                'count',
                'remain_count',
                'off_value',
                'valid_day',
                'user',
                'name',
                'creation_dtime'
            )
        ),
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Create
        'regex' => '#^/new$#',
        'model' => 'Pluf_Views',
        'method' => 'createObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Discount_Discount'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Delete
        'regex' => '#^/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'deleteObject',
        'http-method' => 'DELETE',
        'params' => array(
            'model' => 'Discount_Discount',
            'permanently' => true
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Update
        'regex' => '#^/(?P<modelId>\d+)$#',
        'model' => 'Pluf_Views',
        'method' => 'updateObject',
        'http-method' => 'POST',
        'params' => array(
            'model' => 'Discount_Discount'
        ),
        'precond' => array(
            'User_Precondition::loginRequired',
            'User_Precondition::ownerRequired'
        )
    ),
    array( // Get info
        'regex' => '#^/(?P<modelId>\d+)$#',
        'model' => 'Discount_Views_Discount',
        'method' => 'get',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    array( // Get info (by code)
        'regex' => '#^/(?P<code>[^/]+)$#',
        'model' => 'Discount_Views_Discount',
        'method' => 'getByCode',
        'http-method' => 'GET',
        'precond' => array(
            'User_Precondition::loginRequired'
        )
    ),
    // ************************************************************* Discount Engines
    array(
        'regex' => '#^/type/find$#',
        'model' => 'Discount_Views_Engine',
        'method' => 'find',
        'http-method' => array(
            'GET'
        )
    ),
    array(
        'regex' => '#^/type/(?P<type>.+)$#',
        'model' => 'Discount_Views_Engine',
        'method' => 'get',
        'http-method' => array(
            'GET'
        )
    ),
);
