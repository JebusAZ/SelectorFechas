<?php
/*
Plugin Name: Intermedia Payment Dates
Description: Publica las fechas de pago para el periodo en curso
Version: 1.2
Author: Intermedia Digital Studio
Author URI: https://www.intermediastudios.com.mx
*/

//SHORTCODE #1 | [limit_date_es] | DESC. Muestra la fecha de pago limite para los expositores.
#APROBADO

defined('ABSPATH') or die('Direct script access disallowed.');
require_once plugin_dir_path(__FILE__) . 'includes/functions.php';

function add_table_payment()
{
    global $wpdb, $name, $date;
    $name = 'marzo';
    $date = '2022/01/01';
    $test_db_version = '1.0.0';
    $db_table_name = $wpdb->prefix . 'vc_payment_dates';  // table name
    $charset_collate = $wpdb->get_charset_collate();

    //CREAR TABLA SI NO EXISTE
    if ($wpdb->get_var("show tables like '$db_table_name'") != $db_table_name) {
        $sql = "CREATE TABLE $db_table_name (
                id int(11) NOT NULL auto_increment,
                month varchar(15) NOT NULL,
                payment_date date NOT NULL,
                UNIQUE KEY id (id)
        ) $charset_collate;";
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
        $months = ['marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'septiembre', 'octubre', 'noviembre'];
        for($i = 0; $i < 9; $i++){
            $name = $months[$i];
            $date = date("Y")."/0".($i+3)."/15";
            $wpdb->insert($db_table_name, array('month' => $name, 'payment_date' => $date) );
        }
        add_option('test_db_version', $test_db_version);
    }
}

register_activation_hook(__FILE__, 'add_table_payment');

add_shortcode('limit_date_es', function () {
    setlocale(LC_TIME, "spanish");
    $default_atts = array();
    $args = shortcode_atts($default_atts, $atts);
    //$post_date = get_the_date( 'yy/m/d' );
    $post_date = "2022/07/01";
    //$post_date = date('Y/m/d'); //Fecha actual, no del post
    $mypost_date = strtotime($post_date);
    global $wpdb;
    $table_name = $wpdb->prefix . 'vc_payment_dates'; // nombre de la tabla
    $items = $wpdb->get_results("SELECT * FROM `$table_name`");
    $arr_of_values = array_values($items);
    $mydate3 = strtotime($items[0]->payment_date);
    $mydate4 = strtotime($items[1]->payment_date);
    $mydate5 = strtotime($items[2]->payment_date);
    $mydate6 = strtotime($items[3]->payment_date);
    $mydate7 = strtotime($items[4]->payment_date);
    $mydate8 = strtotime($items[5]->payment_date);
    $mydate9 = strtotime($items[6]->payment_date);
    $mydate10 = strtotime($items[7]->payment_date);
    $mydate11 = strtotime($items[9]->payment_date);

    if ($mypost_date <= $mydate3) {
        $newDate = date("d-m-Y", $mydate3);
        $mesDesc = strftime("%d de %B de %Y", strtotime($newDate));
        $display = $mesDesc;
        //$display = "15 de Marzo de 2022";
    } else if ($mypost_date > $mydate3 && $mypost_date <= $mydate4) {
        $newDate = date("d-m-Y", $mydate4);
        $mesDesc = strftime("%d de %B de %Y", strtotime($newDate));
        $display = $mesDesc;
    } else if ($mypost_date > $mydate4 && $mypost_date <= $mydate5) {
        $newDate = date("d-m-Y", $mydate5);
        $mesDesc = strftime("%d de %B de %Y", strtotime($newDate));
        $display = $mesDesc;
    } else if ($mypost_date > $mydate5 && $mypost_date <= $mydate6) {
        $newDate = date("d-m-Y", $mydate6);
        $mesDesc = strftime("%d de %B de %Y", strtotime($newDate));
        $display = $mesDesc;
    } else if ($mypost_date > $mydate6 && $mypost_date <= $mydate7) {
        $newDate = date("d-m-Y", $mydate7);
        $mesDesc = strftime("%d de %B de %Y", strtotime($newDate));
        $display = $mesDesc;
    } else if ($mypost_date > $mydate7 && $mypost_date <= $mydate8) {
        $newDate = date("d-m-Y", $mydate8);
        $mesDesc = strftime("%d de %B de %Y", strtotime($newDate));
        $display = $mesDesc;
    } else if ($mypost_date > $mydate8 && $mypost_date <= $mydate9) {
        $newDate = date("d-m-Y", $mydate9);
        $mesDesc = strftime("%d de %B de %Y", strtotime($newDate));
        $display = $mesDesc;
    } else if ($mypost_date > $mydate9 && $mypost_date <= $mydate10) {
        $newDate = date("d-m-Y", $mydate10);
        $mesDesc = strftime("%d de %B de %Y", strtotime($newDate));
        $display = $mesDesc;
    } else if ($mypost_date > $mydate10 && $mypost_date <= $mydate11) {
        $newDate = date("d-m-Y", $mydate11);
        $mesDesc = strftime("%d de %B de %Y", strtotime($newDate));
        $display = $mesDesc;
    }
    return '<B> FECHA DE PRÓXIMO CORTE: </B>' . $display ;
});
