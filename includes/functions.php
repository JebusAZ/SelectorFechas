<?php
/*
 * Add my new menu to the Admin Control Panel
 */
// Add a new top level menu link to the ACP

// Hook the 'admin_menu' action hook, run the function named 'vc_Add_My_Admin_Link()'
add_action('admin_menu', 'vc_Add_My_Admin_Link');

function vc_Add_My_Admin_Link()
{
    add_menu_page(
        'Payment Dates', // Title of the page
        'Payment Dates', // Text to show on the menu link
        'manage_options', // Capability requirement to see the link
        'Intermedia-Payment-Dates/includes/vc-admin.php' // The 'slug' - file to display when clicking the link
    );
}

