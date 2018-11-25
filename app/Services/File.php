<?php

namespace LaraWord\Services;

/**
 * Class File
 * @package LaraWord\Services
 * @author  Roman Shipelov <theship87@gmail.com>
 */
class File {

    private $mainFile = "index.php";

    private $backupFile = "index.php.backuplaraword";

    private $pathMainFile;

    private $pathBackupFile;

    public $message = [];

    const LARAWORD_FRAMEWORK_PATH = LARAWORD_PLUGIN_NAME . "/vendor/ship87/laraword-framework/";

    public function __construct() {

        $this->pathMainFile = ABSPATH . $this->mainFile;

        $this->pathBackupFile = ABSPATH . $this->backupFile;

    }

    /**
     * @return string
     */
    public function saveFilesLaravel() {

        if ( ! file_exists( $this->pathMainFile ) ) {

            $this->message[] = "The file " . $this->mainFile . " does not exist";
        } elseif ( file_exists( $this->pathBackupFile ) ) {

            $this->message[] = "The file " . $this->backupFile . " exist";
        } elseif ( rename( $this->pathMainFile, $this->pathBackupFile ) ) {

            $this->message[] = "The file " . $this->mainFile . " was successfully renamed to " . $this->backupFile;

            $this->createFileIncludeLaravelFront();

        } else {
            $this->message[] = "Renaming file " . $this->mainFile . " was not performed";
        }

        return $this;
    }

    /**
     * @return string
     */
    public function removeFilesLaravel() {

        if ( ! file_exists( $this->pathMainFile ) ) {

            $this->message[] = "The file " . $this->mainFile . " does not exist";
        } elseif ( ! file_exists( $this->pathBackupFile ) ) {

            $this->message[] = "The file " . $this->backupFile . " does not exist";
        } elseif ( rename( $this->pathBackupFile, $this->pathMainFile ) ) {

            $this->message[] = "The file " . $this->mainFile . " was restored";
        } else {

            $this->message[] = "Restore file " . $this->mainFile . " was not performed";
        }

        return $this;
    }

    private function createFileIncludeLaravelFront() {

        $fileRedirectFront = "<?php require( dirname( __FILE__ ) . '/wp-content/plugins/" . self::LARAWORD_FRAMEWORK_PATH . "public/index.php' );";

        if ( ! $fp = fopen( $this->pathMainFile, "w" ) ) {
            $this->message[] = "Cannot create file " . $this->mainFile;
        } else {

            if ( fwrite( $fp, $fileRedirectFront ) === false ) {
                $this->message[] = "Cannot save in file " . $this->mainFile;
            } else {

                fclose( $fp );
                $this->message[] = "The file with redirect to Laravel frontend " . $this->mainFile . " was successfully created";
            }
        }

        return $this;
    }

}
