<?php
use TriTan\Exception\IOException;
use Cascade\Cascade;
use TriTan\Common\FileSystem;
use TriTan\Database;

$hook = \TriTan\Common\Hooks\ActionFilterHook::getInstance();
$file = new FileSystem($hook);
$db = new Database();
$helper = new TriTan\Common\Context\HelperContext();

/**
 * Bootstrap for the application
 *
 * @license GPLv3
 *
 * @since       0.9
 * @package     TriTan CMS
 * @author      Joshua Parker <joshmac3@icloud.com>
 */
try {
    /**
     * Creates a cookies directory with proper permissions.
     */
    $file->mkdir(app()->config('cookies.savepath'));
} catch (IOException $e) {
    Cascade::getLogger('error')->error(sprintf('IOSTATE[%s]: Forbidden: %s', $e->getCode(), $e->getMessage()));
}

try {
    /**
     * Creates a file directory with proper permissions.
     */
    $file->mkdir(app()->config('file.savepath'));
} catch (IOException $e) {
    Cascade::getLogger('error')->error(sprintf('IOSTATE[%s]: Forbidden: %s', $e->getCode(), $e->getMessage()));
}

/**
 * Error log setting
 */
ttcms_set_environment();

/**
 * Loads the default textdomain.
 *
 * @since 0.9
 */
load_default_textdomain('tritan-cms', BASE_PATH . 'languages' . DS);
