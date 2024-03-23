<?php
/**
* Plugin Name: Certificate Verify
* Plugin URI: https://abcd.com
* Description: This plugin is used to verify the certificate of a company, employee etc.
* Version: 0.1
* Author: Hemant Bhatta
* Author URI: https://hemantbhatta.com.np
*/
if(!defined('ABSPATH')){
    die();
}
if(!defined('CV_plugins_url')){
    define('CV_plugins_url', plugins_url());
}
if (!class_exists('CertificateVerify')) {

    class CertificateVerify {

        function __construct(){
            $this->registerhooks();

            add_action('admin_menu',array($this, 'cvr_main_menu'));
            add_action( 'admin_enqueue_scripts', array($this, 'cvr_certify_admin_script') );
            
            add_action( 'wp_enqueue_scripts', array($this,'cvr_certify_scripts' ));
        }


        function cvr_certify_scripts(){



        }


        function cvr_certify_admin_script(){

            wp_enqueue_style('cvr-style', plugins_url().'/certificate-verify/assets/cvr_style.css', '', 0.1, 'all');

            wp_enqueue_style('cvr-bootstrap-css', plugins_url().'/certificate-verify/assets/bootstrap.min.css', '', 0.1, 'all');

            wp_enqueue_script('cvr-bootstrap-js', plugins_url().'/certificate-verify/assets/bootstrap.bundle.min.js', '', 0.1, 'all');
            
        }


        function cvr_main_menu(){
            add_menu_page(

                'Certificate Verify',
                'Certificate Verify',
                'manage_options',
                'certificate-verify', 
                null, 
                'dashicons-businessman',
                99

            );

            add_submenu_page(

                'certificate-verify', 
                'Certificate Verify',
                'Certificate Verify',
                'manage_options',
                'certificate-verify', 
                array( $this, 'certificate_verify_menu_page_callback' )

            );
        }


        function certificate_verify_menu_page_callback(){


            global $wpdb;
            $table_name = $wpdb->prefix.'cert_verify';


            if( $_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['add_employee'])){
                if(!wp_verify_nonce($_POST['nonce_field_name'], 'nonce_field_key')){

                    echo 'Verification failed, please try again';
                    return '';
                }


                if(!empty($_POST['emp_name']) && !empty($_POST['training_program']  && !empty($_POST['certificate_id'])
                && !empty($_POST['date_of_birth']) && !empty($_POST['start_date']) && !empty($_POST['end_date']) )){
                    var_dump($_POST);
                    $name = sanitize_text_field($_POST['emp_name']);
                    $training_program = sanitize_text_field($_POST['training_program']);
                    $certificate_id = sanitize_text_field($_POST['certificate_id']);
                    $date_of_birth = sanitize_text_field($_POST['date_of_birth']);
                    $start_date = sanitize_text_field($_POST['start_date']);
                    $end_date = sanitize_text_field($_POST['end_date']);

     
                    $wpdb->insert(
                     $table_name,
                     array(
                         'name' => $name ,
                         'training_program' => $training_program,
                         'certificate_id' => $certificate_id,
                         'date_of_birth' => $date_of_birth,
                         'start_date' => $start_date,
                         'end_date' => $end_date

                     )
                 );
                }

                else{
                    echo 'values cannot be empty';
                }


            


            }
            $totalresults = $wpdb->get_results( "SELECT * FROM $table_name" );
            ?>
           <div>
            <form method="POST">
                <?php  wp_nonce_field('nonce_field_key', 'nonce_field_name') ?>
                <input type="text" name="emp_name" id="emp_name" placeholder="enter your name">
                <input type="text" name="training_program" id="training_program" placeholder="enter your training_program">
                <input type="text" name="certificate_id" id="certificate_id" placeholder="enter your certificate_id">
                <input type="text" name="date_of_birth" id="date_of_birth" placeholder="enter your date_of_birth">
                <input type="text" name="start_date" id="start_date" placeholder="enter your start_date">
                <input type="text" name="end_date" id="end_date" placeholder="enter your end_date">

                


<div class="container">

<div class="row">

<div class="mb-3 col-4">
    <label for="emp_name" class="form-label">Employee Name</label>
    <input type="text" class="form-control" id="emp_name" name="emp_name" aria-describedby="emp_name">
    <div id="emp_name" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3 col-4" >
    <label for="training_program" class="form-label">Training Program</label>
    <input type="text" class="form-control" id="training_program" aria-describedby="training_program">
    <div id="training_program" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3 col-4">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3 col-4">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3 col-4">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3 col-4">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

</div>

</div>
  



  <input class="btn btn-primary" type="submit" value="Submit" name="add_employee">
        </form>
        </div>

<?php 

    foreach ( $totalresults as $result ) {
        echo 'name:'.$result->name . ' training_program ' . $result->training_program . '<br>';
    }
?>


    <?php     }

        function cvr_table_creation(){


           

            global $wpdb;
            $charset_collate = $wpdb->get_charset_collate();

            $table_name = $wpdb->prefix.'cert_verify';
            // wp_die('okay db created');
            $create_table_query =  "CREATE TABLE $table_name (
                id mediumint(9) NOT NULL AUTO_INCREMENT,
                name varchar(55) NOT NULL,
                training_program text NOT NULL,
                certificate_id varchar(55) DEFAULT '' NOT NULL,
                date_of_birth varchar(55) DEFAULT '' NOT NULL,
                start_date varchar(55) DEFAULT '' NOT NULL,
                end_date varchar(55) DEFAULT '' NOT NULL,
                time datetime DEFAULT CURRENT_TIMESTAMP NOT NULL,
                PRIMARY KEY  (id)
            ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($create_table_query);

        }


        function cvr_table_deletion(){

            global $wpdb;

            $table_name = $wpdb->prefix . 'cert_verify';

            $wpdb->query( "DROP TABLE IF EXISTS $table_name" );

        }

        public function registerhooks(){
            register_activation_hook(plugin_basename(__FILE__), array($this, 'cvr_table_creation'));
            register_deactivation_hook(plugin_basename(__FILE__), array($this, 'cvr_table_deletion'));
        }     






    }

}
$verify_cert  = new CertificateVerify();