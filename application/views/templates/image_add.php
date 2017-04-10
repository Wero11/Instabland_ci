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
	<h3 style="margin-left: 30px;">Image Add</h3>       
	<form id="addons" class="form-horizontal" method="POST" action="<?=base_url().'image/save';?>" accept-charset="utf-8" enctype="multipart/form-data">
		<div class="control-group">
			<label class="control-label">Category</label>
			<div class="controls">
				<select name="category_ID">
					<?php 
						foreach ($category_list as $category) {
							echo '<option value="'.$category->id.'">'.$category->category_name.'</option>';
						}	
					?>
				</select>
				<div class="help-block"></div>
			</div>
		</div>
		
		<div class="control-group ">
			<label class="control-label">Image Name</label>
	        <div class="controls">
				<input class="input-xlarge" type="text" name="name" value="" />
	            <div class="help-block"></div>
			</div>
	    </div>		
		
	   <div class="form-actions">
	   	  <button type="submit" class="btn btn-primary">Add</button>
	   	  <a onclick="history.go(-1)" class="btn">Cancel</a>
	   </div>
	</form>
</div>
