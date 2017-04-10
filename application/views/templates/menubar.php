<div class="subnav" style="margin-bottom: 10px;">
   <ul class="nav nav-pills">
	  <?php if ($admin): ?><li <? if($current_view=="category_view"): ?>class="active"<? endif; ?>><a href="<?= base_url().'category' ?>"><i class="icon-tags icon-large"></i>&nbsp;Category</a></li><? endif; ?>
      <?php if ($admin): ?><li <? if($current_view=="image_view"): ?>class="active"<? endif; ?>><a href="<?= base_url().'image' ?>"><i class="icon-gift icon-large"></i>&nbsp;Images</a></li><? endif; ?>
	  <li <? if($current_view=="gallery_view"): ?>class="active"<? endif; ?>><a href="<?= base_url().'gallery' ?>"><i class="icon-picture icon-large"></i>&nbsp;Gallery</a></li>
      <?php if ($admin): ?><li <? if($current_view=="user_view"): ?>class="active"<? endif; ?>><a href="<?= base_url().'user' ?>"><i class="icon-group icon-large"></i>&nbsp;Users</a></li><? endif; ?>
      <ul class="nav nav-pills pull-right">
         
         <li class="dropdown">
	         <a class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cogs icon-large"></i>&nbsp;Settings<b class="caret"></b></a>
	         <ul class="dropdown-menu" style="min-width: 100%;">
	               <li><a href="<?= base_url().'user/mine' ?>">My Account</a></li>
	               <li><a href="<?= base_url() ?>">Log out</a></li>
	         </ul>
	      </li> 
      </ul>
   </ul>
</div>
