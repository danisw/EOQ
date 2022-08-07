<?php

namespace PHPMaker2021\eoq;

use Slim\App;
use Slim\Routing\RouteCollectorProxy;

// Handle Routes
return function (App $app) {
    // bagian
    $app->any('/bagianlist[/{id_bagian}]', BagianController::class . ':list')->add(PermissionMiddleware::class)->setName('bagianlist-bagian-list'); // list
    $app->any('/bagianadd[/{id_bagian}]', BagianController::class . ':add')->add(PermissionMiddleware::class)->setName('bagianadd-bagian-add'); // add
    $app->any('/bagianview[/{id_bagian}]', BagianController::class . ':view')->add(PermissionMiddleware::class)->setName('bagianview-bagian-view'); // view
    $app->any('/bagianedit[/{id_bagian}]', BagianController::class . ':edit')->add(PermissionMiddleware::class)->setName('bagianedit-bagian-edit'); // edit
    $app->any('/bagiandelete[/{id_bagian}]', BagianController::class . ':delete')->add(PermissionMiddleware::class)->setName('bagiandelete-bagian-delete'); // delete
    $app->group(
        '/bagian',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_bagian}]', BagianController::class . ':list')->add(PermissionMiddleware::class)->setName('bagian/list-bagian-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_bagian}]', BagianController::class . ':add')->add(PermissionMiddleware::class)->setName('bagian/add-bagian-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_bagian}]', BagianController::class . ':view')->add(PermissionMiddleware::class)->setName('bagian/view-bagian-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_bagian}]', BagianController::class . ':edit')->add(PermissionMiddleware::class)->setName('bagian/edit-bagian-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_bagian}]', BagianController::class . ':delete')->add(PermissionMiddleware::class)->setName('bagian/delete-bagian-delete-2'); // delete
        }
    );

    // barang
    $app->any('/baranglist[/{id_barang}]', BarangController::class . ':list')->add(PermissionMiddleware::class)->setName('baranglist-barang-list'); // list
    $app->any('/barangadd[/{id_barang}]', BarangController::class . ':add')->add(PermissionMiddleware::class)->setName('barangadd-barang-add'); // add
    $app->any('/barangview[/{id_barang}]', BarangController::class . ':view')->add(PermissionMiddleware::class)->setName('barangview-barang-view'); // view
    $app->any('/barangedit[/{id_barang}]', BarangController::class . ':edit')->add(PermissionMiddleware::class)->setName('barangedit-barang-edit'); // edit
    $app->any('/barangdelete[/{id_barang}]', BarangController::class . ':delete')->add(PermissionMiddleware::class)->setName('barangdelete-barang-delete'); // delete
    $app->group(
        '/barang',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_barang}]', BarangController::class . ':list')->add(PermissionMiddleware::class)->setName('barang/list-barang-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_barang}]', BarangController::class . ':add')->add(PermissionMiddleware::class)->setName('barang/add-barang-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_barang}]', BarangController::class . ':view')->add(PermissionMiddleware::class)->setName('barang/view-barang-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_barang}]', BarangController::class . ':edit')->add(PermissionMiddleware::class)->setName('barang/edit-barang-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_barang}]', BarangController::class . ':delete')->add(PermissionMiddleware::class)->setName('barang/delete-barang-delete-2'); // delete
        }
    );

    // pegawai
    $app->any('/pegawailist[/{id_pegawai}]', PegawaiController::class . ':list')->add(PermissionMiddleware::class)->setName('pegawailist-pegawai-list'); // list
    $app->any('/pegawaiadd[/{id_pegawai}]', PegawaiController::class . ':add')->add(PermissionMiddleware::class)->setName('pegawaiadd-pegawai-add'); // add
    $app->any('/pegawaiview[/{id_pegawai}]', PegawaiController::class . ':view')->add(PermissionMiddleware::class)->setName('pegawaiview-pegawai-view'); // view
    $app->any('/pegawaiedit[/{id_pegawai}]', PegawaiController::class . ':edit')->add(PermissionMiddleware::class)->setName('pegawaiedit-pegawai-edit'); // edit
    $app->any('/pegawaidelete[/{id_pegawai}]', PegawaiController::class . ':delete')->add(PermissionMiddleware::class)->setName('pegawaidelete-pegawai-delete'); // delete
    $app->group(
        '/pegawai',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_pegawai}]', PegawaiController::class . ':list')->add(PermissionMiddleware::class)->setName('pegawai/list-pegawai-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_pegawai}]', PegawaiController::class . ':add')->add(PermissionMiddleware::class)->setName('pegawai/add-pegawai-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_pegawai}]', PegawaiController::class . ':view')->add(PermissionMiddleware::class)->setName('pegawai/view-pegawai-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_pegawai}]', PegawaiController::class . ':edit')->add(PermissionMiddleware::class)->setName('pegawai/edit-pegawai-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_pegawai}]', PegawaiController::class . ':delete')->add(PermissionMiddleware::class)->setName('pegawai/delete-pegawai-delete-2'); // delete
        }
    );

    // pemesanan
    $app->any('/pemesananlist[/{id_pesanan}]', PemesananController::class . ':list')->add(PermissionMiddleware::class)->setName('pemesananlist-pemesanan-list'); // list
    $app->any('/pemesananadd[/{id_pesanan}]', PemesananController::class . ':add')->add(PermissionMiddleware::class)->setName('pemesananadd-pemesanan-add'); // add
    $app->any('/pemesananview[/{id_pesanan}]', PemesananController::class . ':view')->add(PermissionMiddleware::class)->setName('pemesananview-pemesanan-view'); // view
    $app->any('/pemesananedit[/{id_pesanan}]', PemesananController::class . ':edit')->add(PermissionMiddleware::class)->setName('pemesananedit-pemesanan-edit'); // edit
    $app->any('/pemesanandelete[/{id_pesanan}]', PemesananController::class . ':delete')->add(PermissionMiddleware::class)->setName('pemesanandelete-pemesanan-delete'); // delete
    $app->group(
        '/pemesanan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_pesanan}]', PemesananController::class . ':list')->add(PermissionMiddleware::class)->setName('pemesanan/list-pemesanan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_pesanan}]', PemesananController::class . ':add')->add(PermissionMiddleware::class)->setName('pemesanan/add-pemesanan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_pesanan}]', PemesananController::class . ':view')->add(PermissionMiddleware::class)->setName('pemesanan/view-pemesanan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_pesanan}]', PemesananController::class . ':edit')->add(PermissionMiddleware::class)->setName('pemesanan/edit-pemesanan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_pesanan}]', PemesananController::class . ':delete')->add(PermissionMiddleware::class)->setName('pemesanan/delete-pemesanan-delete-2'); // delete
        }
    );

    // stok
    $app->any('/stoklist[/{id_barang}]', StokController::class . ':list')->add(PermissionMiddleware::class)->setName('stoklist-stok-list'); // list
    $app->any('/stokadd[/{id_barang}]', StokController::class . ':add')->add(PermissionMiddleware::class)->setName('stokadd-stok-add'); // add
    $app->any('/stokview[/{id_barang}]', StokController::class . ':view')->add(PermissionMiddleware::class)->setName('stokview-stok-view'); // view
    $app->any('/stokedit[/{id_barang}]', StokController::class . ':edit')->add(PermissionMiddleware::class)->setName('stokedit-stok-edit'); // edit
    $app->any('/stokdelete[/{id_barang}]', StokController::class . ':delete')->add(PermissionMiddleware::class)->setName('stokdelete-stok-delete'); // delete
    $app->group(
        '/stok',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_barang}]', StokController::class . ':list')->add(PermissionMiddleware::class)->setName('stok/list-stok-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_barang}]', StokController::class . ':add')->add(PermissionMiddleware::class)->setName('stok/add-stok-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_barang}]', StokController::class . ':view')->add(PermissionMiddleware::class)->setName('stok/view-stok-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_barang}]', StokController::class . ':edit')->add(PermissionMiddleware::class)->setName('stok/edit-stok-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_barang}]', StokController::class . ':delete')->add(PermissionMiddleware::class)->setName('stok/delete-stok-delete-2'); // delete
        }
    );

    // pengambilan
    $app->any('/pengambilanlist[/{id_pengambilan}]', PengambilanController::class . ':list')->add(PermissionMiddleware::class)->setName('pengambilanlist-pengambilan-list'); // list
    $app->any('/pengambilanadd[/{id_pengambilan}]', PengambilanController::class . ':add')->add(PermissionMiddleware::class)->setName('pengambilanadd-pengambilan-add'); // add
    $app->any('/pengambilanview[/{id_pengambilan}]', PengambilanController::class . ':view')->add(PermissionMiddleware::class)->setName('pengambilanview-pengambilan-view'); // view
    $app->any('/pengambilanedit[/{id_pengambilan}]', PengambilanController::class . ':edit')->add(PermissionMiddleware::class)->setName('pengambilanedit-pengambilan-edit'); // edit
    $app->any('/pengambilandelete[/{id_pengambilan}]', PengambilanController::class . ':delete')->add(PermissionMiddleware::class)->setName('pengambilandelete-pengambilan-delete'); // delete
    $app->group(
        '/pengambilan',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_pengambilan}]', PengambilanController::class . ':list')->add(PermissionMiddleware::class)->setName('pengambilan/list-pengambilan-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_pengambilan}]', PengambilanController::class . ':add')->add(PermissionMiddleware::class)->setName('pengambilan/add-pengambilan-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_pengambilan}]', PengambilanController::class . ':view')->add(PermissionMiddleware::class)->setName('pengambilan/view-pengambilan-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_pengambilan}]', PengambilanController::class . ':edit')->add(PermissionMiddleware::class)->setName('pengambilan/edit-pengambilan-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_pengambilan}]', PengambilanController::class . ':delete')->add(PermissionMiddleware::class)->setName('pengambilan/delete-pengambilan-delete-2'); // delete
        }
    );

    // produksi
    $app->any('/produksilist[/{id_produksi}]', ProduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('produksilist-produksi-list'); // list
    $app->any('/produksiadd[/{id_produksi}]', ProduksiController::class . ':add')->add(PermissionMiddleware::class)->setName('produksiadd-produksi-add'); // add
    $app->any('/produksiview[/{id_produksi}]', ProduksiController::class . ':view')->add(PermissionMiddleware::class)->setName('produksiview-produksi-view'); // view
    $app->any('/produksiedit[/{id_produksi}]', ProduksiController::class . ':edit')->add(PermissionMiddleware::class)->setName('produksiedit-produksi-edit'); // edit
    $app->any('/produksidelete[/{id_produksi}]', ProduksiController::class . ':delete')->add(PermissionMiddleware::class)->setName('produksidelete-produksi-delete'); // delete
    $app->group(
        '/produksi',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '[/{id_produksi}]', ProduksiController::class . ':list')->add(PermissionMiddleware::class)->setName('produksi/list-produksi-list-2'); // list
            $group->any('/' . Config("ADD_ACTION") . '[/{id_produksi}]', ProduksiController::class . ':add')->add(PermissionMiddleware::class)->setName('produksi/add-produksi-add-2'); // add
            $group->any('/' . Config("VIEW_ACTION") . '[/{id_produksi}]', ProduksiController::class . ':view')->add(PermissionMiddleware::class)->setName('produksi/view-produksi-view-2'); // view
            $group->any('/' . Config("EDIT_ACTION") . '[/{id_produksi}]', ProduksiController::class . ':edit')->add(PermissionMiddleware::class)->setName('produksi/edit-produksi-edit-2'); // edit
            $group->any('/' . Config("DELETE_ACTION") . '[/{id_produksi}]', ProduksiController::class . ':delete')->add(PermissionMiddleware::class)->setName('produksi/delete-produksi-delete-2'); // delete
        }
    );

    // stock
    $app->any('/stocklist', StockController::class . ':list')->add(PermissionMiddleware::class)->setName('stocklist-stock-list'); // list
    $app->group(
        '/stock',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', StockController::class . ':list')->add(PermissionMiddleware::class)->setName('stock/list-stock-list-2'); // list
        }
    );

    // eoq
    $app->any('/eoqlist', EoqController::class . ':list')->add(PermissionMiddleware::class)->setName('eoqlist-eoq-list'); // list
    $app->group(
        '/eoq',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', EoqController::class . ':list')->add(PermissionMiddleware::class)->setName('eoq/list-eoq-list-2'); // list
        }
    );

    // rop
    $app->any('/roplist', RopController::class . ':list')->add(PermissionMiddleware::class)->setName('roplist-rop-list'); // list
    $app->group(
        '/rop',
        function (RouteCollectorProxy $group) {
            $group->any('/' . Config("LIST_ACTION") . '', RopController::class . ':list')->add(PermissionMiddleware::class)->setName('rop/list-rop-list-2'); // list
        }
    );

    // error
    $app->any('/error', OthersController::class . ':error')->add(PermissionMiddleware::class)->setName('error');

    // personal_data
    $app->any('/personaldata', OthersController::class . ':personaldata')->add(PermissionMiddleware::class)->setName('personaldata');

    // login
    $app->any('/login', OthersController::class . ':login')->add(PermissionMiddleware::class)->setName('login');

    // logout
    $app->any('/logout', OthersController::class . ':logout')->add(PermissionMiddleware::class)->setName('logout');

    // Swagger
    $app->get('/' . Config("SWAGGER_ACTION"), OthersController::class . ':swagger')->setName(Config("SWAGGER_ACTION")); // Swagger

    // Index
    $app->any('/[index]', OthersController::class . ':index')->add(PermissionMiddleware::class)->setName('index');

    // Route Action event
    if (function_exists(PROJECT_NAMESPACE . "Route_Action")) {
        Route_Action($app);
    }

    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: Make sure this route is defined last.
     */
    $app->map(
        ['GET', 'POST', 'PUT', 'DELETE', 'PATCH'],
        '/{routes:.+}',
        function ($request, $response, $params) {
            $error = [
                "statusCode" => "404",
                "error" => [
                    "class" => "text-warning",
                    "type" => Container("language")->phrase("Error"),
                    "description" => str_replace("%p", $params["routes"], Container("language")->phrase("PageNotFound")),
                ],
            ];
            Container("flash")->addMessage("error", $error);
            return $response->withStatus(302)->withHeader("Location", GetUrl("error")); // Redirect to error page
        }
    );
};
