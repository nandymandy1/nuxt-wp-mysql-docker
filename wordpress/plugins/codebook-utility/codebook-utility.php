<?php
/**
 * Version: 1.0.0
 * Author: Narendra Maurya
 * Plugin Name: Codebook Utiltiy
 * API Endpoint: http://codebookinc.local/wp-json/outright/v1
 */

class CodebookInc extends WP_REST_Controller {
    /**
     * Constructor.
    */
    public function __construct() {
        $this->namespace = 'outright/v1';
    }

    /**
     * @description To get all the posts by pagination
     * @access public
     * @type GET
     */
    public function register_routes() {
      register_rest_route(
        $this->namespace, 
        '/posts' , 
        array(
          array(
            'methods'=> WP_REST_Server::READABLE,
            'args'=> $this->get_collection_params(),
            'callback'=> array($this,'codebook_posts'),
            'permission_callback' => array($this, 'get_items_permissions_check'),
          )
        )
      );

      /**
     * @description To get single the post by slug with SEO Data
     * @access public
     * @type GET
     */
      register_rest_route(
        $this->namespace, 
        '/posts/(?P<slug>[a-zA-Z0-9-]+)', 
        array(
          'methods' => WP_REST_Server::READABLE,
          'callback' => array($this, 'codebook_post'),
          'permission_callback' => array($this, 'get_items_permissions_check'),
        )
      );

      /**
     * @description To get recent posts
     * @access public
     * @type GET
     */
      register_rest_route(
        $this->namespace, 
        '/posts-recent', 
        array(
          'methods' => WP_REST_Server::READABLE,
          'callback' => array($this, 'codebook_recent_posts'),
          'permission_callback' => array($this, 'get_items_permissions_check'),
        )
      );

      /**
       * @description To get all the banners
       * @access public
       * @type GET
      */
      register_rest_route(
        $this->namespace, 
        '/banners', 
        array(
          'methods' => WP_REST_Server::READABLE,
          'callback' => array($this, 'codebook_banners'),
          'permission_callback' => array($this, 'get_items_permissions_check'),
        )
      );

      /**
       * @description To get all the team members
       * @access public
       * @type GET
      */
      register_rest_route(
        $this->namespace, 
        '/teams', 
        array(
          'methods' => WP_REST_Server::READABLE,
          'callback' => array($this, 'codebook_team'),
          'permission_callback' => array($this, 'get_items_permissions_check'),
        )
      );
      
      /**
       * @description To get all the testimonials
       * @access public
       * @type GET
      */
      register_rest_route(
        $this->namespace, 
        '/testimonials', 
        array(
          'methods' => WP_REST_Server::READABLE,
          'callback' => array($this, 'codebook_testimonials'),
          'permission_callback' => array($this, 'get_items_permissions_check'),
        )
      );

      /**
       * @description To get a particular page by page slug
       * @access public
       * @type GET
      */
      register_rest_route(
        $this->namespace, 
        '/page/(?P<slug>[a-zA-Z0-9-]+)',
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => array($this, 'codebook_page'),
            'permission_callback' => array($this, 'get_items_permissions_check')
        )
      );

      /**
       * @description To get all posts categories
       * @access public
       * @type GET
      */
      register_rest_route(
        $this->namespace,
        '/categories',
        array(
            'methods' => WP_REST_Server::READABLE,
            'callback' => array($this, 'codebook_categories'),
            'permission_callback' => array($this, 'get_items_permissions_check')
        )
      );

      /**
       * @description To get all posts of particular category by category slug
       * @access public
       * @type GET
      */
      register_rest_route(
        $this->namespace,
        '/category-posts/(?P<slug>[a-zA-Z0-9-]+)',
        array(
          array(
            'methods'=> WP_REST_Server::READABLE,
            'args'=> $this->get_collection_params(),
            'callback'=> array($this,'codebook_category_posts'),
            'permission_callback' => array($this, 'get_items_permissions_check'),
          )
        )
      );

      /**
       * @description To get all posts of particular category by category slug
       * @access public
       * @type POST
      */
      register_rest_route(
        $this->namespace,
        '/comment/(?P<post>[a-zA-Z0-9-]+)',
        array(
          array(
            'methods'=> 'POST',
            'args'=> $this->get_collection_params(),
            'callback'=> array($this,'codebook_comment_on_post'),
            'permission_callback' => array($this, 'get_items_permissions_check'),
          )
        )
      );

