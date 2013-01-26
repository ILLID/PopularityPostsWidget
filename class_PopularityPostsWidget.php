<?php

class PopularityPostsWidget extends WP_Widget {
	public function PopularityPostsWidget() {
		$widget_ops = array( 'classname' => 'popularitypostswidget', 'description' => __('Displays popularitypostswidget block at sidebar.', 'popularity_posts_widget') );
		$control_ops = array( 'width' => 200, 'height' => 250, 'id_base' => 'popularitypostswidget' );
		parent::__construct( 'popularitypostswidget', 'PopularityPostsWidget', $widget_ops, $control_ops );
	}
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	public function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : "Popularity Posts Widget";
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$posts_title_length = isset($instance['posts_title_length']) ? $instance['posts_title_length'] : 60;
		
		?>
		
		<p>
		<label for=" <?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'popularity_posts_widget'); ?></label><br>
		<input type="text" style="width:100%" id="<?php echo $this->get_field_id('title'); ?>" 
		name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $title; ?>">
		</p>
		
		<p>
		<label for=" <?php echo $this->get_field_id('range'); ?>"><?php _e('Condition:', 'popularity_posts_widget'); ?></label><br>	
		<select style="width:100%" id="<?php echo $this->get_field_id('range'); ?>"
		name="<?php echo $this->get_field_name('range'); ?>" value="<?php $instance['range']; ?>" >
			<option value="range_alltime" <?php if ($instance['range'] === 'range_alltime') echo "selected"; ?>><?php _e('Total views', 'popularity_posts_widget'); ?>
			<option value="range_today" <?php if ($instance['range'] === 'range_today') echo "selected"; ?>><?php _e('Views today', 'popularity_posts_widget'); ?>
			<option value="range_last7days" <?php if ($instance['range'] === 'range_last7days') echo "selected"; ?>><?php _e('Views last 7 days', 'popularity_posts_widget'); ?>
			<option value="range_last30days" <?php if ($instance['range'] === 'range_last30days') echo "selected"; ?>><?php _e('Views last 30 days', 'popularity_posts_widget'); ?>
		</select>	
		</p>
		
		<p>
		<label for=" <?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts:', 'popularity_posts_widget'); ?></label><br>	
		<input type="text" style="width:100px" id="<?php echo $this->get_field_id('number'); ?>"
		name="<?php echo $this->get_field_name('number'); ?>" value="<?php echo $number; ?>">
		</p>
		
		
		
		<p>
		<label for="<?php echo $this->get_field_id('posts_title_length'); ?>"><?php _e('Post title length:', 'popularity_posts_widget'); ?></label><br>
		<input type="text" style="width:100px" id="<?php echo $this->get_field_id('posts_title_length'); ?>" 
		name="<?php echo $this->get_field_name('posts_title_length'); ?>" value="<?php echo $posts_title_length; ?>">
		</p>
		
		<input type="hidden" id="<?php echo $this->get_field_id('hidden'); ?>" 
		name="<?php echo $this->get_field_name('hidden'); ?>" value="<?php echo 'true'; ?>">
		
		<fieldset style="border:1px solid #cccccc; padding:5px;">
		<legend><?php _e('Display Settings', 'popularity_posts_widget'); ?></legend>
		<p style="margin-bottom:1px;">
		<input type="checkbox" name="<?php echo $this->get_field_name('views_checkbox'); ?>"
		id = "<?php echo $this->get_field_id('views_checkbox'); ?>" value = "yes" <?php if ( ($instance['views_checkbox']) || (!$instance['hidden']) ) echo "checked"; ?>>
		<label for=" <?php echo $this->get_field_id('views_checkbox'); ?>"><?php _e('Show views?', 'popularity_posts_widget'); ?></label> 		
		</p>
		
		<p style="margin-bottom:1px;">
		<input type="checkbox" name="<?php echo $this->get_field_name('comment_checkbox'); ?>"
		id = "<?php echo $this->get_field_id('comment_checkbox'); ?>" value = "yes" <?php if ($instance['comment_checkbox'] || (!$instance['hidden']) ) echo "checked"; ?>>
		<label for=" <?php echo $this->get_field_id('comment_checkbox'); ?>"><?php _e('Show comments?', 'popularity_posts_widget'); ?></label> 		
		</p>
		
