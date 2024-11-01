<?php
/*
  Plugin Name: WPCF7 Anti-spam
  Description: Works with Contact Form 7 Plugin
  Author: Pawruol
  Version: 1.0
 */

function wpcf7_antispam_register_settings() {
    /* Collector options */
    add_option( 'wpcf7_antispam_pass', '');
    add_option( 'wpcf7_antispam_hash', '');
    add_option( 'wpcf7_antispam_collector', '');
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_pass', 'myplugin_callback' );
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_hash', 'myplugin_callback' );
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_collector', 'myplugin_callback' );

    /* Mail options */
    add_option( 'wpcf7_antispam_mail_smtp_host', '');
    add_option( 'wpcf7_antispam_mail_smtp_port', '');
    add_option( 'wpcf7_antispam_mail_smtp_login', '');
    add_option( 'wpcf7_antispam_mail_smtp_pass', '');
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_mail_smtp_host', 'myplugin_callback' );
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_mail_smtp_port', 'myplugin_callback' );
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_mail_smtp_login', 'myplugin_callback' );
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_mail_smtp_pass', 'myplugin_callback' );

    add_option( 'wpcf7_antispam_mail_sender', '');
    add_option( 'wpcf7_antispam_mail_recipient', '');
    add_option( 'wpcf7_antispam_mail_cc', '');
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_mail_sender', 'myplugin_callback' );
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_mail_recipient', 'myplugin_callback' );
    register_setting( 'wpcf7_antispam_options_group', 'wpcf7_antispam_mail_cc', 'myplugin_callback' );
}
add_action( 'admin_init', 'wpcf7_antispam_register_settings' );

function wpcf7_antispam_register_options_page() {
    add_options_page('WPCF7 Anti-spam', 'WPCF7 Anti-spam', 'manage_options', 'wpcf7_antispam', 'wpcf7_antispam_options_page');
}
add_action('admin_menu', 'wpcf7_antispam_register_options_page');

function wpcf7_antispam_options_page() {
    ?>
  <div>
      <?php screen_icon(); ?>
    <h2>WPCF7 Anti-spam Settings</h2>
    <form method="post" action="options.php">
        <?php settings_fields( 'wpcf7_antispam_options_group' ); ?>
      <h3>Instructions</h3>
      <p>Supported form fields names:</p>
      <ul>
        <li>first_name || name</li>
        <li>last_name</li>
        <li>email</li>
        <li>phone</li>
        <li>message</li>
      </ul>

      <div style="display: inline-block;
    position: relative;
    box-sizing: content-box;
    vertical-align: top;
    margin-right: 25px;">
      <h3>Collector options</h3>
      <p>If you want send data from "Contact Form 7" plugin form to collector,<br> please fill values:</p>
      <table>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_pass">Password</label></th>
          <td><input type="text" id="wpcf7_antispam_pass" name="wpcf7_antispam_pass" value="<?php echo get_option('wpcf7_antispam_pass'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_hash">Hash</label></th>
          <td><input type="text" id="wpcf7_antispam_hash" name="wpcf7_antispam_hash" value="<?php echo get_option('wpcf7_antispam_hash'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_collector">Collector Url</label></th>
          <td><input type="text" id="wpcf7_antispam_collector" name="wpcf7_antispam_collector" value="<?php echo get_option('wpcf7_antispam_collector'); ?>" /></td>
        </tr>
      </table>
      <h3>Mail options</h3>
      <p>Please set mail address parameters:</p>
      <table>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_mail_sender">Sender</label></th>
          <td><input type="text" id="wpcf7_antispam_mail_sender" name="wpcf7_antispam_mail_sender" value="<?php echo get_option('wpcf7_antispam_mail_sender'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_mail_recipient">Recipient</label></th>
          <td><input type="text" id="wpcf7_antispam_mail_recipient" name="wpcf7_antispam_mail_recipient" value="<?php echo get_option('wpcf7_antispam_mail_recipient'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_mail_cc">CC (carbon copy)</label></th>
          <td><input type="text" id="wpcf7_antispam_mail_cc" name="wpcf7_antispam_mail_cc" value="<?php echo get_option('wpcf7_antispam_mail_cc'); ?>" /></td>
        </tr>
      </table>
      </div>

      <div style="display: inline-block;
    position: relative;
    box-sizing: border-box;
    vertical-align: top;">
      <h3>SMTP options</h3>
      <p>Please set credentials:</p>
      <table>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_mail_smtp_host">SMTP Host</label></th>
          <td><input type="text" id="wpcf7_antispam_mail_smtp_host" name="wpcf7_antispam_mail_smtp_host" value="<?php echo get_option('wpcf7_antispam_mail_smtp_host'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_mail_smtp_port">SMTP Port</label></th>
          <td><input type="text" id="wpcf7_antispam_mail_smtp_port" name="wpcf7_antispam_mail_smtp_port" value="<?php echo get_option('wpcf7_antispam_mail_smtp_port'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_mail_smtp_login">SMTP Username</label></th>
          <td><input type="text" id="wpcf7_antispam_mail_smtp_login" name="wpcf7_antispam_mail_smtp_login" value="<?php echo get_option('wpcf7_antispam_mail_smtp_login'); ?>" /></td>
        </tr>
        <tr valign="top">
          <th scope="row"><label for="wpcf7_antispam_mail_smtp_pass">SMTP Password</label></th>
          <td><input type="text" id="wpcf7_antispam_mail_smtp_pass" name="wpcf7_antispam_mail_smtp_pass" value="<?php echo get_option('wpcf7_antispam_mail_smtp_pass'); ?>" /></td>
        </tr>
      </table>
      </div>
        <?php submit_button(); ?>
    </form>
  </div>
    <?php
}

