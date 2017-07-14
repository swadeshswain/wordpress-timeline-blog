<?php
function mtb_shortcode()
{
    echo '<div id="myTimeline" class="container">';
    $args          = get_posts(array(
        'posts_per_page' => -1, // to show all posts
        'post_type' => 'tmblog',
        'post_status' => 'publish'
    ));
    $ordered_posts = array();
    foreach ($args as $single) {
        
        $year  = mysql2date('Y', $single->post_date);
        $month = mysql2date('F', $single->post_date);
        
        // specifies the position of the current post
        $ordered_posts[$year][$month][] = $single;
        
    }
?>
<ul id="timeline-menu">  <?php
    foreach ($ordered_posts as $year => $months) {
?>
       <li><a href="#year<?php
        echo $year;
?>"><?php
        echo $year;
?></a></li>
<?php
    }
?>
     </ul>
 		 <section id="timeline">
<?php
    foreach ($ordered_posts as $year => $months) {
?>

 <div id="year<?php
        echo $year;
?>" class="group<?php
        echo $year;
?>"><?php
        echo $year;
?></div>
    <?php
        $i = 0;
        foreach ($months as $month => $posts) { // iterates the moths 
?>
          <?php
            foreach ($posts as $single) { // iterates the posts 
?>
 <?php
                if ($i % 2 === 0) {
?> <article class="animated fadeInUp"><?php
                } else {
?><article class="inverted animated fadeInUp"><?php
                }
                ;
?>
         <div class="panel">
            <div class="badge"><?php
                echo mysql2date('j', $single->post_date);
?> <?php
                echo mysql2date('M', $single->post_date);
?></div>
            <div class="panel-body">
               <h3 class="group-title"><a href="<?php
                echo get_permalink($single->ID);
?>"><?php
                echo get_the_title($single->ID);
?></a></h3>
               <span class="group-sub-title">
			     <?php
                $comments_count = wp_count_comments($single->ID);
                echo "Comments: (" . $comments_count->total_comments . ")";
?>
			   </span>
               <p> <?php
                $post_content = get_post($single->ID);
                $content      = $post_content->post_content;
                $blg_content  = do_shortcode($content);
                echo mb_strimwidth($blg_content, 0, 100, '...');
?></p>
            </div>
         </div>
      </article>
          <?php
                $i++;
            } // ends foreach $posts 
?>
    <?php
        } // ends foreach for $months 
?>

  <?php
    }
?>
     <article class="animated fadeInUp">
         <div class="panel">
            <div class="badge">&nbsp;</div>
         </div>
      </article>
      <div class="clearfix" style="float: none;"></div>
   </section>
</div>
<?php
}
add_shortcode('mtb-blog', 'mtb_shortcode');
?>