		<p style="margin-bottom:3px;">
		<input type="checkbox" name="<?php echo $this->get_field_name('date_checkbox'); ?>"
		id = "<?php echo $this->get_field_id('date_checkbox'); ?>" value = "yes" <?php if ($instance['date_checkbox'] || (!$instance['hidden']) ) echo "checked"; ?>>
		<label for=" <?php echo $this->get_field_id('date_checkbox'); ?>"><?php _e('Show date?', 'popularity_posts_widget'); ?></label> 		
		</p>
		
	
		
		<?php
		if ($instance['date_checkbox'] || !$instance['hidden']) {
		?>
		
		<fieldset style="border:1px solid #cccccc; padding:5px;">
		<legend><?php _e('Date Format', 'popularity_posts_widget'); ?></legend>
		<p style="margin-bottom:3px;">	
		<select style="width:120px" id="<?php echo $this->get_field_id('date_format'); ?>"
		name="<?php echo $this->get_field_name('date_format'); ?>" value="<?php $instance['date_format']; ?>" >
			<option value="format_one" <?php if ($instance['date_format'] === 'format_one') echo "selected"; ?>><?php echo date('M d, Y'); ?>
			<option value="format_two" <?php if ($instance['date_format'] === 'format_two') echo "selected"; ?>><?php echo date('Y/m/d'); ?>
			<option value="format_three" <?php if ($instance['date_format'] === 'format_three') echo "selected"; ?>><?php echo date('m/d/Y'); ?>
			<option value="format_foure" <?php if ($instance['date_format'] === 'format_foure') echo "selected"; ?>><?php echo date('d/m/Y'); ?>
		</select>	
		</p>
		</fieldset>
		
		<?php
		}
		?>
		
		
		</fieldset>
		
		<fieldset style="border:1px solid #cccccc; padding:5px; margin-top: 10px;">
		<legend><?php _e('Filter Settings', 'popularity_posts_widget'); ?></legend>
		<p style="margin-bottom:3px;">
		<input type="checkbox" name="<?php echo $this->get_field_name('show_cat'); ?>"
		id = "<?php echo $this->get_field_id('show_cat'); ?>" value = "yes" <?php if ($instance['show_cat']) echo "checked"; ?>>
		<label for=" <?php echo $this->get_field_id('show_cat'); ?>"><?php _e('Turn ON categories filter', 'popularity_posts_widget'); ?></label> 		
		</p>
		
		<?php
		if ($instance['show_cat']) {
		
		global $wpdb;
		$table_name = $wpdb->prefix . "terms";
		$rows = $wpdb->get_results("SELECT * FROM wp_terms");
			echo '<fieldset style="border:1px solid #cccccc; padding:5px; margin-top: 5px;">';
			echo '<legend>';
			_e('Select needed categories', 'popularity_posts_widget');
			echo '</legend>';
			foreach ($rows as $row) {
			?>	
			
			
			<p style="margin-bottom:1px;" >
			<input type="checkbox" name="<?php echo $this->get_field_name($row->name); ?>"
			id = "<?php echo $this->get_field_id($row->name); ?>" value = <?php echo $row->term_id; ?> <?php if($instance[$row->name]) echo "checked"; ?>>
			<label for=" <?php echo $this->get_field_id($row->name); ?>"><?php echo $row->name; ?></label> 		
			</p>
			
			
			<?php
			}
			echo "</fieldset>";
		}
		?>
		</fieldset>
		
