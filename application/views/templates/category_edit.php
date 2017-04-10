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

<form class="form-horizontal" method="POST" action="<?=base_url().'category/update';?>">
	<h3 style="margin-left: 30px;">Category Edit</h3>
   <? foreach ($item_detail as $key=>$value): ?>
      <? $error = form_error($key) ?>
      <div class="control-group <? if(!empty($error)): ?>error<? endif; ?>">
      	<label class="control-label"><?= $key ?></label>
      	<div class="controls">
			<input class="input-xlarge" type="text" <?php if($key=='id'): echo 'readonly'; endif;?> name="<?= $key ?>" value="<? if (!empty($value)) echo $value; ?>" />   
            <div class="help-block">
               <?= $error ?>
            </div>
		</div>
      </div>
   <? endforeach; ?>

   <div class="form-actions">
   	  <input type="hidden" name="page" value="<?php echo $pagenum?>"/>
      <button type="submit" class="btn btn-primary">Edit</button>
   	  <a onclick="history.go(-1)" class="btn">Cancel</a>
   </div>
</form>