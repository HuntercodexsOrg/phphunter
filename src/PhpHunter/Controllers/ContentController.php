<?php

namespace PhpHunter\Framework\Controllers;

class ContentController
{

    private $list_dir;
    private $ignore_files;

    public function __construct($dir, $ignore_files)
    {
        $this->list_dir = $dir;
        $this->ignore_files = $ignore_files;
    }

    public function incContents()
    {

        $list_dir = glob($this->list_dir, GLOB_BRACE);
        sort($list_dir);

        if (count($list_dir) > 0) {

            for ($j = 0; $j < count($list_dir); $j++) {

                if (!in_array(basename($list_dir[$j]), $this->ignore_files) && file_exists($list_dir[$j])) {

                    include($list_dir[$j]);

                }
            }
        }
    }
}