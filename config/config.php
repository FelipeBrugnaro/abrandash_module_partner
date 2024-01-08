<?php

return [
    'name' => 'Partner',

    'routes' => [
        'index'   => 'admin.site_partner.index',
        'edit'    => 'admin.site_partner.edit',
        'create'  => 'admin.site_partner.create',

        'store'  => 'admin.site_partner.store',
        'update' => 'admin.site_partner.update',
        'delete' => 'admin.site_partner.destroy',
    ]
];