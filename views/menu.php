<?php

namespace PHPMaker2021\eoq;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(1, "mi_bagian", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "bagianlist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}bagian'), false, false, "", "", false);
$sideMenu->addMenuItem(2, "mi_barang", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "baranglist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}barang'), false, false, "", "", false);
$sideMenu->addMenuItem(3, "mi_pegawai", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "pegawailist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}pegawai'), false, false, "", "", false);
$sideMenu->addMenuItem(4, "mi_pemesanan", $MenuLanguage->MenuPhrase("4", "MenuText"), $MenuRelativePath . "pemesananlist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}pemesanan'), false, false, "", "", false);
$sideMenu->addMenuItem(5, "mi_stok", $MenuLanguage->MenuPhrase("5", "MenuText"), $MenuRelativePath . "stoklist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}stok'), false, false, "", "", false);
$sideMenu->addMenuItem(6, "mi_pengambilan", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "pengambilanlist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}pengambilan'), false, false, "", "", false);
$sideMenu->addMenuItem(7, "mi_produksi", $MenuLanguage->MenuPhrase("7", "MenuText"), $MenuRelativePath . "produksilist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}produksi'), false, false, "", "", false);
$sideMenu->addMenuItem(8, "mi_stock", $MenuLanguage->MenuPhrase("8", "MenuText"), $MenuRelativePath . "stocklist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}stock'), false, false, "", "", false);
$sideMenu->addMenuItem(9, "mi_eoq", $MenuLanguage->MenuPhrase("9", "MenuText"), $MenuRelativePath . "eoqlist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}eoq'), false, false, "", "", false);
$sideMenu->addMenuItem(10, "mi_rop", $MenuLanguage->MenuPhrase("10", "MenuText"), $MenuRelativePath . "roplist", -1, "", AllowListMenu('{9F896C51-AC0B-4EBF-8940-42A728F04A90}rop'), false, false, "", "", false);
echo $sideMenu->toScript();
