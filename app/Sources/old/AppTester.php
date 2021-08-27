<?php

namespace App\Hunter\Source;

use App\Hunter\HelperHunter;

class AppTester
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
    private $path;
    private $public;
    private $file;
    private $setup;

    protected $site_dir;
    protected $extensions_dir;

    public function __construct()
    {
        //session_start();

        //require_once "./app/functions.php";
        //require_once "./app/source/AppHandler.php";

        $this->validateEnv();
        $this->path = HelperHunter::getEnv('CONTENT_PATH');
        $this->public = HelperHunter::getEnv('PUBLIC_DIR');
        $this->file = HelperHunter::getEnv('DEFAULT_FILE');
        $this->setup = HelperHunter::toArray(HelperHunter::getEnv('SETUP_DIR'));
        $this->views_file = HelperHunter::getEnv("VIEWS_FILE");
        $this->path_name = preg_replace('/\/$/', '', $this->path)."/";
        $this->public_dir = preg_replace('/\/$/', '', $this->public)."/";
        $this->file_index = $this->file;
        //$this->views_file = $this->views_file;
        $this->dir_setup = $this->setup;
        $this->save_setup = $this->setup;
        $this->lib_path = HelperHunter::getEnv('LIBRARY_PATH');
        $this->youtube_url = HelperHunter::getEnv('YOUTUBE_CHANNEL');
        $this->site_dir = preg_replace('/\/$/', '', HelperHunter::getEnv('SITE_DIR'))."/";
        $this->extensions_dir = preg_replace('/\/$/', '', HelperHunter::getEnv('EXTENSIONS_DIR'))."/";

        //echo "Testng: AppTester is running... ";
        //echo HelperHunter::getEnv('APP_NAME');
        HelperHunter::localLogger('test', 'AppTester Class is running...', true);

    }

    public function setAppName()
    {
        $this->app_name = HelperHunter::getEnv('APP_NAME');
    }

    public function setAppDescription()
    {
        $this->app_description = HelperHunter::getEnv('APP_DESCRIPTION');
    }

    public function setDirsToShowMainContents()
    {
        $this->dirs_to_show_main_contents =
            preg_replace('/,/', '|',
                preg_replace('/,$/', '',
                    preg_replace('/([\'".$ ])/', '', HelperHunter::getEnv('DIRS_TO_SHOW_MAIN_CONTENTS'))));
    }

    public function setMainDir()
    {
        $this->main_dir = HelperHunter::getEnv('MAIN_DIR');
    }

    public function setLanguage($lang)
    {
        $this->lang = $lang;
    }

    public function setGatewayFile()
    {
        if($this->dir_setup[0] == HelperHunter::getEnv('EXTENSIONS_DIR')) {
            //Extensions
            $this->gateway_file = $this->path_name . $this->extensions_dir . $this->file_index;
        } else {
            //Site
            $this->gateway_file = $this->path_name . $this->site_dir . $this->public_dir . $this->file_index;
        }

        if(!file_exists($this->gateway_file)) {
            //Redirect to Site
            $this->gateway_file = $this->path_name . $this->public_dir . $this->file_index;

            //Force Redirect to Site
            if(!file_exists($this->gateway_file)) {
                $this->gateway_file = './resources/public/index.php';
            }
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

    public function getTester()
    {
        echo "Tester in getTester()...";
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
        $content = ($this->dir_setup[0] == HelperHunter::getEnv('EXTENSIONS_DIR')) ? $this->dir_setup[1] : $content;

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
            include(HelperHunter::getEnv('MAINTENANCE_PAGE'));
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
        $this->setLibVersion(HelperHunter::getEnv('LIB_VERSION_FILE'));

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

        HelperHunter::localLogger('test', $this->dir_setup, true);

        return $this;
    }

    private function validateEnv()
    {
        if(empty(HelperHunter::getEnv('APP_NAME'))) {
            die("Error: Missing APP_NAME into .env file");
        }

        if(empty(HelperHunter::getEnv('MAIN_DIR'))) {
            die("Error: Missing MAIN_DIR into .env file");
        }

        if(empty(HelperHunter::getEnv('DIRS_TO_SHOW_MAIN_CONTENTS'))) {
            die("Error: Missing DIRS_TO_SHOW_MAIN_CONTENTS into .env file");
        }

        if(empty(HelperHunter::getEnv('CONTENT_PATH'))) {
            die("Error: Missing CONTENT_PATH into .env file");
        }

        if(empty(HelperHunter::getEnv('PUBLIC_DIR'))) {
            die("Error: Missing PUBLIC_DIR into .env file");
        }

        if(empty(HelperHunter::getEnv('DEFAULT_FILE'))) {
            die("Error: Missing DEFAULT_FILE into .env file");
        }

        if(empty(HelperHunter::getEnv('SITE_DIR'))) {
            die("Error: Missing SITE_DIR into .env file");
        }

        if(empty(HelperHunter::getEnv('EXTENSIONS_DIR'))) {
            die("Error: Missing EXTENSIONS_DIR into .env file");
        }

        if(empty(HelperHunter::getEnv('SETUP_DIR'))) {
            die("Error: Missing SETUP_DIR into .env file");
        }

        if(empty(HelperHunter::getEnv('VIEWS_FILE'))) {
            die("Error: Missing VIEWS_FILE into .env file");
        }

        if(empty(HelperHunter::getEnv('LIB_VERSION_FILE'))) {
            die("Error: Missing LIB_VERSION_FILE into .env file");
        }

        if(empty(HelperHunter::getEnv('MAINTENANCE_PAGE'))) {
            die("Error: Missing MAINTENANCE_PAGE into .env file");
        }
    }

    public function redirectTo()
    {
        header('Location: denied.php');
    }

    private function basicAuth($user, $pass)
    {
        if(!$user || !$pass) {
            return false;
        } else if($user == "basic" && $pass == "basic") {
            return true;
        }
        return false;
    }

    public function run()
    {
        if(!$this->basicAuth("basic", "basic")) {
            $this->redirectTo();
        }
        include($this->getGatewayFile());
        return $this;
    }

}
