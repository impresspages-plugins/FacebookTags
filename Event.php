<?php
/**
 * @package   ImpressPages
 */
/**
 * Created by PhpStorm.
 * User: maskas
 * Date: 3/25/14
 * Time: 10:14 AM
 */

namespace Plugin\FacebookTags;

class Event {
    public static function ipPageUpdated($data)
    {
        if (ipRoute()->plugin() != 'Pages' || ipRoute()->action() != 'updatePage') {
            return; //we want to handle only page updates that are made from within Pages section.
        }
        $pageId = $data['id'];

        $newTags = array();
        if (isset($data['facebookTagTitle'])) {
            $newTags['title'] = $data['facebookTagTitle'];
        }
        if (isset($data['facebookTagDescription'])) {
            $newTags['description'] = $data['facebookTagDescription'];
        }
        if (isset($data['facebookTagImages'])) {
            $newTags['images'] = $data['facebookTagImages'];
        }

        Model::updateFacebookTags($pageId, $newTags);
    }
    public static function ipBeforePageRemoved($data)
    {
        $pageId = $data['pageId'];
        Model::unbindImages($pageId);
    }
}
