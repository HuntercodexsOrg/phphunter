<?php

namespace PhpHunter\Framework\Controllers;

class MenuHandler
{
    private $menu_array = array();
    private $list_dir = array();
    private $list_folder = array();
    private $directory = "";
    private $file_type = "";
    private $lang = "";

    public function __construct($dir, $filetype, $lang)
    {
        $this->directory = $dir;
        $this->file_type = $filetype;
        $this->lang = $lang;

        if($filetype !== 'dir') {
            $this->getFiles();
        } else {
            $this->getFolders();
        }
    }

    private function getMenuItems($type)
    {
        /*Menu Other*/
        $regexp = "/data\-menu\=\"\#[0-9a-zA-Z-_]+\"/i";

        if($type === 'main') {

            /*Menu Main*/
            $regexp = "/data\-main\=\"\#[0-9a-zA-Z-_]+\"/i";

        }

        sort($this->list_dir);

        foreach ($this->list_dir as $index => $file) {

            if(preg_match('/index|HowUse/i', basename($file))) {
                continue;
            }

            $fn = trim(preg_replace('/[0-9]+|\-|\.php/i', " ", basename($file)));
            $i = 0;
            $f = fopen($file, "r");

            while (!feof($f)) {
                $l = fgets($f);

                if (preg_match($regexp, $l, $item_menu)) {

                    $item_menu = str_replace('"', '', explode("#", $item_menu[0])[1]);

                    $this->menu_array[$fn][$i] = $item_menu;

                    $i++;

                }
            }

            fclose($f);

        }

    }

    private function getFiles()
    {
        $this->list_dir = glob($this->directory."/".$this->lang."/*.".$this->file_type, GLOB_BRACE);
    }

    private function getFolders()
    {
        $d = new DirectoryIterator($this->directory);

        foreach ($d as $r) {
            if(!$r->isDot()) { //.|..
                if($r->isDir()) {
                    array_push($this->list_folder, $r->getFilename());
                }
            }
        }
    }

    public function createMainMenu($placer)
    {
        $place = "site+sample+".$this->lang;
        if(preg_match('/sample|public/', $placer) && $this->lang === 'pt-br') {
            $place = "/";
        }

        echo "<h6>Main</h6>";

        $this->getMenuItems("main");

        echo '<ul>
                <li>
                    <a href="'.$place.'">Home</a>
                </li>';

        //Only show the menu items (Main) when index page
        if(preg_match('/sample|public/', $placer)) {

            foreach ($this->menu_array as $menu => $sub_items) {

                sort($sub_items);

                if (count($sub_items) > 0) {

                    for ($k = 0; $k < count($sub_items); $k++) {

                        echo '<li><a data-scroll-anchor="#' . $sub_items[$k] . '" href="' . $place . '#' . $sub_items[$k] . '">' . $menu . '</a></li>';

                    }

                }

            }

        }

        echo "</ul>";

    }

    public function createExtensionsMenu()
    {
        echo "<h6>Extension</h6>";

        sort($this->list_folder);

        echo "<ul>";

        for($i = 0; $i < count($this->list_folder); $i++) {
            $extname = (strlen($this->list_folder[$i]) < 3) ? strtoupper($this->list_folder[$i]) : ucfirst($this->list_folder[$i]);
            echo '<li><a href="/extensions+'.$this->list_folder[$i].'+'.$this->lang.'">Sample-'.$extname.'</a></li>';
        }

        echo "</ul>";

    }

    public function createMenu()
    {
        $this->getMenuItems("menu");

        foreach ($this->menu_array as $menu => $sub_items) {

            sort($sub_items);

            $link = "#" . str_replace(" ", "-", strtolower($menu));

            echo "<h6><a data-scroll-anchor='" . $link . "' href='" . $link . "'>" . $menu . "</a></h6>";

            if (count($sub_items) > 0) {

                echo "<ul>";

                for ($k = 0; $k < count($sub_items); $k++) {

                    $sub_item = explode("-", $sub_items[$k])[0];

                    echo '<li><a data-scroll-anchor="#' . $sub_items[$k] . '" href="#' . $sub_items[$k] . '">' . $sub_item . '</a></li>';
                }

                echo "</ul>";

            }

        }

    }

}