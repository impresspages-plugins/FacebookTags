<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: maskas
 * Date: 3/25/14
 * Time: 2:37 PM
 */

namespace Plugin\FacebookTags;


class Service {
    public static function facebookTags($pageId = null)
    {
        if ($pageId === null) {
            $currentPage = ipContent()->getCurrentPage();
            if (!$currentPage) {
                return array();
            }
            $pageId = $currentPage->getId();
        }
        return Model::getFacebookTags($pageId);
    }
}
