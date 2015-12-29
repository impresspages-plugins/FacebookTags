<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: maskas
 * Date: 3/25/14
 * Time: 2:22 PM
 */

namespace Plugin\FacebookTags;


class Model
{
    const PLUGIN = 'FacebookTags';

    public static function getFacebookTags($pageId)
    {
        $filteredImages = array();
        $facebookTags = ipPageStorage($pageId)->get('FacebookTags');
        if (!empty($facebookTags['images']) && is_array($facebookTags['images'])) {
            foreach($facebookTags['images'] as $image) {
                if (is_string($image)) {
                    $filteredImages[] = $image;
                }
            }
        }
        $facebookTags['images'] = $filteredImages;
        return $facebookTags;
    }

    public static function updateFacebookTags($pageId, $tags)
    {
        $filteredImages = array();
        if (!empty($tags['images']) && is_array($tags['images'])) {
            foreach($tags['images'] as $file) {
                if (is_string($file)) {
                    $filteredImages[] = $file;
                }
            }
        }
        $tags['images'] = $filteredImages;

        self::unbindImages($pageId);
        self::bindImages($pageId, $filteredImages);
        ipPageStorage($pageId)->set('FacebookTags', $tags);
    }


    public static function unbindImages($pageId)
    {
        $facebookTags = self::getFacebookTags($pageId);
        if (empty($facebookTags['images']) || !is_array($facebookTags['images'])) {
            return;
        }

        foreach($facebookTags['images'] as $file) {
            ipUnbindFile($file, self::PLUGIN, $pageId);
        }
        ipPageStorage($pageId)->remove('facebookTagImage');

    }

    protected static function bindImages($pageId, $images)
    {
        if (is_array($images)) {
            foreach($images as $file) {
                ipBindFile($file, self::PLUGIN, $pageId);
            }
        }

    }
}
