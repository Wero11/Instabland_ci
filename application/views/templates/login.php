<div style="width: 320px; margin: 0 auto;">
   <h3>Login</h3>
   <? if (!empty($error)): ?>
      <div class="alert alert-error">
         <b>Error!</b> <?= $error ?>
      </div>
   <? elseif (!empty($info)): ?>
      <div class="alert alert-info">
         <b>Info.</b> <?= $info ?>
      </div>
   <? endif; ?>
   <form class="well" method="POST" enctype="multipart/form-data" action="<?php echo base_url();?>login/check">
      <label>Email</label>
      <input type="text" name="email" style="width: 266px;" <? if (!empty($email)): ?> value="<?= $email ?>" <? endif; ?>>
      <label>Password</label>
      <input type="password" name="password" style="width: 266px;">
      <button type="submit" class="btn btn-primary">Sign In</button>
      <!--<a href="<?php echo base_url();?>signup" class="btn btn-primary" style="float: right;">Sign Up</a>-->
   </form>
</div>
