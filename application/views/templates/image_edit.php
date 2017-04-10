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

<form class="form-horizontal" method="POST" action="<?=base_url().'image/update';?>">
	<h3 style="margin-left: 30px;">Image Edit</h3>
	<div class="control-group">
		<label class="control-label">Category</label>
		<div class="controls">
			<select name="category_ID">
				<?php 
					foreach ($category_list as $category) {
						if ( $category->id == $item_detail->category_ID ) {
							echo '<option value="'.$category->id.'" selected>'.$category->category_name.'</option>';
						} else {
							echo '<option value="'.$category->id.'" >'.$category->category_name.'</option>';
						}
					}	
				?>
			</select>
			<div class="help-block"></div>
		</div>
	</div>
	<? foreach ($item_detail as $key=>$value): ?>
      <? $error = form_error($key) ?>
	  <? if ( $key == 'id' || $key == 'name' ) { ?>
      <div class="control-group <? if(!empty($error)): ?>error<? endif; ?>">
      	<label class="control-label"><?php if ($key == 'id'){ echo 'ID'; } else if ($key == 'name') { echo 'Name'; } ?></label>
      	<div class="controls">
			<input class="input-xlarge" type="text" <?php if($key=='id'): echo 'readonly'; endif;?> name="<?= $key ?>" value="<? if (!empty($value)) echo $value; ?>" />  
            <div class="help-block">
               <?= $error ?>
            </div>
		</div>
      </div>
	  <?php } ?>
	<? endforeach; ?>

	<div class="form-actions">
   	  <input type="hidden" name="page" value="<?php echo $pagenum?>"/>
      <button type="submit" class="btn btn-primary">Edit</button>
   	  <a onclick="history.go(-1)" class="btn">Cancel</a>
	</div>
</form>
