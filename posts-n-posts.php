<?php
/*
	Plugin Name: Posts in Posts
	Plugin URI: http://wolfiezero.com/wordpress/posts-in-posts/
	Version: 0.6
	Description: Grabs posts based on tag, category or just recent, and display them inline with a post
	Author: WolfieZero
	Author URI: http://wolfiezero.com/
	License: GPLv3 or later
*/

#
#  posts-n-posts.php
#
#  Created by Neil Sweeney on 06-03-2011.
#  Copyright 2011, Neil Sweeney. All rights reserved.
#
#  This program is free software: you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation, either version 3 of the License, or
#  (at your option) any later version.
#
#  You may obtain a copy of the License at:
#  http://www.gnu.org/licenses/gpl-3.0.txt
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.


add_shortcode('posts', 'showPosts');
add_shortcode('showposts', 'showPosts');

/**
 * Shows recent posts in Wordpress with given arguments
 *
 * @param array $args
 *
 * @return string
 */
function showPosts($args) {

	$a = shortcode_atts(array(
		'type'	=> null,
		'name'	=> null,
		'limit'	=> 5,
		'date'	=> null,
	), $args);
	
	$a['type'] = strtolower($a['type']);
	
	$argsRecent = array(
		'numberposts'		=> $a['limit'],
		'offset'			=> 0,
		'category'			=> null,
		'orderby'			=> 'post_date',
		'order'				=> 'DESC',
		'include'			=> null,
		'exclude'			=> null,
		'meta_key'			=> null,
		'meta_value'		=> null,
		'post_type'			=> 'post',
		'post_status'		=> 'publish',
		'suppress_filters'	=> true 
	);
	
	
	if($a['type'] === 'category' || $a['type'] === 'cat') {
		
		$argsRecent['category']	= get_cat_ID($a['name']);
		$posts = wp_get_recent_posts($argsRecent);
		
	} elseif($a['type'] === 'tag') {
		
		global $wpdb;
		
		// I've not sussed out an affective way to grab post using the tag name so this is the best option
		$sqlTag = '
			SELECT
				wp_term_relationships.object_id
				
			FROM
				wp_terms
				
			INNER JOIN
				wp_term_taxonomy 		ON wp_terms.term_id = wp_term_taxonomy.term_id
			INNER JOIN
				wp_term_relationships	ON wp_term_taxonomy.term_taxonomy_id = wp_term_relationships.term_taxonomy_id
				
			WHERE
				wp_terms.name				= "'.$a['name'].'" AND
				wp_term_taxonomy.taxonomy	= "post_tag"
				
			LIMIT '.$a['limit'].'
		';
		
		$postIDs = $wpdb->get_results($sqlTag);
		
		foreach($postIDs as $postID){
			$posts[] = get_post($postID->object_id, 'ARRAY_A');
		}

		
		
	} else {	// type == recent - error check
	
		$posts = wp_get_recent_posts($argsRecent);
		
	}
	
	
	// Check we have posts
	if(count($posts) > 0) {

		$html = '<ul>';
		
		// Loop through each result
		foreach($posts as $post) {
			$html .=	'<li>';
			$html .=		'<a href="'.$post['guid'].'">'.$post['post_title'].'</a>';
			if($a['date']){
				$html .= ' - '.date($a['date'], strtotime($post['post_date']));
			}
			$html .=	'</li>';
		}
		
		$html .= '</ul>';
	}
	
	return $html;
}

?>