<?php

namespace Modules\Partner\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\{Menu, Permission};

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $partner = Menu::create([
            'title'  => 'partner::lang',
            'pai'    => 4,
            'code'   => 'site_partner',
            'route'  => 'admin.site_partner.index',
            'icon'   => 'handshake',
            'module' => 'Partner',
            'order'  => 5,
            'status' => true
        ]);

        $permissions = Permission::insert([
            ['title' => 'CREATE_PARTNER', 'module' => 'Partner'],
            ['title' => 'EDIT_PARTNER', 'module' => 'Partner'],
            ['title' => 'DELETE_PARTNER', 'module' => 'Partner'],
        ]);
    }
}
