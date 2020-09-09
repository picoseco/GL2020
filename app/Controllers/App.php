<?php

namespace App\Controllers;

use Sober\Controller\Controller;

class App extends Controller
{
    public function siteName()
    {
        return get_bloginfo('name');
    }

    public static function title()
    {
        if (is_home()) {
            if ($home = get_option('page_for_posts', true)) {
                return get_the_title($home);
            }
            return __('Latest Posts', 'sage');
        }
        if (is_archive()) {
            return get_the_archive_title();
        }
        if (is_search()) {
            return sprintf(__('Search Results for %s', 'sage'), get_search_query());
        }
        if (is_404()) {
            return __('Not Found', 'sage');
        }
        return get_the_title();
    }

    /** Primary Nav Menu arguments
    * @return array
    */
    public function primarymenu()
    {
        $args = array(
          'theme_location'    => 'primary_navigation',
          // 'container_class'   => 'collapse navbar-collapse',
          // 'container_id'      => 'navbarmain',
          'menu_class'        => 'nav navbar-nav ml-auto',
          'depth'             => 2,
          'walker'            => new \App\wp_bootstrap4_navwalker(),
        );
        return $args;
    }

    // mis funciones

    public static function headerpagCorto($size = "large", $post_id = "post")
    {
        global $post;
        if ("post" === $post_id) {
            $post_id = $post->ID;
        }
        $poster = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), $size, false);
        if ($poster) {
            echo '<div class="header_pag_corto align-items-center container-header d-flex mb-3 mb-md-5" style="background-image:url('.$poster[0].'); background-size:cover; background-position:center;">';
            echo '<div class="container text-white text-shadow text-center">';
            echo '<div class="row justify-content-md-center">';
            echo '<div class="col-md-6">';
            echo '<h1>'.get_the_title().'</h1>';
            // echo get_field('extracto');
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        }
    }

    public static function cardBg($size = "large")
    {
        global $post;
        $title_id = $post->ID;
        $poster = wp_get_attachment_image_src(get_post_thumbnail_id($title_id), $size, false);
        $title =  get_the_title();
        $page_content = apply_filters('the_content', get_post_field('post_content', $post->ID));
        if ($poster) {
            $html='<div class="card_bg align-items-center d-flex container-card mb-3 mb-md-5" style="background-image:url('.$poster[0].'); background-size:cover; background-position:center;">
            <div class="container text-white text-shadow text-center"><h1>'.$title.'</h1>'.$page_content.'</div></div>';
            return $html;
        }
    }

    public static function cardbgPost($size = "large", $page_slug = "post")
    {
        global $post;
        $title_id = $post->ID;
        $page_fondo = get_page_by_path($page_slug);
        $fondoID = $page_fondo->ID;
        $poster = wp_get_attachment_image_src(get_post_thumbnail_id($fondoID), $size, false);
        if ($poster) {
            $html='<div class="card_bg_title align-items-center d-flex container-card mb-n5 pb-3" style="background-image:url('.$poster[0].'); background-size:cover; background-position:center;">
            <div class="container text-white text-shadow text-center">
            <h1 class="text-uppercase">'.post_type_archive_title('', false).'</h1>
            <p class="lead">'.get_post_type_object(get_queried_object()->name)->description.'</p>
            </div>
            </div>';
            return $html;
        }
    }

    public static function cardGaleria()
    {
        global $post;
        $poster = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium_large', false);
        $html='<div class="card_bg_post rounded-lg align-items-end d-flex container-card" style="background-image:url('.$poster[0].'); background-size:cover; background-position:center;">
        <div class="container pb-3 text-white text-shadow text-center">
        <a class="h4 font-rion stretched-link text-white" href="'.get_permalink().'" >'.get_the_title().'</a>
        </div>
        </div>';
        return $html;
    }

    public static function dataRepresentante($child_post)
    {
        $html = '<div class="lugar mx-4">';
        $html .= '<h6>'.get_the_title($child_post).'</h6>';
        $html .= '<address>';
        $location = get_field('direccion', $child_post);
        if ($location) {
            $html .= '<p><i class="fas fa-map-marked-alt"></i> '.$location['address'].'</p>';
        }
        if (get_field("direccion_xtra", $child_post)) {
            $html .= '<p>'.get_field("direccion_xtra", $child_post).'</p>';
        }
        if (get_field("email", $child_post)) {
            $html .= '<p><i class="fas fa-envelope"></i> <a href="mailto:'.get_field("email", $child_post).'">'.get_field("email", $child_post).'</a></p>';
        }
        if (get_field("telefono", $child_post)) {
            $html .= '<p><i class="fas fa-phone"></i> '.get_field("telefono", $child_post);
        }
        if (get_field("telefono_alt", $child_post)) {
            $html .= ' / '.get_field("telefono_alt", $child_post);
        }
        if (get_field("telefono", $child_post)) {
            $html .= '</p>';
        }
        if (get_field("web", $child_post)) {
            $html .= '<p><i class="fas fa-atlas"></i> <a href="'.get_field("web", $child_post).'" target="_blank">'.get_field("web", $child_post).'</a></p>';
        }
        if (get_field("facebook", $child_post)) {
            $html .= '<p class="text-truncate"><i class="fab fa-facebook-square"></i> <a href="'.get_field("facebook", $child_post).'" target="_blank">'.get_field("facebook", $child_post).'</a></p>';
        }
        if (get_field("instagram", $child_post)) {
            $html .= '<p class="text-truncate"><i class="fab fa-instagram"></i> <a href="'.get_field("instagram", $child_post).'" target="_blank">'.get_field("instagram", $child_post).'</a></p>';
        }
        $html .= '</address>';
        $html .= '</div>';
        return $html;
    }
}
