<?php

class AppHandler
{
    private $app_name;
    private $app_description;
    private $dirs_to_show_main_contents;
    private $path_name;
    private $main_dir;
    private $public_dir;
    private $file_index;
    private $dir_setup;
    private $save_setup;
    private $gateway_file;
    private $get_views;
    private $views_file;
    private $lib_version;
    private $lang;
    private $lib_path;
    private $youtube_url;

    protected $site_dir;
    protected $extensions_dir;

    public function __construct($path, $public_dir, $file, $views_file, $dir_setup = array())
    {
        $this->validateEnv();
        $this->path_name = preg_replace('/\/$/', '', $path)."/";
        $this->public_dir = preg_replace('/\/$/', '', $public_dir)."/";
        $this->file_index = $file;
        $this->views_file = $views_file;
        $this->dir_setup = $dir_setup;
        $this->save_setup = $dir_setup;
        $this->lib_path = env('LIBRARY_PATH');
        $this->youtube_url = env('YOUTUBE_CHANNEL');
        $this->site_dir = preg_replace('/\/$/', '', env('SITE_DIR'))."/";
        $this->extensions_dir = preg_replace('/\/$/', '', env('EXTENSIONS_DIR'))."/";
    }

    public function setAppName()
    {
        $this->app_name = env('APP_NAME');
    }

    public function setAppDescription()
    {
        $this->app_description = env('APP_DESCRIPTION');
    }

    public function setDirsToShowMainContents()
    {
        $this->dirs_to_show_main_contents =
            preg_replace('/,/', '|',
                preg_replace('/,$/', '',
                    preg_replace('/([\'".$ ])/', '', env('DIRS_TO_SHOW_MAIN_CONTENTS'))));
    }

    public function setMainDir()
    {
        $this->main_dir = env('MAIN_DIR');
    }

    public function setLanguage($lang)
    {
        $this->lang = $lang;
    }

    public function setGatewayFile()
    {
        if($this->dir_setup[0] == env('EXTENSIONS_DIR')) {
            //Extensions
            $this->gateway_file = $this->path_name . $this->extensions_dir . $this->file_index;
        } else {
            //Site
            $this->gateway_file = $this->path_name . $this->site_dir . $this->public_dir . $this->file_index;
        }

        if(!file_exists($this->gateway_file)) {
            //Force Redirect to Site
            $this->gateway_file = $this->path_name . $this->public_dir . $this->file_index;
        }
    }

    public function setDirSetup($query_string)
    {
        $this->dir_setup = explode("+", explode("/", $query_string)[1]);

        //Request Treat when error: content/name/lang
        if(count($this->dir_setup) != 3) {
            $this->dir_setup[0] = $this->save_setup[0];
            $this->dir_setup[1] = $this->save_setup[1];
            $this->dir_setup[2] = $this->save_setup[2];
        }
    }

    public function setDirSetupItem($index, $val)
    {
        $this->dir_setup[$index] = $val;
    }

    public function setLibVersion($fh)
    {
        $content = file_get_contents($fh);
        $lib_version = preg_match('/"version":.*".*"/', $content, $v);
        $this->lib_version = trim(str_replace('"', '', explode(":", $v[0])[1]));
    }

    public function getAppName()
    {
        return $this->app_name;
    }

    public function getAppDescription()
    {
        return $this->app_description;
    }

    public function getDirsToShowMainContents()
    {
        return $this->dirs_to_show_main_contents;
    }

    public function getMainDir()
    {
        return $this->main_dir;
    }

    public function getLanguage()
    {
        return $this->lang;
    }

    public function getContents($content = "")
    {
        $content = ($this->dir_setup[0] == env('EXTENSIONS_DIR')) ? $this->dir_setup[1] : $content;

        return
            $this->getPathName().
            $this->getDirSetup()[0].
            "/".$content."/".
            $this->getDirSetup()[2]."/*.php";
    }

    public function getMenuContents($content = "")
    {
        $content = ($content == "") ? $this->getDirSetup()[0]."/".$this->getDirSetup()[1] : $content;
        return $this->getPathName()."/".$content;
    }

    public function getGatewayFile()
    {
        return $this->gateway_file;
    }

    public function getPathName()
    {
        return $this->path_name;
    }

    public function getDirSetup()
    {
        return $this->dir_setup;
    }

    public function getViews()
    {
        return $this->get_views;
    }

    public function getLibVersion()
    {
        return $this->lib_version;
    }

    public function getLibPathInstallation()
    {
        return preg_replace('/\/$/', '', $this->lib_path);
    }

