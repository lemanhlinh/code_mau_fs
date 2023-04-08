	<table border="1" class="tbl_form_contents" width="100%" cellspacing="4" cellpadding="4" bordercolor="#CCC">
		<thead>
			<tr>
				<th align="center" >
					<?php echo FSText::_('Màu');?>	
				</th>
				<th align="center"  >
					<?php echo FSText::_('Chọn màu');?>	
				</th>
			</tr>
		</thead>
		<tbody>
		
		<?php
			if(isset($colors) && !empty($colors)){
				foreach ($colors as $item) { 
					$checked = '';
					if(strpos($data -> colors,','.$item -> id.',')!== false ){
						$checked = 'checked';
					}

		?>
				<tr>
					<td>
						<?php echo $item -> name;?> <br />
						<?php $link_img = str_replace('/original','/small/', @$item->image);?>
						<img alt="" src="<?php echo URL_ROOT.$link_img; ?>" /><br/>
					</td>
					
					<td>
						<input type="checkbox"  value="<?php echo $item->id; ?>"  name="other_color_exit[]" id="other_color_exit<?php echo $item->id; ?>" <?php echo $checked;?>/>
						
					</td>
				</tr>
				

				<?php
				} 
			}
			?>
	</tbody>		
	</table>
	
<style>
#colorSelector {
   border: 1px solid #9F9F9F;
    display: inline-block;
    height: 16px;
    position: relative;
    width: 16px;
}
#colorSelector span {
   height: 16px;
    left: 0;
    position: absolute;
    top: 0;
    width: 16px;
}
</style>