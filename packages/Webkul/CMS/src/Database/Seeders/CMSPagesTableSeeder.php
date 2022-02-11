<?php

namespace Webkul\CMS\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CMSPagesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cms_pages')->delete();
        DB::table('cms_page_translations')->delete();

        DB::table('cms_pages')->insert([
            [
                'id'         => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 2,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 3,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ], [
                'id'         => 4,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);

        DB::table('cms_page_translations')->insert([
            [
                'locale'           => 'es',
                'cms_page_id'      => 1,
                'url_key'          => 'terminos-y-condiciones',
                'html_content'     => '<div class="static-container"><div class="mb-5">Terms & conditions page content</div></div>',
                'page_title'       => 'Terminos y Condiciones',
                'meta_title'       => 'Terminos y Condiciones',
                'meta_description' => '',
                'meta_keywords'    => '',
            ], [
                'locale'           => 'es',
                'cms_page_id'      => 2,
                'url_key'          => 'politicas-de-pagos',
                'html_content'     => '<div class="static-container"><div class="mb-5">Payment Policy page content</div></div>',
                'page_title'       => 'Politicas de Pagos',
                'meta_title'       => 'Politicas de Pagos',
                'meta_description' => '',
                'meta_keywords'    => '',
            ], [
                'locale'           => 'es',
                'cms_page_id'      => 3,
                'url_key'          => 'politicas-de-envios',
                'html_content'     => '<div class="static-container"><div class="mb-5">Shipping Policy  page content</div></div>',
                'page_title'       => 'Politicas de Envios',
                'meta_title'       => 'Politicas de Envios',
                'meta_description' => '',
                'meta_keywords'    => '',
            ], [
                'locale'           => 'es',
                'cms_page_id'      => 4,
                'url_key'          => 'politicas-de-privacidad',
                'html_content'     => '<div class="static-container"><div class="mb-5">Privacy Policy  page content</div></div>',
                'page_title'       => 'Politicas de Privacidad',
                'meta_title'       => 'Politicas de Privacidad',
                'meta_description' => '',
                'meta_keywords'    => '',
            ]
        ]);
    }
}
