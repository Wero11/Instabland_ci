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

<form class="form-horizontal" method="POST" action="<?=base_url().'user/update';?>">
	<div class="control-group ">
		<label class="control-label">ID</label>
        <div class="controls">
			<input class="input-xlarge" type="text" name="id" value="<?php echo $item_detail->id;?>" readonly />
            <div class="help-block"></div>
		</div>
    </div>
	<div class="control-group ">
		<label class="control-label">User ID</label>
        <div class="controls">
			<input class="input-xlarge" type="text" name="userID" value="<?php echo $item_detail->userID;?>" />
            <div class="help-block"></div>
		</div>
    </div>
	<div class="control-group ">
		<label class="control-label">E-mail</label>
        <div class="controls">
			<input class="input-xlarge" type="email" name="email" value="<?php echo $item_detail->email;?>" />
            <div class="help-block"></div>
		</div>
    </div>
    <div class="control-group ">
      	<label class="control-label">Password</label>
        <div class="controls">
			<input class="input-xlarge" type="password" name="password" value="" />
            <div class="help-block"></div>
		</div>
    </div>
    <div class="control-group ">
      	<label class="control-label">isAdmin</label>
        <div class="controls">
			<input class="input-xlarge" type="checkbox" name="isAdmin" value="<?php echo $item_detail->isAdmin;?>" <?php if ($item_detail->isAdmin) echo 'checked'; ?> />
            <div class="help-block"></div>
		</div>
    </div>
    
   <div class="form-actions">
   	  <input type="hidden" name="page" value="<?php echo $pagenum?>">
      <button type="submit" class="btn btn-primary">Edit</button>
   	  <a onclick="history.go(-1)" class="btn">Cancel</a>
   </div>
</form>

<script>
	$(document).ready(function(){

		$("input[name='isAdmin']").click(function(){
			if ( $("input[name='isAdmin']").val() == 0 ) {
				$("input[name='isAdmin']").val(1);
			} else {
				$("input[name='isAdmin']").val(0);
			}
		});
		
		/* $("input[name='isApproved']").click(function(){
			if ( $("input[name='isApproved']").val() == 0 ) {
				$("input[name='isApproved']").val(1);
			} else {
				$("input[name='isApproved']").val(0);
			}
		}) */
	})
</script>