      /**
       * @description To get all posts of particular category by category slug
       * @access public
       * @type POST
      */
      register_rest_route(
        $this->namespace,
        '/like-post/(?P<post>[a-zA-Z0-9-]+)',
        array(
          array(
            'methods'=> 'POST',
            'args'=> $this->get_collection_params(),
            'callback'=> array($this,'codebook_like_post'),
            'permission_callback' => array($this, 'get_items_permissions_check'),
          )
        )
      );
    }

    // Get all Banners of the application
    public function codebook_banners(){
      $query = array(
        'numberposts' => 9999,
        'sort_order' => 'asc',
        'post_type' => 'banners',
      );
      $posts = get_posts($query);
      $data = [];
      $i = 0;
      foreach ($posts as $post) {
          $data[$i] = array(
            'id' => $post->ID,
            'slug'=> $post->post_name,
            'title' => $post->post_title,
            'excerpt' => $post->post_excerpt,
            'featured_image' => array(
              'large' => get_the_post_thumbnail_url($post->ID, 'large'),
              'medium' => get_the_post_thumbnail_url($post->ID, 'medium')
            ),
            'link' => get_field("action_link" ,$post->ID)
          );
          $i++;
      }
      return new WP_REST_Response($data, 200);
    }

    // Get all Customer Testimonials
    public function codebook_testimonials(){
      $query = array(
          'numberposts' => 9999,
          'sort_order' => 'desc',
          'post_type' => 'testimonials',
      );
      $posts = get_posts($query);
      $data = [];
      $i = 0;
      foreach ($posts as $post) {
          $data[$i] = array(
            'id' => $post->ID,
            'slug'=> $post->post_name,
            'title' => $post->post_title,
            'content' => $post->post_content,
            'excerpt' => $post->post_excerpt,
            'social_links' => get_field("social_links" ,$post->ID),
            'featured_image' => array(
              'large' => get_the_post_thumbnail_url($post->ID, 'large'),
              'medium' => get_the_post_thumbnail_url($post->ID, 'medium')
            )
          );
          $i++;
      }
      return new WP_REST_Response($data, 200);
    }

    // Get all Team Members List
    public function codebook_team(){
      $query = array(
          'numberposts' => 9999,
          'sort_order' => 'asc',
          'post_type' => 'teams',
      );
  
      $posts = get_posts($query);
      $data = [];
      $i = 0;
      foreach ($posts as $post) {
          $data[$i] = array(
            'id' => $post->ID,
            'slug'=> $post->post_name,
            'title' => $post->post_title,
            'excerpt' => $post->post_excerpt,
            'email' => get_field("email" ,$post->ID),
            'words' => get_field("quick_words" ,$post->ID),
            'position' => get_field("position" ,$post->ID),
            'links' => get_field("social_link" ,$post->ID),
            'phone' => get_field("contact_number" ,$post->ID),
            'featured_image' => array(
              'large' => get_the_post_thumbnail_url($post->ID, 'large'),
              'medium' => get_the_post_thumbnail_url($post->ID, 'medium')
            )
          );
          $i++;
      }
      return new WP_REST_Response($data, 200);
    }

    // Get a Particular page by slug
    public function codebook_page(WP_REST_Request $request){
      $post = get_posts(
          array(
              'post_type' => 'page',
              'name' => $request['slug']
          )
      );

      if (count($post)) {
        $data = array(
          'id' => $post[0]->ID,
          'slug' => $post[0]->post_name,
          'title' => $post[0]->post_title,
          'content' => $post[0]->post_content,
          'meta' => $this->get_page_seo_fields($post[0]->ID)
        );
        return new WP_REST_Response($data, 200);
      } else {
        return new WP_REST_Response(
          array(
            'message' => 'Page not Found.',
            'code' => 'page_not_found'
          ), 200
        );
      }
    }

    // Get all categories of posts
    public function codebook_categories(){
      $i=0;
      $data = array();
      $categories_raw = get_categories(array( 'parent' => 0 ));
      foreach($categories_raw as $cat){
        $data[$i] = $cat;
        $i++;
      }
      return new WP_REST_Response($data, 200);
    }

    // Get Posts by caregory
    public function codebook_category_posts(WP_REST_Request $request){
      $category_post_object = new WP_Query(
          array(
              'post_type' => 'post',
              'posts_per_page' => 10,
              'post_status' => 'publish',
              'paged'=> $request['page'],
              'category_name' => $request['slug'] == 'all' ? '' : $request['slug'],
          )
      );

      $postsObj = $category_post_object->posts;
      $total_posts = $category_post_object->found_posts;
      $total_pages = $category_post_object->max_num_pages;
  
      $i = 0;
      $posts = [];
      if(count($postsObj)){
          foreach($postsObj as $post){
            $posts[$i] = $this->prepare_item_for_response($post, $request);
            $i++;
          }
          return new WP_REST_Response(
            array(
              'posts' => $posts,
              'pages' => $total_pages,
              'total_posts' => $total_posts
            ), 200
          );
      } else {
        $posts = [];
        return new WP_REST_Response(
          array(
            'code' => 'category_empty',
            'message' => "Currently there are no posts in this category.",
          ), 404
        );
      }
    }
    /**
     * GET SINGLE POST BY URL SLUG
     */
    public function codebook_post(WP_REST_Request $request){
        $post = get_posts(
            array(
                'post_type' => 'post',
                'name' => $request['slug'],
            )
        );

        if (count($post)) {
            $data = $this->prepare_item_for_response($post[0], $request, true, true, true);
            $data['meta'] = $this->get_seo_fields($post[0]->ID);
            return new WP_REST_Response($data, 200);
        } else {
            return new WP_REST_Response(
                array(
                    'message' => "Post not found.",
                    'code' => 'post_not_found'
                ),
                404
            );
        }
    }
    /**
     * GET RECENT POSTS
     */
    public function codebook_recent_posts(WP_REST_Request $request){
      $args = array(
        'order' => 'DESC',
        'numberposts' => 10,
        'post_types' => 'post',
      );

      $posts = get_posts($args);

      $data = array();
      $i=0;
      foreach ($posts as $post) {
        $data[$i] = array(
          'id' => $post->ID,
          'slug' => $post->post_name,
          'title' => $post->post_title,
        );
        $i++;
      }

      $response = new WP_REST_Response($data, 200);
      return $response;
    }
    /**
     * GET PAGINATED LIST OF POSTS
     */
    public function codebook_posts(WP_REST_Request $request) {
      $args = array(
        'post_type'=> 'post',
        'paged'=> $request['page'],
        'posts_per_page'=> $request['per_page'],
      );

      // use WP_Query to get the results with pagination
      $query = new WP_Query($args); 
  
      // if no posts found return 
      if(empty($query->posts)){
        return new WP_Error('no_posts', __('No post found'), array('status' => 404));
      }

      // set max number of pages and total num of posts
      $posts = $query->posts;
      $total = $query->found_posts;
      $max_pages = $query->max_num_pages;
      
      $data = [];
      $i = 0;

      foreach ($posts as $post) {
        $response = $this->prepare_item_for_response($post, $request);
        $data[$i] = $response;
        $i++;
      }
    
      // set headers and return response      
      $response = new WP_REST_Response(array(
          'total_pages' => $max_pages,
          'total_posts' => $total,
          'posts' => $data
      ), 200);
      return $response;
    }

    public function codebook_comment_on_post(WP_REST_Request $request){
      $body = json_decode($request->get_body(), true);
      
      if(!isset($body['comment']) || !isset($body['name']) || !isset($body['email'])){
        return new WP_REST_Response(
          array(
            'success' => false,
            'message' => 'Your name, email and comment is required'
          ), 400
        );
      }
      
      if(!strlen($body['comment']) || !strlen($body['email']) || !strlen($body['name'])){
        return new WP_REST_Response(
          array(
            'success' => false,
            'message' => 'Your name, email and comment is required'
          ), 400
        );
      }
      
      $cmtStatus = wp_insert_comment(
        array(
          'comment_type' => 'Guest',
          'comment_approved' => 0,
          'comment_author' => $body['name'],
          'comment_post_ID' => $request['post'],
          'comment_content' => $body['comment'],
          'comment_date' => date("Y-m-d", time()),
          'comment_author_email' => $body['email'],
          )
        );
        
        if($cmtStatus){
          $response = new WP_REST_Response(
            array(
              'success' => true,
              'message' => 'Your comment is posted. Our team will review it and then post it after approval on the page.'
            ), 200
          );
        } else {
          $response = new WP_REST_Response(
            array(
              'success' => false,
              'message' => 'Your comment is not posted.'
            ), 400
          );
        }
        return $response;
    }
    /**
      * Like a post in wordpress 
    */
    public function codebook_like_post(WP_REST_Request $request){
      $post = get_posts(
          array(
              'post_type' => 'post',
              'name' => $request['post'],
          )
      );

      if (count($post)) {
          $data = $this->prepare_item_for_response($post[0], $request);
          $total_likes = (int) $data['likes'] + 1;
          $res = update_post_meta($data['id'], 'likes', $total_likes);
          return new WP_REST_Response(
            array(
              'success' => true,
              'message' => "You liked this post.",
            ), 201
          );
      } else {
        return new WP_REST_Response(
          array(
            'message' => "Post not found.",
            'code' => 'post_not_found'
          ), 404
        );
      }
    }
    /**
     * Check if a given request has access to post items.
     */
    public function get_items_permissions_check($request) {
      return true;
    }

    public function get_page_seo_fields($postID){
      $post_meta_title = get_post_meta($postID, '_yoast_wpseo_title', true);
      $focus_keyword = get_post_meta($postID, '_yoast_wpseo_focuskw', true);
      $post_meta_canonical = get_post_meta($postID, '_yoast_wpseo_canonical', true);
      $post_meta_description =  get_post_meta($postID, '_yoast_wpseo_metadesc', true);
      $post_meta_fb_image = get_post_meta($postID, '_yoast_wpseo_facebook-image', true);
      $post_meta_fb_title = get_post_meta($postID, '_yoast_wpseo_facebook-title', true);
      $post_meta_graph_img =  get_post_meta($postID, '_yoast_wpseo_opengraph-image', true);
      $post_meta_twitter_title = get_post_meta($postID, '_yoast_wpseo_twitter-title', true);
      $post_meta_twitter_image = get_post_meta($postID, '_yoast_wpseo_twitter-image', true);
      $post_thumbnail_url = get_the_post_thumbnail_url($postID, 'mediumish-featured-image');
      $post_meta_graph_title =  get_post_meta($postID, '_yoast_wpseo_opengraph-title', true);
      $post_meta_graph_desc =  get_post_meta($postID, '_yoast_wpseo_opengraph-description', true);
      $post_meta_fb_description = get_post_meta($postID, '_yoast_wpseo_facebook-description', true);
      $post_meta_twitter_description = get_post_meta($postID, '_yoast_wpseo_twitter-description', true);

      $title =  $post_meta ? $post_meta : get_the_title($postID);
      $canonical =  $post_meta_canonical ? $post_meta_canonical : get_the_permalink($postID);
      
      $meta_desc =  $post_meta_description ? $post_meta_description : 
                    (has_excerpt($postID) && trim(get_the_excerpt($postID)) !== "" ? get_the_excerpt($postID) : 
                      force_balance_tags(html_entity_decode(wp_trim_words(htmlentities(
                              strip_tags($postObject->post_content)
                            ),
                          50, 
                        "")
                    )));

      $og_title = $post_meta_graph_title ? $post_meta_graph_title : $title;
      $og_description = $post_meta_graph_desc ? $post_meta_graph_desc : $meta_desc;
      $og_image = $post_meta_graph_img ? $post_meta_graph_img : $post_thumbnail_url;
      
      /* Twitter */
      $twitter_title =  $post_meta_twitter_title ? $post_meta_twitter_title : $title;
      $twitter__image = $post_meta_twitter_image ? $post_meta_twitter_image : $post_thumbnail_url;
      $twitter_description =  $post_meta_twitter_description ? $post_meta_twitter_description : $meta_desc;

      /* Facebook */
      $fb_title =  $post_meta_fb_title ? $post_meta_fb_title : $title;
      $fb__image = $post_meta_fb_image ? $post_meta_fb_image : $post_thumbnail_url;
      $fb_description =  $post_meta_fb_description ? $post_meta_fb_description : $meta_desc;

      $yoastMeta = array(
        'title' => $title,
        'fb_title' => $fb_title,
        'metadesc' => $meta_desc,
        'fb_image' => $fb__image,
        'canonical' => $canonical,
        'focuskw' => $focus_keyword,
        'opengraph_title' => $og_title,
        'opengraph_image' => $og_image,
        'twitter_title' => $twitter_title,
        'twitter_image' => $twitter__image,
        'fb_description' => $fb_description,
        'opengraph_url' => get_permalink($postID),
        'opengraph_description' => $og_description,
        'opengraph_site_name' => get_bloginfo('name'),
        'twitter_description' => $twitter_description,
        'linkdex' => get_post_meta($postID, '_yoast_wpseo_linkdex', true),
        'redirect' => get_post_meta($postID, '_yoast_wpseo_redirect', true),
        'metakeywords' => get_post_meta($postID, '_yoast_wpseo_metakeywords', true),
        'opengraph_updated_time' => get_post_modified_time('U', false, $postID, false),
        'meta_robots_adv' => get_post_meta($postID, '_yoast_wpseo_meta-robots-adv', true),
        'meta_robots_noindex' => get_post_meta($postID, '_yoast_wpseo_meta-robots-noindex', true),
        'meta_robots_nofollow' => get_post_meta($postID, '_yoast_wpseo_meta-robots-nofollow', true),
      );

      return (array) $yoastMeta;
    }

    public function get_seo_fields($postID){
      $postObject = get_post($postID);

      $post_meta_title = get_post_meta($postID, '_yoast_wpseo_title', true);
      $focus_keyword = get_post_meta($postID, '_yoast_wpseo_focuskw', true);
      $post_meta_canonical = get_post_meta($postID, '_yoast_wpseo_canonical', true);
      $post_meta_description =  get_post_meta($postID, '_yoast_wpseo_metadesc', true);
      $post_meta_fb_image = get_post_meta($postID, '_yoast_wpseo_facebook-image', true);
      $post_meta_fb_title = get_post_meta($postID, '_yoast_wpseo_facebook-title', true);
      $post_meta_graph_img =  get_post_meta($postID, '_yoast_wpseo_opengraph-image', true);
      $post_meta_twitter_title = get_post_meta($postID, '_yoast_wpseo_twitter-title', true);
      $post_meta_twitter_image = get_post_meta($postID, '_yoast_wpseo_twitter-image', true);
      $post_thumbnail_url = get_the_post_thumbnail_url($postID, 'mediumish-featured-image');
      $post_meta_graph_title =  get_post_meta($postID, '_yoast_wpseo_opengraph-title', true);
      $post_meta_graph_desc =  get_post_meta($postID, '_yoast_wpseo_opengraph-description', true);
      $post_meta_fb_description = get_post_meta($postID, '_yoast_wpseo_facebook-description', true);
      $post_meta_twitter_description = get_post_meta($postID, '_yoast_wpseo_twitter-description', true);

      $title =  $post_meta ? $post_meta : get_the_title($postID);
      $canonical =  $post_meta_canonical ? $post_meta_canonical : get_the_permalink($postID);
      
      $meta_desc =  $post_meta_description ? $post_meta_description : 
                    (has_excerpt($postID) && trim(get_the_excerpt($postID)) !== "" ? get_the_excerpt($postID) : 
                      force_balance_tags(html_entity_decode(wp_trim_words(htmlentities(
                              strip_tags($postObject->post_content)
                            ),
                          50, 
                        "")
                    )));

      $og_title = $post_meta_graph_title ? $post_meta_graph_title : $title;
      $og_description = $post_meta_graph_desc ? $post_meta_graph_desc : $meta_desc;
      $og_image = $post_meta_graph_img ? $post_meta_graph_img : $post_thumbnail_url;
      
      /* Twitter */
      $twitter_title =  $post_meta_twitter_title ? $post_meta_twitter_title : $title;
      $twitter__image = $post_meta_twitter_image ? $post_meta_twitter_image : $post_thumbnail_url;
      $twitter_description =  $post_meta_twitter_description ? $post_meta_twitter_description : $meta_desc;

      /* Facebook */
      $fb_title =  $post_meta_fb_title ? $post_meta_fb_title : $title;
      $fb__image = $post_meta_fb_image ? $post_meta_fb_image : $post_thumbnail_url;
      $fb_description =  $post_meta_fb_description ? $post_meta_fb_description : $meta_desc;
      
      $yoastMeta = array(
          'title' => $title,
          'fb_title' => $fb_title,
          'metadesc' => $meta_desc,
          'fb_image' => $fb__image,
          'canonical' => $canonical,
          'focuskw' => $focus_keyword,
          'opengraph_title' => $og_title,
          'opengraph_image' => $og_image,
          'twitter_title' => $twitter_title,
          'twitter_image' => $twitter__image,
          'fb_description' => $fb_description,
          'opengraph_url' => get_permalink($postID),
          'opengraph_description' => $og_description,
          'opengraph_site_name' => get_bloginfo('name'),
          'twitter_description' => $twitter_description,
          'opengraph_type' => $this->get_og_type__custom($postObject),
          'linkdex' => get_post_meta($postID, '_yoast_wpseo_linkdex', true),
          'redirect' => get_post_meta($postID, '_yoast_wpseo_redirect', true),
          'metakeywords' => get_post_meta($postID, '_yoast_wpseo_metakeywords', true),
          'opengraph_updated_time' => get_post_modified_time('U', false, $postID, false),
          'meta_robots_adv' => get_post_meta($postID, '_yoast_wpseo_meta-robots-adv', true),
          'meta_robots_noindex' => get_post_meta($postID, '_yoast_wpseo_meta-robots-noindex', true),
          'meta_robots_nofollow' => get_post_meta($postID, '_yoast_wpseo_meta-robots-nofollow', true),
      );
      return (array) $yoastMeta;
    }

    public function get_og_type__custom($post){
      if (is_front_page() || is_home() || $post->post_name == 'homepage') {
          return 'website';
      } else {
          return 'article';
      }
    }

    /**
     * Get the query params for collections
     */
    public function get_collection_params() {
      return array(
        'page' => array(
            'default' => 1,
            'type' => 'integer',
            'sanitize_callback' => 'absint',
            'description' => 'Current page of the collection.',
        ),
        'per_page' => array(
            'default' => 10,
            'type' => 'integer',
            'sanitize_callback' => 'absint',              
            'description' => 'Maximum number of items to be returned in result set.',
        ),
      );
    }
    
    /**
     * Prepares post data for return as an object.
     */
    public function prepare_item_for_response(
      $post,
      $request,
      $bio = false,
      $content = false,
      $comments = false
    ) {
      $likes = get_field("likes" ,$post->ID);
      $data = array(
          'id' => $post->ID,
          'slug' => $post->post_name,
          'title'    => $post->post_title,
          'excerpt' => $post->post_excerpt,
          'likes' => $likes ? (int) $likes : 0,
          'subtitle' => get_field("subtitle" ,$post->ID),
          'categories' => $this->get_post_categories($post->ID),
          'date' => date( "F j, Y", strtotime($post->post_date)),
          'author' => $this->get_author_name($post->post_author, $bio),
          'featured_img' => get_the_post_thumbnail_url($post->ID, 'full'),
      );
      if($content){
        $data['content'] = $post->post_content;
      }
      if($comments){
        $data['comments'] = $this->comments_by_post($post->ID);
      }
      return $data;
    }

    /**
     * description to get the categories of the post
     */
    public function get_post_categories($postID){
      $i = 0;
      $data = array();
      $categories = get_the_category($postID);
      foreach($categories as $cat){
        if($cat->parent > 0){
          $data[$i] = $cat->cat_name;
          $i++;
        }
      }
      return $data;
    }

    /**
     * Get all comments on a post
     */
    public function comments_by_post($postID) {
      $i = 0;
      $data = array();
      $comments = get_comments(array('post_id' => $postID));
      foreach($comments as $comment) {
        $data[$i] = array(
          'id' => $comment->comment_ID,
          'name' => $comment->comment_author,
          'comment' => $comment->comment_content,
          'date' => date("F j, Y", strtotime($comment->comment_date))
        );
        $i++;
      }
      return array_reverse($data);
    }

    /**
     * Get author of post and bio of the author
     */
    public function get_author_name($postID, $get_bio = false){
      $data = get_userdata($postID);
      $val = array('name' =>  $data->data->display_name);
      if($get_bio){
        $bio = get_the_author_meta('description', $data->ID);
        $avatar = get_avatar_url($data->ID);
        $val['bio'] = $bio;
        $val['avatar'] = $avatar;
      }
      return $val;
    }
}

add_action('rest_api_init', 
  function () {
    $controller = new CodebookInc();
    $controller->register_routes();
  }
);