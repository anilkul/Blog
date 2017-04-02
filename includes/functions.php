<?php
	function render()
    {
        // if view exists, render it
        // if (file_exists("includes/{$view}"))
        // {
        // 	$db           = 'db.php';
        // 	$header       = 'header.php';
        // 	$footer       = 'footer.php';
        // 	$navigation   = 'navigation.php';
        // 	$page_content = 'page_content.php';
        // 	$sidebar      = 'sidebar.php';

        // 	switch ($view) {
        // 		case $db:
        // 			$db = $new_view;
        // 			break;

        // 		case $header:
        // 			$header = $new_view;
        // 			break;

        // 		case $footer:
        // 			$footer = $new_view;
        // 			break;

        // 		case $navigation:
        // 			$navigation = $new_view;
        // 			break;

        // 		case $page_content:
        // 			$page_content = $new_view;
        // 			break;

        // 		case $sidebar:
        // 			$sidebar = $new_view;
        // 			break;
        		
        // 		default:
        			
        // 			break;
        // 	}



            // render view (between header and footer)
            // include $db;
            // include $header;
            // include $navigation;
            // include $page_content;
            // include $sidebar;
            // include $footer;
            // <?php include 'includes/db.php'; 
include 'header.php'; 

include 'navigation.php'; 


include 'page_content.php';

            
            include 'sidebar.php'; 

        
        

        

        
        include 'footer.php';
        
            
            // exit;
        // }
    }
?>