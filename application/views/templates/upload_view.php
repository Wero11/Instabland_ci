<?
/**
 * This is a bootstrapped form, you should pass along the following
 * array to this view to render it properly.
 *
 * $fields = array(
 *    array(
 *       'name' => What post variable it will return. [ex. first_name]
 *       'type' => The field type [ex. password, text, etc.]
 *       'default' => The default value for this field.
 *    )
 * )
 */
?>
<link rel="stylesheet" href="<?php echo base_url('assets/css/blueimp-gallery.min.css'); ?>">   
<link href="<?php echo base_url('assets/css/jquery.fileupload-ui.css') ?>" rel="stylesheet">
<noscript><link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.fileupload-ui-noscript.css') ?>"></noscript>

 
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo base_url('assets/js/vendor/jquery.ui.widget.js') ?>"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?php echo base_url('assets/js/tmpl.min.js'); ?>"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="<?php echo base_url('assets/js/load-image.min.js'); ?>"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="<?php echo base_url('assets/js/canvas-to-blob.min.js'); ?>"></script>
<!-- blueimp Gallery script -->
<script src="<?php echo base_url('assets/js/jquery.blueimp-gallery.min.js'); ?>"></script>

<script src="<?php echo base_url('assets/js/jquery.iframe-transport.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fileupload.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fileupload-process.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fileupload-image.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fileupload-audio.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fileupload-video.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fileupload-validate.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fileupload-ui.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/main.js'); ?>"></script>

<style>
.form-horizontal .control-group {
	margin-bottom: 12px;
}
</style>
<div style="width: 60%; margin: auto; margin-top: 80px;">
	
	<?php echo form_open_multipart(base_url().'image/upload_img', array('id' => 'fileupload')); ?>
	<!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
	<div class="row fileupload-buttonbar">
		<div class="span5">
			<!-- The fileinput-button span is used to style the file input field as button -->
			<span class="btn btn-success fileinput-button">
				<span><i class="icon-plus icon-white"></i> Add files...</span>
				<!-- Replace name of this input by userfile-->
				<input type="file" name="userfile" multiple>
			</span>

			<button type="submit" class="btn btn-primary start">
				<i class="icon-upload icon-white"></i> Start upload
			</button>

			<button type="reset" class="btn btn-warning cancel">
				<i class="icon-ban-circle icon-white"></i> Cancel upload
			</button>

			<button type="button" class="btn btn-danger delete">
				<i class="icon-trash icon-white"></i> Delete
			</button>

			<input type="checkbox" class="toggle" />
		</div>

		<div class="span3">

		<!-- The global progress bar -->
			<div class="progress progress-success progress-striped active fade">
				<div class="bar" style="width:0%;"></div>
			</div>
		</div>
	</div>
	
	<!-- The loading indicator is shown during image processing -->
	<div class="fileupload-loading"></div>
	<!-- The table listing the files available for upload/download -->
	<table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
	
	<div id="blueimp-gallery" class="blueimp-gallery blueimp-gallery-controls">
	    <div class="slides"></div>
	    <h3 class="title"></h3>
	    <a class="prev">&laquo;</a>
	    <a class="next">&raquo;</a>
	    <a class="close">&times;</a>
	    <a class="play-pause"></a>
	    <ol class="indicator"></ol>
	</div>
	
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <p class="size">{%=o.formatFileSize(file.size)%}</p>
            {% if (!o.files.error) { %}
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
            {% } %}
        </td>
        <td>
            {% if (!o.files.error && !i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start">
                    <i class="icon-upload icon-white"></i>
                    <span>Start</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        <td>
            <span class="preview">
                {% if (file.thumbnail_url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnail_url%}"></a>
                {% } %}
            </span>
        </td>
        <td>
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
                <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.delete_url) { %}
                <button class="btn btn-danger delete" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="icon-trash icon-white"></i>
                    <span>Delete</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="icon-ban-circle icon-white"></i>
                    <span>Cancel</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
	<div class="form-actions">
	   	  <a onclick="history.go(-1)" class="btn">Back</a>
		  <a href="<?=base_url();?>image/add" class="btn btn-primary">Continue Adding</a>
	      <a href="<?=base_url();?>image/index" class="btn btn-primary">Finish (To Image List)</a>
	</div>
<?php echo form_close(); ?>

<script>
	$(document).ready(function(){
		
		var Payable = 0;
		$("input[name='Payable']").val(0);
		$("input[name='Payable']").click(function(){
			if ( isRecurrent == 0 ) {
				isRecurrent = 1;
				$("input[name='Payable']").val(1);
			} else {
				isRecurrent = 0;
				$("input[name='Payable']").val(0);
			}
		});

		
		var isRecurrent = 0, isPerWeek = 0, isPerMonth = 0, isPerAnnum = 0;
		$("input[name='isRecurrent']").val(0);
		$("input[name='isPerWeek']").val(0);
		$("input[name='isPerMonth']").val(0);
		$("input[name='isPerAnnum']").val(0);
		
		$("input[name='isRecurrent']").click(function(){
			if ( isRecurrent == 0 ) {
				isRecurrent = 1;
				$("input[name='isRecurrent']").val(1);
			} else {
				isRecurrent = 0;
				$("input[name='isRecurrent']").val(0);
			}
		});

		$("input[name='isPerWeek']").click(function(){
			if ( isPerWeek == 0 ) {
				isPerWeek = 1;
				$("input[name='isPerWeek']").val(1);
			} else {
				isPerWeek = 0;
				$("input[name='isPerWeek']").val(0);
			}
		});

		$("input[name='isPerMonth']").click(function(){
			if ( isPerMonth == 0 ) {
				isPerMonth = 1;
				$("input[name='isPerMonth']").val(1);
			} else {
				isPerMonth = 0;
				$("input[name='isPerMonth']").val(0);
			}
		})

		$("input[name='isPerAnnum']").click(function(){
			if ( isPerAnnum == 0 ) {
				isPerAnnum = 1;
				$("input[name='isPerAnnum']").val(1);
			} else {
				isPerAnnum = 0;
				$("input[name='isPerAnnum']").val(0);
			}
		})
	})
</script>
