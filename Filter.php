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

    public static function ipHead($head)
    {
        $vars = array(
            'siteName' => ipGetOptionLang('Config.websiteTitle')
        );
        $defaultTitle = ipGetOptionLang('FacebookTags.defaultTitle');
        if ($defaultTitle) {
            $vars['title'] = $defaultTitle;
        }
        $defaultImage = array(ipGetOptionLang('FacebookTags.defaultImage'));
        if ($defaultImage) {
            $vars['images'] = $defaultImage;
        }
        $adminId = ipGetOptionLang('FacebookTags.adminId');
        if ($adminId) {
            $vars['adminId'] = $adminId;
        }
        $pageTags = Service::facebookTags();
        if (!empty($pageTags['images'])) {
            foreach($pageTags['images'] as &$image) {
                $image = ipFileUrl('file/repository/' . $image);
            }
        } else {
            unset($pageTags['images']);
        }
        $vars = array_merge($vars, $pageTags);

        $tags = ipView('view/tags.php', $vars)->render();
        $head .= $tags;
        return $head;
    }
}
