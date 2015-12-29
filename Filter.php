<?php
/**
 * @package   ImpressPages
 */


/**
 * Created by PhpStorm.
 * User: maskas
 * Date: 3/25/14
 * Time: 9:58 AM
 */

namespace Plugin\FacebookTags;


class Filter {

    /**
     * @param \Ip\Form $form
     * @return mixed
     */
    public static function ipPagePropertiesForm($form, $info)
    {
        $requiredFields = array (
            'title' => '',
            'description' => '',
            'images' => array()
        );

        $tags = Service::facebookTags($info['pageId']);
        $tags = array_merge($requiredFields, $tags);

        $fieldset = new \Ip\Form\Fieldset(__('Facebook meta tags', 'FacebookTags', false));
        $form->addFieldset($fieldset);

        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'facebookTagTitle',
                'label' => __('Title', 'FacebookTags', false),
                'value' => $tags['title']
            )
        ));


        $form->addField(new \Ip\Form\Field\Text(
            array(
                'name' => 'facebookTagDescription',
                'label' => __('Description', 'FacebookTags', false),
                'value' => $tags['description']
            )
        ));

        $form->addField(new \Ip\Form\Field\RepositoryFile(
            array(
                'name' => 'facebookTagImages',
                'label' => __('Images', 'FacebookTags', false),
                'preview' => 'thumbnails',
                'value' => $tags['images']
            )
        ));


        return $form;
    }
}