    public function getYoutubeUrl()
    {
        return $this->youtube_url;
    }

    public function checkMaintenance()
    {
        if(file_exists(".lock")) {
            include(env('MAINTENANCE_PAGE'));
            die;
        }
    }

    public function updateViews()
    {
        $this->get_views = file_get_contents($this->views_file);
        $this->get_views = ($this->get_views != "") ? $this->get_views : "0";

        //Only update when the page index (main page of site)
        if($this->dir_setup[0] == $this->save_setup[0] && $this->dir_setup[1] == $this->save_setup[1] && !isset($_SESSION['_ip_views_'])) {

            $this->get_views = (int)$this->get_views + 1;
            file_put_contents($this->views_file, $this->get_views);

            //Create a session to control views
            if(!isset($_SESSION['_ip_views_']) || $_SESSION['_ip_views_'] == "") {
                $_SESSION['_ip_views_'] = md5($_SERVER['REMOTE_ADDR']);
            }
        }

        return $this->getViews();
    }

    public function appControl($srv)
    {
        @$access_control = [
            'QUERY_STRING' => $srv['QUERY_STRING'],
            'SCRIPT_FILENAME' => $srv['SCRIPT_FILENAME'],
            'PATH_INFO' => $srv['PATH_INFO'],
            'AUTH_TYPE' => $srv['AUTH_TYPE'],
            'DOCUMENT_ROOT' => $srv['DOCUMENT_ROOT'],
            'GATEWAY_INTERFACE' => $srv['GATEWAY_INTERFACE'],
            'ORIG_PATH_INFO' => $srv['ORIG_PATH_INFO'],
            'PHP_SELF' => $srv['PHP_SELF'],
            'SCRIPT_NAME' => $srv['SCRIPT_NAME'],
            'REQUEST_URI' => $srv['REQUEST_URI'],
            'REQUEST_METHOD' => $srv['REQUEST_METHOD'],
        ];

        //Default Route
        $this->setDirSetup('/');

        if($access_control['REQUEST_URI'] !== "" && $access_control['REQUEST_URI'] !== "/") {
            //Update Route
            $this->setDirSetup($access_control["REQUEST_URI"]);
        }

        //Path of the main file (gateway) normally in public dir
        $this->setGatewayFile();

        //Define Current Language
        $this->setLanguage($this->dir_setup[2]);

        //Update Views on Site: only a index main file
        $this->updateViews();

        //Get Lib Version
        $this->setLibVersion(env('LIB_VERSION_FILE'));

        //Main Dir System
        $this->setMainDir();

        //App Name
        $this->setAppName();

        //App Description
        $this->setAppDescription();

        //Dirs To Show Main Contents
        $this->setDirsToShowMainContents();

        //Check Maintenance and abort
        $this->checkMaintenance();

        return $this;
    }

    private function validateEnv()
    {
        if(empty(env('APP_NAME'))) {
            die("Error: Missing APP_NAME into .env file");
        }

        if(empty(env('MAIN_DIR'))) {
            die("Error: Missing MAIN_DIR into .env file");
        }

        if(empty(env('DIRS_TO_SHOW_MAIN_CONTENTS'))) {
            die("Error: Missing DIRS_TO_SHOW_MAIN_CONTENTS into .env file");
        }

        if(empty(env('CONTENT_PATH'))) {
            die("Error: Missing CONTENT_PATH into .env file");
        }

        if(empty(env('PUBLIC_DIR'))) {
            die("Error: Missing PUBLIC_DIR into .env file");
        }

        if(empty(env('DEFAULT_FILE'))) {
            die("Error: Missing DEFAULT_FILE into .env file");
        }

        if(empty(env('SITE_DIR'))) {
            die("Error: Missing SITE_DIR into .env file");
        }

        if(empty(env('EXTENSIONS_DIR'))) {
            die("Error: Missing EXTENSIONS_DIR into .env file");
        }

        if(empty(env('SETUP_DIR'))) {
            die("Error: Missing SETUP_DIR into .env file");
        }

        if(empty(env('VIEWS_FILE'))) {
            die("Error: Missing VIEWS_FILE into .env file");
        }

        if(empty(env('LIB_VERSION_FILE'))) {
            die("Error: Missing LIB_VERSION_FILE into .env file");
        }

        if(empty(env('MAINTENANCE_PAGE'))) {
            die("Error: Missing MAINTENANCE_PAGE into .env file");
        }
    }

    public function run()
    {
        include($this->getGatewayFile());
    }
}
