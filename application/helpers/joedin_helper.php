<?php			
function input_text($nm_var,$value,$caption,$placeholder,$text){  //dipakai di isi.php pada sa
?>  

<input type="<?php echo $text; ?>" class="form-control" name="<?php echo $nm_var; ?>" id="<?php echo $nm_var; ?>" 
	<?php echo $caption; ?> value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>">
	<h6><?php echo form_error($nm_var,'<div class="text-red">', '</div>'); ?></h6>

<?php
}
function input_textcustom($nm_var,$value,$caption,$placeholder,$text){  //dipakai di isi.php pada sa
?>  

<input type="<?php echo $text; ?>" name="<?php echo $nm_var; ?>" 
	<?php echo $caption; ?> value="<?php echo $value; ?>" placeholder="<?php echo $placeholder; ?>">
	<h6><?php echo form_error($nm_var,'<div class="text-red">', '</div>'); ?></h6>

<?php
}
function input_textarea($nm_var,$value,$caption,$placeholder){  //dipakai di isi.php pada sa
?>  
	<textarea class="form-control" <?php echo $caption; ?> placeholder="<?php echo $placeholder; ?>"
		name="<?php echo $nm_var; ?>" id="<?php echo $nm_var; ?>"><?php echo $value; ?></textarea>
	<h6><?php echo form_error($nm_var,'<div class="text-red">', '</div>'); ?></h6>

<?php
}
function input_textareacustom($nm_var,$value,$caption,$placeholder){  //dipakai di isi.php pada sa
?>  
	<textarea <?php echo $caption; ?> placeholder="<?php echo $placeholder; ?>"
		name="<?php echo $nm_var; ?>" ><?php echo $value; ?></textarea>
	<h6><?php echo form_error($nm_var,'<div class="text-red">', '</div>'); ?></h6>

<?php
}
function input_pd($nm_var,$isipd,$selected){ 
?>  

  <?php echo 
	form_dropdown(array("name"=>$nm_var, "class"=>"form-control", "options"=>$isipd, "id"=>$nm_var, "selected"=>$selected, 'style="width: 100%;"'));
	//form_dropdown($nm_var,$isipd,$def,array('class'=>'form-control')); 
  ?>
  <h6><?php echo form_error($nm_var,'<div class="text-red">', '</div>'); ?></h6>      

<?php 
}  
function input_pdnoclassnoid($nm_var,$isipd,$selected,$caption,$id,$class){ 
?>  

  <?php echo 
	form_dropdown(array("name"=>$nm_var, "class"=>$class, $caption, "id"=>$id, "options"=>$isipd, "selected"=>$selected));
	//form_dropdown($nm_var,$isipd,$def,array('class'=>'form-control')); 
  ?>
  <h6><?php echo form_error($nm_var,'<div class="text-red">', '</div>'); ?></h6>      

<?php 
} 
function input_pdcustom($nm_var,$isipd,$selected,$caption){ 
?>  

  <?php echo 
	form_dropdown(array("name"=>$nm_var, "class"=>"form-control select2", $caption, "id"=>$nm_var, "options"=>$isipd, "selected"=>$selected));
	//form_dropdown($nm_var,$isipd,$def,array('class'=>'form-control')); 
  ?>
  <h6><?php echo form_error($nm_var,'<div class="text-red">', '</div>'); ?></h6>      

<?php 
}  
/*function input_pdselect2($nm_var,$isipd,$selected){ 
 echo form_dropdown(array("name"=>$nm_var, "class"=>"form-control select2", "id"=>$nm_var, "options"=>$isipd, "selected"=>$selected));
}  */
function input_pdselect2url($id_var,$nm_var,$class,$caption,$text){ 
?>  
<select id="<?php echo $id_var; ?>" name="<?php echo $nm_var; ?>" <?php echo $caption; ?> class="<?php echo $class; ?>"><option value=""><?php echo $text; ?></option></select>
<?php 
} 
function input_pdselect2urlfleksibel($id_var,$nm_var,$class,$caption,$foreach,$id,$name,$selected,$text){ 
?>  
<select id="<?php echo $id_var; ?>" name="<?php echo $nm_var; ?>" <?php echo $caption; ?> class="<?php echo $class; ?>"><option value=""><?php echo $text; ?></option>
	<?php foreach($foreach as $row){
		$terpilih = ($row[$id] == $selected) ? 'selected' : ''; // bikin kondisi kaya gini
	?>
	<option value="<?php echo $row[$id];?>" <?php echo $terpilih; ?> ><?php echo $row[$name];?></option>
	<?php } ?>
</select>
<?php 
} 
function input_pdselect2fleksibel($id_var,$nm_var,$foreach,$id,$name,$selected,$text){ 
?>  
<select class="form-control select2" id="<?php echo $id_var; ?>" name="<?php echo $nm_var; ?>" >
	<option value="0"><?php echo $text; ?></option>
	<?php foreach($foreach as $row){
		$terpilih = ($row[$id] == $selected) ? 'selected' : ''; // bikin kondisi kaya gini
	?>
	<option value="<?php echo $row[$id];?>" <?php echo $terpilih; ?> ><?php echo $row[$name];?></option>
	<?php } ?>
</select>
<?php 
}  
function input_calendar($id_var,$nm_var,$value,$caption,$required){ 
?>
  <div class="input-group date" id="tgl">
	<div class="input-group-addon">
	  <i class="fa fa-calendar"></i>
	</div>
	<input type="text" id="<?php echo $id_var; ?>" name="<?php echo $nm_var; ?>" <?php echo $caption; ?> value="<?php echo $value; ?>" <?php echo $required; ?> class='form-control'>
  </div>
<?php
/*     var valid = $('.main').toArray().every(function(item) {
        return $(item).find('input[type="checkbox"]:checked').length >= 1;
    }); */
}
function input_mask_date($nm_var,$value,$caption,$required){ 
?>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
      </div>
      <input type="text" class="form-control" name="<?php echo $nm_var; ?>" <?php echo $caption; ?> value="<?php echo $value; ?>" <?php echo $required; ?> data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-mask>
    </div>
<?php
}
function input_pdselect23($id_var,$nm_var,$foreach,$id,$name,$selected){ 
?>  
	  <select class="form-control select2bs4"  id="<?php echo $id_var; ?>" name="<?php echo $nm_var; ?>" style="width: 100%;">
			<?php foreach($foreach as $row){
				$terpilih = ($row[$id] == $selected) ? 'selected' : ''; // bikin kondisi kaya gini
			?>
			<option value="<?php echo $row[$id];?>" <?php echo $terpilih; ?> ><?php echo $row[$name];?></option>
			<?php } ?>
	  </select>
<?php 
}  
function input_pdselect23fleksibel($id_var,$nm_var,$foreach,$id,$name,$selected,$text){ 
?>  
	  <select class="form-control select2bs4"  id="<?php echo $id_var; ?>" name="<?php echo $nm_var; ?>" style="width: 100%;">
	  <option value="0"><?php echo $text; ?></option>
			<?php foreach($foreach as $row){
				$terpilih = ($row[$id] == $selected) ? 'selected' : ''; // bikin kondisi kaya gini
			?>
			<option value="<?php echo $row[$id];?>" <?php echo $terpilih; ?> ><?php echo $row[$name];?></option>
			<?php } ?>
	  </select>
<?php 
}
function input_pdselect3array($id_var,$nm_var,$foreach,$selected){ 
?>  
	  <select class="form-control select2bs4"  id="<?php echo $id_var; ?>" name="<?php echo $nm_var; ?>" style="width: 100%;">
			<?php foreach($foreach as $key => $value){?>
			<option value="<?php echo $key; ?>"  <?=($value == $selected ? "selected" : "" )?> ><?php echo $value; ?></option>
			<?php } ?>
	  </select>
<?php 
} 
function checkboxflatred($id_var,$nm_var,$foreach,$id,$name,$selected,$type,$br,$free=FALSE,$array=FALSE){ 
	echo '<div class="main">';
	foreach($foreach as $row){
		if(!$array){
			$terpilih = ($row[$id] == $selected) ? 'checked' : ''; // bikin kondisi kaya gini
		}else{
			if(in_array($row[$id],explode(",", $selected))){ 
				$terpilih = 'checked'; 
				}else{ 
				$terpilih = '';
				}
		}
?>
	<label>
	  <input type="checkbox" class="<?php echo $type; ?>" name="<?php echo $nm_var; ?>" id="<?php echo $id_var; ?>" value="<?php echo $row[$id];?>" <?php echo $terpilih; ?> <?php echo $free; ?> >&nbsp; <?php echo $row[$name];?>
	</label><?php echo $br; ?>
<?php
	}
	echo '</div>';
}