		<?php				
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	public function widget ($args , $instance) {
		extract($args);
		$title = empty($instance['title']) ? "" : $instance['title'];
		$number = empty($instance['number']) ? 5 : $instance['number'];
		$posts_title_length = empty($instance['posts_title_length']) ? 40 : $instance['posts_title_length'];
		
		$show_comments = $instance['comment_checkbox'] ? true : false;
		$show_views = $instance['views_checkbox'] ? true : false;
		$show_date = $instance['date_checkbox'] ? true : false;
		
		if ( ($show_comments || $show_views) && $show_date) { $date_pref = " | ";}
		else {$date_pref = ""; }
		
		if ($show_views && $show_comments) { $com_pref = " | ";}
		else {$com_pref = ""; }
		
		if ($instance['show_cat']) {
			global $wpdb;
			$table_name_terms = $wpdb->prefix . "terms";
			$table_name_relation = $wpdb->prefix . "term_relationships";
			$rows_catties = $wpdb->get_results("SELECT ".$table_name_terms.".term_id, ".$table_name_terms.".name, ".$table_name_relation.".object_id, ".$table_name_relation.".term_taxonomy_id
				                               FROM ".$table_name_terms." LEFT JOIN ".$table_name_relation."
											   ON ".$table_name_relation.".term_taxonomy_id=".$table_name_terms.".term_id
											   ");
			foreach($rows_catties as $row_catties)	{
					if (isset($instance[$row_catties->name])) {
					$res = $res." id=".$row_catties->object_id." OR";
				}
			}	
			$res = substr($res, 0, strlen($res)-2);	
			
			if ($instance['range'] === "range_alltime") {
				$cat_res = ' WHERE '.$res;
			} elseif ($instance['range'] === "range_last7days" || $instance['range'] === "range_last30days" ) {
				$cat_res = ' AND ('.$res.') '; 
			} else {
				$cat_res = ' '; 
			}
		}

		global $wpdb;
		$table_name = $wpdb->prefix . "PopularityPostsWidget";
		$table_name_cache = $wpdb->prefix . "PopularityPostsWidgetCache";
		
		if ($instance['range'] === "range_alltime" ) {
			$rows = $wpdb->get_results("SELECT * FROM " . $table_name . " ".$cat_res." ORDER BY hits DESC LIMIT " . $number, ARRAY_A);
		} elseif ($instance['range'] === "range_today") {
			$rows = $wpdb->get_results("SELECT * FROM " . $table_name_cache . " WHERE date=CURDATE() ".$cat_res." ORDER BY hits DESC LIMIT " . $number, ARRAY_A);
		} elseif ($instance['range'] === "range_last7days" || $instance['range'] === "range_last30days") {
			if ($instance['range'] === "range_last7days") $num_days = 7;
			if ($instance['range'] === "range_last30days") $num_days = 30;
			$rows = $wpdb->get_results("SELECT id, SUM(hits) FROM " . $table_name_cache . " WHERE date > DATE_SUB(CURDATE(), INTERVAL ".$num_days." DAY) ".$cat_res." GROUP BY id ORDER BY SUM(hits) DESC LIMIT " . $number, ARRAY_A);
		} 
		
		echo $before_widget;
		if ($title) echo $before_title . $title . $after_title;
		echo "<ul>";
		
		//Loop 
		foreach ($rows as $row) {
			
			$title_posts=get_the_title($row['id']);
			$permalink=get_permalink($row['id']);
			
			if ($instance['range'] === "range_alltime" || $instance['range'] === "range_today" ) {
				$hits=$row['hits'];
			}    else {
				$hits=$row['SUM(hits)'];
			}      
			  
			$hits_to_show = $show_views ? 'Views ('.$hits.') ' : "";
			$comments_to_show = $show_comments ? 'Comments ('.ppw_get_ComCount($row['id']).')': "";   
		?>
			 <li>
			<span class="ppw-post-title"><a href="<?php echo $permalink; ?>"	title="<?php echo $title_posts; ?>" rel="<?php echo 'nofollow'; ?>"><?php echo ppw_get_TrimTitle($title_posts, $posts_title_length); ?></a></span>
			<span class="post-stats">
			<?php 
			
			echo '<br>';
			echo '<span class="ppw-views">'.$hits_to_show.'</span>'.$com_pref.'<span class="ppw-comments">'.$comments_to_show.'</span>'; 
			echo '<span class="ppw-date">'.$date_pref.ppw_get_PostDate($row['id'], $show_date, $instance['date_format'] ).'</span>';
			
			?>
			</span>
			</li>
			
        <?php
		
		}
		echo "</ul>";
		echo $after_widget;	
	}
	
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	
	public function update ($new_instance , $old_instance) {
		$instance = $new_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['posts_title_length'] = (int) $new_instance['posts_title_length'];
		return $instance;
	}
}

?>