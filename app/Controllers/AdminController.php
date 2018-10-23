<?php

namespace LaraWord\Controllers;

use LaraWord\Services\File;

/**
 * Class AdminController
 * @package LaraWord\Controllers
 * @author  Roman Shipelov <theship87@gmail.com>
 */
class AdminController {

    public $fileService;

    public $message = false;

    /**
     * AdminController constructor.
     *
     * @param $
     */
    public function __construct() {

        $this->fileService = new File();

    }

    public function adminGenerateMenu() {

        $this->checkFormSubmitAdminSettingsLaraWord();

        add_menu_page( 'Settings LaraWord', 'LaraWord', 'manage_options', 'settings-LaraWord', [
            $this,
            'adminSettingsLaraWord'
        ] );

        add_submenu_page( 'settings-LaraWord', 'About', 'About', 'manage_options', 'plugin_info', [
            $this,
            'adminPluginInfo'
        ] );
    }

    public function adminSettingsLaraWord() {

        require_once( LARAWORD_PLUGIN_DIR . 'resources/assets/view/settings.php' );

    }

    public function adminPluginInfo() {

        require_once( LARAWORD_PLUGIN_DIR . 'resources/assets/view/plugin_info.php' );
    }

    public function checkFormSubmitAdminSettingsLaraWord() {

        if ( ! empty( $_POST['laravel'] ) && $_POST['laravel'] == 1 ) {
            $_REQUEST['laravel'] = $_POST['laravel'] = false;
            $this->fileService->saveFilesLaravel();

        } elseif ( ! empty( $_POST['wordpress'] ) && $_POST['wordpress'] == 1 ) {
            $_REQUEST['wordpress'] = $_POST['wordpress'] = false;
            $this->fileService->removeFilesLaravel();
        }

    }

}
