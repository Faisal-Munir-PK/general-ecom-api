<?php

return [
    'errors' => [
        'invalid_data' => [
            'id' => '001',
            'message' => 'Invalid data'
        ],
        'server_error' => [
            'id' => '002',
            'message' => 'Could not save record'
        ],
        'update_error' => [
            'id' => '003',
            'message' => 'Could not update record either record does not exist or invalid data'
        ],
        'database_error' => [
            'id' => '004',
            'message' => 'Could not connect to data base'
        ],
        'register' => [
            'id' => '005',
            'message' => 'There was some error while performing action'
        ],
        'account_not_found' => [
            'id' => '005',
            'message' => 'Sorry! no account associated with this email.'
        ]
    ],
    'success' => [
        'create' => [
            'id' => '001',
            'message' => 'Record created',
        ],
        'updated' => [
            'id' => '002',
            'message' => 'Record updated',
        ],
        'deleted' => [
            'id' => '003',
            'message' => 'Record deleted',
        ],
        'cancelled' => [
            'id' => '004',
            'message' => 'Task cancelled',
        ],
        'restored' => [
            'id' => '005',
            'message' => 'Task restored',
        ],
        'register' => [
            'id' => '006',
            'message' => 'Registration complete'
        ],
        'action' => [
            'id' => '007',
            'message' => 'Action complete'
        ],
        'email' => [
            'id' => '008',
            'message' => 'Email has been sent to your email account.'
        ],
        'recover' => [
            'id' => '009',
            'message' => 'Your password has been restored'
        ],
    ],
    'permissions' => [
        'role_assigned' => [
            'id' => '001',
            'message' => 'Role assigned successfully',
        ],
        'role_revoked' => [
            'id' => '002',
            'message' => 'Role revoked',
        ],
        'permission_assigned' => [
            'id' => '003',
            'message' => 'Permission assigned successfully',
        ],
        'permission_revoked' => [
            'id' => '004',
            'message' => 'Permission revoked',
        ],
    ]
];
