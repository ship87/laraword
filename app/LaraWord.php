<?php

namespace LaraWord;

use LaraWord\Utils\Loader;

/**
 * Class LaraWord
 *
 * @package LaraWord
 * @author  Roman Shipelov <theship87@gmail.com>
 */
class LaraWord {

    private $loader;

    /**
     * LaraWord constructor.
     */
    public function __construct() {

        $this->loader = new Loader();

        $this->defineAdminHooks();
    }

    private function defineAdminHooks() {

        $admin = new Controllers\AdminController();

        add_action( 'admin_menu', array( $admin, 'adminGenerateMenu' ) );

    }

    public function run() {

        $this->loader->run();
    }


    public function getLoader() {

        return $this->loader;
    }

}

