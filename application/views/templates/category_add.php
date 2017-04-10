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

<div>
	<h3 style="margin-left: 30px;">Category Add</h3>       
	<form id="addons" class="form-horizontal" method="POST" action="<?=base_url().'category/save';?>" accept-charset="utf-8" enctype="multipart/form-data">
		<div class="control-group ">
			<label class="control-label">Addons Name</label>
	        <div class="controls">
				<input class="input-xlarge" type="text" name="category_name" value="">
	            <div class="help-block"></div>
			</div>
		</div>
	    
		<div class="form-actions">
			<button type="submit" class="btn btn-primary">Add</button>
			<a onclick="history.go(-1)" class="btn">Cancel</a>
		</div>
	</form>
</div>