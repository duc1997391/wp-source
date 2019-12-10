<?php 

/** get the image element include image, class, default image **/
function get_image($image, $class = "", $dfImage = 'noimage.png'){
    $imageUrl = $image?$image['url']:DF_IMAGE . $dfImage;
    $imageAlt = $image?$image['title']:'no-image';
    $result = '<img src="'.$imageUrl.'" alt="'.$imageAlt.'" class="'.$class.'">';
    return $result;
}

/** get the image element include postId, class **/
function get_post_thumb($id,$class = ""){
    $imageUrl = get_the_post_thumbnail_url($id)?get_the_post_thumbnail_url($id):DF_IMAGE . 'noimage.png';
    $imageAlt = get_the_title($id);
    $result = '<img src="'.$imageUrl.'" alt="'.$imageAlt.'" class="'.$class.'">';
    return $result;
}

/** get page link **/
function custom_get_page_link($template,$id = false) {
    $args_page = array(
        'post_type' => 'page',
        'meta_key' => '_wp_page_template',
        'meta_value' => $template,
        'suppress_filters' => false,
        'hierarchical' => 0,
        'posts_per_page' => 1,
    );
    $lang_posts = new WP_Query($args_page);
    $page = $lang_posts->posts;
    if(count($page)) {
        $page = current($page);
        if($id === true) {
            return $page->ID;
        }
        return get_page_link($page);
    }
    return '';
}

/** cutting the description to a list of p_element after each newline **/
function get_description($item,$limit = 1,$class=''){
    $desList = preg_split('/\r\n|\n\r/',$item);
    $results = '';
    $count = 0;
    $addClass = '';
    if ($class != '')
        $addClass = 'class="'.$class.'"';
    foreach ($desList as $item){
        if ($count === $limit)
            break;
        if ($item != ''){
            $pContent = '<p '.$addClass.'>'.$item.'</p>';
            $results = $results . $pContent;
            $count++;
        }
    }
    return $results;
}

/** same var_dump **/
function var_dumps($item){
    echo '<pre>';
    var_dump($item);
    echo '</pre>';
}

/*
add_action( 'get_blog_box', 'get_blog_box_call_back');
function get_blog_box_call_back($post){
    $thisID = $post->ID;
    $thisTitle = $post->post_title;
    $thisExcerpt = $post->post_excerpt;
    ?>
    <article class="blog-item">
        
    </article>
    <?php
}
*/

?>