add_action('wp_enqueue_scripts','wpcf7_ant_script_init');
function wpcf7_ant_script_init() {
    wp_enqueue_script( 'ant-script',plugins_url('/js/script.js',__FILE__));
}

function wpcf7_get_current_page() {
    $pageURL = $_SERVER['HTTP_REFERER'];

    return $pageURL;
}

function wpcf7_get_client_data() {
    $user_info['user_agent_raw'] = $_SERVER['HTTP_USER_AGENT'];

    return $user_info;
}

function wpcf7_get_geo_data() {
    if ($_SERVER['HTTP_CLIENT_IP'])
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if($_SERVER['HTTP_X_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if($_SERVER['HTTP_X_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if($_SERVER['HTTP_FORWARDED_FOR'])
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if($_SERVER['HTTP_FORWARDED'])
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if($_SERVER['REMOTE_ADDR'])
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';


    $response  = wp_remote_get( "http://ipinfo.io/{$ipaddress}" );

    if (
        'OK' !== wp_remote_retrieve_response_message( $response )
        OR 200 !== wp_remote_retrieve_response_code( $response )
    )
        wp_send_json_error( $response );

    $json = wp_remote_retrieve_body( $response );

//    $json = file_get_contents("http://ipinfo.io/{$ipaddress}");
    $usr_location1 = json_decode($json);
    $address = array(
        'ip' => $ipaddress
    );
    $address['city'] = isset($usr_location1->city)?$usr_location1->city:'';
    $address['state'] = isset($usr_location1->region)?$usr_location1->region:'';
    $address['country'] = isset($usr_location1->country)?$usr_location1->country:'';
    $usr_location2 = null;
    foreach ($address as $item => $value) {
        if(empty($value)){
            if(empty($usr_location2)){

                $response  = wp_remote_get( "http://api.db-ip.com/v2/e59af6bf0eb4d01964b4afadbebaaf41067e16a5/{$ipaddress}" );

                if (
                    'OK' !== wp_remote_retrieve_response_message( $response )
                    OR 200 !== wp_remote_retrieve_response_code( $response )
                )
                    wp_send_json_error( $response );

                $json = wp_remote_retrieve_body( $response );

                $usr_location2 = json_decode($json);
            }
            $newVal = '';
            switch($item){
                case 'state':
                    $newVal = $usr_location2 -> stateProv;
                    break;
                case 'city':
                    $newVal = $usr_location2 -> city;
                    break;
                case 'country':
                    $newVal = $usr_location2 -> countryCode;
                    break;
            }
            $address[$item] = $newVal;
        }
    }

    return $address;
}

function wpcf7_send_lead_to_collector($url, $data=array()) {
    $fields_string = '';
    foreach($data as $key=>$value) {
        $fields_string .= $key.'='.urlencode($value).'&';
    }
    rtrim($fields_string, '&');

    $args = array(
        'body'    => $fields_string,
    );

    if (get_option('wpcf7_antispam_collector') == '') {
        return 'Error: Please fill collector link.';
    }

    $response = wp_remote_post($url, $args);

    if ( is_wp_error( $response ) ) {
        $error_message = $response->get_error_message();
        echo "Error: $error_message";
    }

    return $response;
}

add_action('phpmailer_init','wpcf7_send_smtp_email');
function wpcf7_send_smtp_email( $phpmailer ) {
    $phpmailer->isSMTP();
    $phpmailer->Host = get_option('wpcf7_antispam_mail_smtp_host');
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = get_option('wpcf7_antispam_mail_smtp_port');
    $phpmailer->Username = get_option('wpcf7_antispam_mail_smtp_login');
    $phpmailer->Password = get_option('wpcf7_antispam_mail_smtp_pass');
    $phpmailer->From = get_option('wpcf7_antispam_mail_sender');
    $info = wpcf7_get_post_info();
    if ( strlen( $info['from_name'] ) > 0 ) $phpmailer->FromName = $info['from_name'];
    $data = array();
    $geo = wpcf7_get_geo_data();
    /* COLLECTOR CREDENTIALS */
    $data['pass'] = get_option('wpcf7_antispam_pass');
    $data['hash'] = get_option('wpcf7_antispam_hash');
    /* DATA TO SEND */
    $data['first_name'] = sanitize_text_field(isset($_POST['first_name'])?$_POST['first_name']:$_POST['name']);
    $data['last_name'] = sanitize_text_field($_POST['last_name']);
    $data['email'] = sanitize_email($_POST['email']);
    $data['phone'] = sanitize_text_field($_POST['phone']);
    $data['ip'] = $geo['ip'];
    $data['city'] = $geo['city'];
    $data['state'] = $geo['state'];

    $data['country'] = $geo['country'];
    $data['description'] = sanitize_textarea_field($_POST['message']);
    $data['lead_source_url'] = wpcf7_get_current_page();
    $data['user_agent'] = wpcf7_get_client_data()['user_agent_raw'];
    /* ANTISPAM INDICATORS */
    $hiddenFieldName = '_weight_i';
    $cookieName = '_gag';
    if(isset($_POST[$hiddenFieldName])  && (sanitize_text_field($_POST[$hiddenFieldName]) != '')) {
        $data['spam'] = true;
        $data['spam_reason'] = 'Empty field not clear';
    }
    if(!isset($_COOKIE[$cookieName])) {
        $data['spam'] = true;
        $data['spam_reason'] = 'Cookie is not defined';
    }


    /* SEND DATA TO COLLECTOR */
    $result = wpcf7_send_lead_to_collector(get_option('wpcf7_antispam_collector'), $data);
}

function wpcf7_check_for_spam( $wpcf7 ) {
    $data = WPCF7_Submission::get_instance()->get_posted_data();
    $cookieName = '_gag';
    $hiddenFieldName = '_weight_i';
    if(!isset($_COOKIE[$cookieName])){
        $wpcf7->spam_reason = "cookie {$cookieName} does not exist";
        return true;
    }
    if( isset($data[$hiddenFieldName]) && ($data[$hiddenFieldName] != '')) {
        $wpcf7->spam_reason = "hidden {$hiddenFieldName} does not exist";
        return true;
    }

    return false;
}

add_action( 'wpcf7_before_send_mail', 'wpcf7_check_mail', 1 );
function wpcf7_check_mail( $WPCF7_ContactForm ) {
    global $wpdb;

    $wpcf7 = WPCF7_ContactForm :: get_current() ;
    $submission = WPCF7_Submission :: get_instance() ;
    if ($submission)
    {
        $info = wpcf7_get_post_info();
        $posted_data = $submission->get_posted_data() ;

        if ( empty ($posted_data))
            return ;

        $subject = "NEW LEAD";
        if ( wpcf7_check_for_spam( $wpcf7 ) ) {
            $subject = 'SPAM';
        }

        $mail = $WPCF7_ContactForm->prop('mail') ;
        $mail['subject'] = $subject;
        $mail['recipient'] = get_option('wpcf7_antispam_mail_recipient');
        $mail['sender'] = $info['first_name'] . ' <' . get_option('wpcf7_antispam_mail_sender') . '>';
        $cclist = get_option('wpcf7_antispam_mail_cc');
        $mail['additional_headers'] = "Cc: $cclist";
        $wpdb->address = $address = wpcf7_get_geo_data();
        $content = $info['message'];
        $content .= PHP_EOL . 'ip = ' . $address['ip'] . ' country = ' . $address['country'] . ' state=' . $address['state'] . ' city=' . $address['city'] . PHP_EOL;
        file_put_contents( __DIR__ . '/debug.txt', $content );

        $WPCF7_ContactForm->set_properties( array("mail" => $mail)) ;
        return $WPCF7_ContactForm ;
    }
}

function wpcf7_get_post_info() {
    $fn = array( 'first_name', 'last_name', 'email', 'phone', 'message' );
    $content = file_get_contents( __DIR__ . '/debug.txt' );
    $from_name = '';
    foreach ( $fn as $name ) {
        if (  sanitize_text_field($_POST[$name]) ) {
            $content .= $name . ' : ' . sanitize_text_field($_POST[$name]) . ', ';
            if ( preg_match( '/name/i', $name ) ) {
                $from_name = sanitize_text_field($_POST[$name]);
            }
        }
    }

    return array( 'content' => $content, 'from_name' => $from_name );
}

add_filter( 'wpcf7_special_mail_tags', 'wpcf7_special_mail_tag_userdata', 10, 2 );
function wpcf7_special_mail_tag_userdata( $output, $name ) {
    global $wpdb;
    $name = preg_replace( '/^wpcf7\./', '_', $name );
    $address = $wpdb->address;
    if ( '_date' == $name ) {
        $output = date_i18n( get_option( 'date_format' ) );
    } elseif ( '_time' == $name ) {
        $output = date_i18n( get_option( 'time_format' ) );
    } elseif ('_city' == $name) {
        $output = $address['city'];
    } elseif ('_state' == $name) {
        $output = $address['state'];
    } elseif ( '_url' == $name ) {
        $output = ( ( !empty( $_SERVER['HTTPS'] ) ) ? $_SERVER['HTTPS'] : 'http' ) . '://' . $_SERVER['SERVER_NAME'];
    } elseif ( '_ip' == $name ) {
        $output = $address['ip'];
    } elseif ( '_source_page' == $name ) {
        $output = $_SERVER['HTTP_REFERER'];
    }

    return $output;
}