
<link href="<?php echo base_url('assets/css/jquery.fancybox.css') ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/js/jquery-migrate-1.2.1.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fancybox.pack.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/app-fancy.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/gallery.js'); ?>"></script>

<div class="content">
	<div style="margin: 6px 0">
	<?php if ($admin) { ?>
		<a class="btn btn-success" href="<?php echo base_url();?>image/add"><i class="icon-plus-sign-alt icon-large"></i> Add New Image</a>
	<?php } ?>
		<a class="btn btn-success btn-toggle-search"><i class="icon-plus icon-large"></i> Toggle Search</a>
		<div class="searchform">
			<form method="POST" action="<?=base_url().'gallery/index';?>">
				<div class="float-control-group">
					<label class="control-label">Image Name</label>
			        <input type="text" style="width: 150px;" name="name" value="<?php echo isset($search['name']) ? $search['name']:'';?>">
			    </div>
				<div class="float-control-group">
					<label class="control-label">Category</label>
			        <select name="category_ID">
			        	<option value=""> --- All --- </option>
						<?php 
							foreach ($category_list as $category) {
								echo '<option value="'.$category->id.'">'.$category->category_name.'</option>';
							}	
						?>
			        </select>
			    </div>
			    <div class="float-control-group control-action">
			   	  <button type="submit" class="btn btn-success"><i class="icon-search icon-large"></i> Search</button>
			    </div>
			    <div style="clear:both;"></div>
			</form>
		</div>
	</div>
	<div class="top-pagenate"><?php echo $links;?></div>
	<div style="margin: 36px 0;">
	<?php 
		if (!empty($gallery_list)) {
			$i = 0;
	    	foreach ($gallery_list as $index=>$row) { 
				
				$category_name = '';
				foreach ($category_list as $category) {
					if ($category->id == $row->category_ID) {
						$category_name = $category->category_name;
					}
				}	

				if ( $i % 6 == 0 && $i != 0 ) { ?>
					</div>
					<div class="space10"></div>
				<?php } ?>
				<?php if ( $i % 6 == 0 || $i == 0 ) { ?>
					<div class="row-fluid">
				<?php } ?>
						<div class="span2">
							<div class="item">
								<a class="fancybox-button" data-rel="fancybox-button" title="<?php echo $row->name.' ('.$category_name.')'; ?>" href="<?php echo $row->image_URL; ?>">
									<div class="zoom">
										<img src="<?php echo $row->image_URL; ?>" alt="<?php echo $row->name; ?>" />                            
										<div class="zoom-icon"></div>
									</div>
								</a>
							</div>							
						</div>
			
		<?php $i++; 
			} ?>
			</div>
			<div class="space10"></div>
	<?php 		
		} else {
   	?>
	   	  		<div class="span3">There is no data.</div>
	   <?php } ?>
	</div>
	<div class="bottom-pagenate"><?php echo $links;?></div>
</div>
<script>
	jQuery(document).ready(function() {       
	   // initiate layout and plugins
	   App.init();
	   Gallery.init();
	   $('.fancybox-video').fancybox({type: 'iframe'});
	});
</script>