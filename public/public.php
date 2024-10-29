<?php

/*
 * @link
 * @since 1.0.0
 * @package Apoyl_Views
 * @subpackage Apoyl_Views/public
 * @author 凹凸曼 <jar-c@163.com>
 *
 */
class Apoyl_Views_Public
{

    private $plugin_name;

    private $version;

    public function __construct($plugin_name, $version)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }
    public function views_count()
    {

        if (is_singular()) {
            global $post;
            $arr = get_option('apoyl-views-settings');
            if (isset($post->ID)&&$post->ID>0&&$arr['open']) {
                $key='apoyl_views_count';
                $post_views = (int)get_post_meta($post->ID, $key, true);
                if (!update_post_meta($post->ID, $key, ($post_views + 1))) {
                    add_post_meta($post->ID, $key, 1, true);
                }
            }
        }
    }

    public function display_count($content)
    {
        $str= '' ;
        $arr = get_option('apoyl-views-settings');
        if (is_single()&&$arr['open']) {

            $count_key = 'apoyl_views_count';
            $aid = get_the_ID();
            $count = (int)get_post_meta($aid, $count_key, true);
            $str= '<div>' . esc_html__('viewscount','apoyl-views').':' . $count . '</div>' ;
        }
        return $str. $content;
    }

}