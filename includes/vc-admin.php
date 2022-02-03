<?php
if (isset($_POST['submit'])) {
  $marzo = $_POST["marzo"];
  $abril = $_POST["abril"];
  $mayo = $_POST["mayo"];
  $junio = $_POST["junio"];
  $julio = $_POST["julio"];
  $agosto = $_POST["agosto"];
  $septiembre = $_POST["septiembre"];
  $octubre = $_POST["octubre"];
  $noviembre = $_POST["noviembre"];

  global $wpbd;
  $db_table_name = $wpdb->prefix . 'vc_payment_dates';  // table name
  $wpdb->update($db_table_name, array('payment_date' => $marzo), array('month' => 'marzo'));
  $wpdb->update($db_table_name, array('payment_date' => $abril), array('month' => 'abril'));
  $wpdb->update($db_table_name, array('payment_date' => $mayo), array('month' => 'mayo'));
  $wpdb->update($db_table_name, array('payment_date' => $junio), array('month' => 'junio'));
  $wpdb->update($db_table_name, array('payment_date' => $julio), array('month' => 'julio'));
  $wpdb->update($db_table_name, array('payment_date' => $agosto), array('month' => 'agosto'));
  $wpdb->update($db_table_name, array('payment_date' => $septiembre), array('month' => 'septiembre'));
  $wpdb->update($db_table_name, array('payment_date' => $octubre), array('month' => 'octubre'));
  $wpdb->update($db_table_name, array('payment_date' => $noviembre), array('month' => 'noviembre'));
}
?>
<div class="wrap">
  <h1>PAYMENT DATES</h1>
  <p>Elija las próximas fechas de corte para facturación</p>
  <form id="myForm" name="myForm" action="<?php echo $_SERVER['PHP_SELF'] . "?page=Intermedia-Payment-Dates%2Fincludes%2Fvc-admin.php"; ?>" method="POST">
    <?php
    global $wpdb;
    $table_name = $wpdb->prefix . 'vc_payment_dates'; // nombre de la tabla
    $items = $wpdb->get_results("SELECT * FROM `$table_name`");
    //var_dump($items);
    $months_num = ['03', '04', '05', '06', '07', '08', '09', '10', '11'];
    $months_day = ['31', '30', '31', '30', '31', '31', '30', '31', '30'];
    $con = 0;
    foreach ($items as $item) {
    ?>
      <label> </label>
      <label for="<?php echo $item->month; ?>"><?php echo $item->month; ?></label>
      <br>
      <input name="<?php echo $item->month; ?>" id="<?php echo $item->month; ?>" min="<?php echo date("Y") ?>-<?php echo $months_num[$con]; ?>-01" max="<?php echo date("Y") ?>-<?php echo $months_num[$con]; ?>-<?php echo $months_day[$con]; ?>" type="date" value="<?php echo $item->payment_date; ?>">
      <br>
      <br>
    <?php
      $con += 1;
    }
    ?>
    <br>
    <br>
    <input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios">
  </form>
</div>