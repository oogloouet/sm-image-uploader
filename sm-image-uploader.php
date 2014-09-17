<?php
/*
 * Plugin Name:       Custom Image Uploader
 * Description:       Snippet to add native wordpress image uplaod button and dialogue box to your theme and plugins.
 * Version:           1.0.0
 * Author:            Syed Muneeb
 * Text Domain:       aa-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

add_action('admin_menu', 'sm_image_upload_register');
 
function sm_image_upload_register(){
     global $options_page;
     $options_page = add_options_page('Image Upload', 'Image Upload', 'manage_options', 'test', 'sm_image_uploader');
}

function sm_image_uploader(){ ?>

    <div>

<form action="" method="POST">

<input type="hidden" name="hidden-key" id="hidden-key" value="my-form">

<script>

$j = jQuery.noConflict();

$j(document).ready(function() {

/* user clicks button on custom field, runs below code that opens new window */

$j('#upload_image_button').click(function() {

/*Thickbox function aimed to show the media window. This function accepts three parameters:

*

* Name of the window: "In our case Upload a Image"

* URL : Executes a WordPress library that handles and validates files.

* ImageGroup : As we are not going to work with groups of images but just with one that why we set it false.

*/

tb_show('Upload Carousal Image', 'media-upload.php?referer=media_page&type=image&TB_iframe=true&post_id=0', true);

return false;

});

// window.send_to_editor(html) is how WP would normally handle the received data. It will deliver image data in HTML format, so you can put them wherever you want.

window.send_to_editor = function(html) {

var image_url = $j('img', html).attr('src');

$j('#upload_image_logo').val(image_url);

tb_remove(); // calls the tb_remove() of the Thickbox plugin

$j('#upload_image_button').trigger('click');

}

});

</script>

<div class="section">

<h3>

<?php if($current_options['upload_image_logo']!='') { $imagepath = esc_attr($current_options['upload_image_logo']); } ?>
</h3>

<input class="webriti_inpute" type="text" value="<?php echo $imagepath; ?>" id="upload_image_logo" name="upload_image_logo" size="36" class="upload has-file"/>

<input type="button" id="upload_image_button" value="Upload Image" class="upload_image_button"/>


</div>

<div id="button_section">

<input class="btn btn-primary" type="submit" value="Upload Image" name="save_media_settings" id="save_media_settings">

</div>
    
    
<?php } ?>
