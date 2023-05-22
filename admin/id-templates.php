<?php 
include_once('main_head.php');
include_once('header.php');
include_once('sidebar.php'); 
?>

<div class="content-wrapper">
    <title> ID Templates</title>
    
    <section class="content-header">
    	<h1>
        	ID Templates
        	<small>Preview</small>
        </h1>
        <ol class="breadcrumb">
        	<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">ID Templates</a></li>
    	</ol>
	</section>
    <hr>
    <section class="content">
		<div class="text-center">
			<h3><b>LIST OF ID TEMPLATES</b></h3>
		</div>

		<div class="text-center">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#idModal"><i class="fa fa-plus"> Create New Templates</i></button>
		</div>
		<hr>
		<div class="container col-md-12">
			<div class="row">
				<?php 
				$sql = "SELECT * FROM id_format ORDER BY Name ASC";
				$result = mysqli_query($con, $sql);
				while ($row = mysqli_fetch_assoc($result)):
					$image = $row['ID_Format'];
				?>
				<div class="form-group col-md-3">
					<div class="card">
						<div class="card-body text-center">
							<img src="../assets/id-format/<?=$image?>" class="img-size">
						</div>

						<div class="card-footer text-center">
						<h4 class="card-title"><?php echo $row['Name']?></h4>
						<button class="btn btn-info"><i class="fa fa-edit" aria-hidden="true"></i></button>
						<button class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
				<?php endwhile ?>

			</div>
		</div>
		
		
		

    </section>

</div>
<?php include_once 'footer.php'; ?>

<div class="modal fade" id="idModal" tabindex="" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg" modal-dialog-scrollable role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="close">
        <i class="fa fa-times" aria-hidden="true"></i>
        </button>
        <h4 class="modal-title"> New ID Templates</h4>
      </div>
        <div class="modal-body">
            <form action="" method="POST" id="template-form">
				<div class="row">
					<div class="col-md-4">
						<button type="button" value="home" class="form-control btn btn-info" id="home" >Home</button>
					</div>

					<div class="col-md-4">
						<button type="button" value="textfield" class="form-control btn btn-info" id="textfield">Add Text Field</button>
					</div>

					<div class="col-md-4">
						<button type="button" value="imagefield" class="form-control btn btn-info" id="imagefield" >Add Image Field</button>
					</div>
					
				</div>
				<hr>
                <div class="row">
                    <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
					<input type="hidden" name="template_image">
					<textarea class="hide" name="template_code"></textarea>

                    <div class="col-md-4" id="forms">
                        <label for="">Template Name:</label>
                        <input type="text" name="name" required id="name" class="form-control"><br>

                        <h5>Base Size [Inches]</h5>
                        <label for="">Height:</label>
                        <input type="number" step=".1" name="height" id="height" value="3.5" class="form-control">

                        <label for="">Width:</label>
                        <input type="number" step=".1" name="width" id="width" value="2.5" class="form-control">
                        <label for="">_______________________________________</label>

                        <label for="">Backgroup Image:</label>
                        <input type="file" name="img_src" style="" onchange="displayImg(this,$(this))" 
                        class="form-control">

                        <label for="">_______________________________________</label>
                            
                    </div>

					<div class="col-md-4">
						<div id="text-field"></div>
						<div id="image-field"></div>
					</div>

                    <div class="col-md-8" id="bg"><?php if(!isset($template_code)):?><div id="id-card-field" style="" class='border border-dark'></div>
					<?php 
						else: 
							echo $template_code;
						?>
						<?php endif;?>
						
                    </div>

					

                </div>

                <?php if(isset($template_code)):
			    echo '<script> $(function (){ data_func(); })</script>';
			    endif; ?>

                <div class="modal-footer">
                        <button class="btn btn-success" id="save"><i class="fa fa-floppy-o" aria-hidden="true"> Save</i></button>
                        <button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"> Close</i></button>
                </div>
                   
            </form>
        </div>
  </div>
</div>

<div id="align-text-clone" class="d-none">
	<select name="text_align" class="custom-select custom-select-sm">
		<option value="left">Left</option>
		<option value="right">Right</option>
		<option value="center">Center</option>
	</select>
</div>

<script>
    
	$(function(){
		$('[name="height"],[name="width"]').keyup(function(){
			var height = $('[name="height"]').val();
			var width = $('[name="width"]').val();
			$('#id-card-field').css({height:height+'in',width:width+'in'})
		})
	})
    
    function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
				var _base64, type;
				var data = e.target.result
					data = data.split(';base64,')
	        	$('#id-card-field').css({'background': 'url('+(e.target.result)+')','background-repeat':'no-repeat','background-size':'cover'});
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}

    $(function(){
		$('#textfield').click(function(){
			var _ft = $('#textfield').val()
			var _this = $(this)
				show_form(_ft,_this)
		})
	})

	$(function(){
		$('#imagefield').click(function(){
			var _ft = $('#imagefield').val()
			var _this = $(this)
				show_form(_ft,_this)
		})
	})

	$(function(){
		$('#home').click(function(){
			var _ft = $('#home').val()
			var _this = $(this)
				show_form(_ft,_this)
		})
	})

    function show_form(_ft,_this,__id = ''){

       if(_ft == 'textfield'){
			$("#forms").hide();
			$("#image-field").hide();
			$("#text-field").show();
			var id = (__id != "" ? __id :"TextField"+ ($('#id-card-field .field-item').length + 1))
			var fg = $("<div class='form-group form-item' data-id='"+id+"'>")
			var _title = id;
			var input;
			fg.append("<label class='control-label'><a class='badge badge-danger remove_field' data-id='"+id+"'> Remove</a></label>")
			// Field ID NAME
			input = $("<div class='row'>")
			input.find('input').val(id)
			fg.append(input)
			// TExt
			input.append('<div class="col-md-6"><label for="">Text</label><input class="form-control" style="" name="text_value" data-id="'+id+'"/></div>')
			// Font Color
			input.append('<div class="col-md-6"><label>Font Color</label><input class="form-control colorpicker1" type="color" name="font_color" data-id="'+id+'"/></div>')
			// font style
			input.append('<div class="col-md-6"><label>Font Style</label><br><input type="checkbox" name="style" value="bold" data-id="'+id+'"/> <b>Bold</b></label> | <input type="checkbox" class="mr-2" value="italic" name="style" data-id="'+id+'"/> <i><b>Italic</b></i></div>')
			
            // font size
			input.append('<div class="col-md-6"><label>Font Size</label><input type="number" class="form-control" name="size" data-id="'+id+'"/></div>')
           
            // width
			input.append('<div class="col-md-6"><label>Width</label><input class="form-control" type="number" name="size1[]" data-size="width" data-id="'+id+'"/></div>')

			// text-align
			input.append('<div class="col-md-6"><label>Align Text</label><select name="text_align" class="form-control"><option value="left">Left</option><option value="right">Right</option><option value="center">Center</option></select></div>')
			
			// Borders
			input.append('<div class="col-md-6"><label>Border</label><br><b><input type="checkbox" value="top" name="border" data-id="'+id+'"/> Top</label> | <input type="checkbox" value="bottom" name="border" data-id="'+id+'"/> Bottom <br><input type="checkbox" value="left" name="border" data-id="'+id+'"/> Left | <input type="checkbox" value="right" name="border" data-id="'+id+'"/> Right</b></div>')
			
            // Border Color
			input.append('<div class="col-md-6"><label>Border Color</label><input type="color" class="form-control" name="border_color" data-id="'+id+'"/></div>')

			input.append('<div class="col-md-12"><label>Position</label><input class="form-control" type="number" step=".1" name="position1[]" data-pos="top" data-id="'+id+'"/>Top (%)</div>')
			input.append('<div class="col-md-12"><input class="form-control" type="number" step=".1" name="position1[]" data-pos="left" data-id="'+id+'"/>Left (%)</div>')
			input.append('<div class="col-md-12"><p>_______________________________________</p></div>')
			fg.append(input)
			is_form_exists = $("#text-field .form-item[data-id='"+id+"']").length;
			if(__id == "" || (__id != "" && is_form_exists <= 0))
			$("#text-field").html(fg);
			if(__id != ""){
				$('[name="font_color"]').val(_this.css('color')).trigger('change')
				if(_this.css('font-weight') > 400)
				$('input[name="style"][value="bold"]').attr('checked',true)
				if(_this.css('font-style') == "italic")
				$('input[name="style"][value="italic"]').attr('checked',true)
				if(_this.css('border-top').includes("px solid") == true)
					$('input[name="border"][value="top"]').attr('checked',true)
				if(_this.css('border-bottom').includes("px solid") == true)
					$('input[name="border"][value="bottom"]').attr('checked',true)
				if(_this.css('border-left').includes("px solid") == true)
					$('input[name="border"][value="left"]').attr('checked',true)
				if(_this.css('border-right').includes("px solid") == true)
					$('input[name="border"][value="right"]').attr('checked',true)
				$('[name="border_color"]').val(_this.css('border-color')).trigger('change')

                $('[name="size"]').val(_this.css('font-size')).trigger('change')

				if(_this.css('text-align') != "")
					$('[name="text_align"]').val(_this.css('text-align')).trigger('change')
				$('[name="text_value"]').val(_this.text())

				var parent = _this.parent()
					var pos = {};
					var nt ,nl;
					style =_this.attr('style')
					style = style.replace(/ /g,'')
					style = style.split(";")
					Object.keys(style).map(element=>{
						if(style[element] != ''){
							prop = style[element].split(':')
							prop1 = prop[0];
							prop2 = !!prop[1] ? prop[1] : '';
							pos[prop1] = prop2
						}
					})
					var left = !!pos.left ? (pos.left).replace("%",'') : 0;
					var top = !!pos.top ? (pos.top).replace("%",'') : 0;
					nt = top
					nl = left
					$('input[name="position1[]"][data-pos="top"]').val(nt).trigger("change")
					$('input[name="position1[]"][data-pos="left"]').val(nl).trigger("change")
					$('input[name="size1[]"][data-size="width"]').val(width).trigger("change")
			}

			// field Item
			var item = $('<div class="field-item" data-type="'+_ft+'">');
				item.attr('id', id)
				item.text(id)
			if(__id == ''){
				$('#id-card-field').append(item);
			}
			data_func();
		} if(_ft == 'imagefield'){
			$("#forms").hide();
			$("#text-field").hide();
			$("#image-field").show();
            var id = (__id != "" ? __id :"ImageField"+ ($('#id-card-field .field-item').length + 1))
			var fg = $("<div class='form-group pb-1 mb-1 border-bottom border-dark form-item' data-id='"+id+"'>")
			var _title = id;
			var input;
			fg.append("<label class='control-label'><a class='badge badge-danger remove_field' data-id='"+id+"'> Remove</a></label>")
			// Field ID NAME
			input = $("<div class='row'>")
			input.find('input').val(id)
			fg.append(input)
			// File input
			input.append('<div class="col-md-12"><label>Image</label><input type="file" class="form-control form-control-sm rounded-0 col-7" name="filename" data-id="'+id+'"/></div>')

            // Element Size
            
			input.append('<div class="col-md-6"><label>Image Height</label><input class="form-control" type="number" name="size[]" data-size="height" data-id="'+id+'"/><label class="col-4">Height (%)</label></div>')
			input.append('<div class="col-md-6"><label>Image Width</label><input class="form-control" type="number" name="size[]" data-size="width" data-id="'+id+'"/><label class="col-4">Width (%)</label></div>')
            
            // Borders
			input.append('<div class="col-md-12"><label>Border</label><br><b><input type="checkbox" value="top" name="border" data-id="'+id+'"/> Top</label> | <input type="checkbox" value="bottom" name="border" data-id="'+id+'"/> bottom | <input type="checkbox" value="left" name="border" data-id="'+id+'"/> Left | <input type="checkbox" value="right" name="border" data-id="'+id+'"/> Right</b></div>')
            
            // Border Color
            input.append('<div class="col-md-12"><label>Border Color</label><input type="color" class="form-control" name="border_color" data-id="'+id+'"/></div>')

            input.append('<div class="col-md-12"><label>Position</label><input class="form-control" type="number" step=".1" name="position[]" data-pos="top" data-id="'+id+'"/>Top (%)</div>')
			input.append('<div class="col-md-12"><input class="form-control" type="number" step=".1" name="position[]" data-pos="left" data-id="'+id+'"/>Left (%)</div>')
            input.append('<div class="col-md-12"><p>_______________________________________</p></div>')
            
            fg.append(input);
            is_form_exists = $("#image-field .form-item[data-id='"+id+"']").length;
			if(__id == "" || (__id != "" && is_form_exists <= 0))
			$("#image-field").html(fg);

            if(__id != ""){
                $('[name="font_color"]').val(_this.css('color')).trigger('change')
				if(_this.css('font-weight') > 400)
				$('input[name="style"][value="bold"]').attr('checked',true)
				if(_this.css('font-style') == "italic")
				$('input[name="style"][value="italic"]').attr('checked',true)
				if(_this.css('border-top').includes("px solid") == true)
					$('input[name="border"][value="top"]').attr('checked',true)
				if(_this.css('border-bottom').includes("px solid") == true)
					$('input[name="border"][value="bottom"]').attr('checked',true)
				if(_this.css('border-left').includes("px solid") == true)
					$('input[name="border"][value="left"]').attr('checked',true)
				if(_this.css('border-right').includes("px solid") == true)
					$('input[name="border"][value="right"]').attr('checked',true)
				$('[name="border_color"]').val(_this.css('border-color')).trigger('change')

                var parent = _this.parent()
					var pos = {};
					var nt ,nl;
					style =_this.attr('style')
					if(style !== undefined ){
					style = style.replace(/ /g,'')
					style = style.split(";")
					Object.keys(style).map(k=>{
						if(style[k] != ''){
							prop = style[k].split(':')
							prop1 = prop[0];
							prop2 = !!prop[1] ? prop[1] : '';
							pos[prop1] = prop2
						}
					})
					var left = !!pos.left ? (pos.left).replace("%",'') : 0;
					var top = !!pos.top ? (pos.top).replace("%",'') : 0;
					var height = !!pos.height ? (pos.height).replace("%",'') : 0;
					var width = !!pos.width ? (pos.width).replace("%",'') : 0;
					nt = top
					nl = left
					$('input[name="position[]"][data-pos="top"]').val(nt).trigger("change")
					$('input[name="position[]"][data-pos="left"]').val(nl).trigger("change")
					$('input[name="size[]"][data-size="height"]').val(height).trigger("change")
					$('input[name="size[]"][data-size="width"]').val(width).trigger("change")
                }
            }
            
            

			// field Item
			var item = $('<div class="field-item img" data-type="'+_ft+'">');
				item.attr('id', id)
				item.append("<img  accept='image/*' style='' src='image.png' data-id='"+id+"'/>")
			if(__id == ''){
				$('#id-card-field').append(item);
			}
			data_func();
		}if(_ft == 'home'){
			$("#forms").show();
			$("#text-field").hide();
			$("#image-field").hide();
		}

}
    function data_func(){
        $('[name="border_color"]').on('input change keyup keypress',function(){
			var el_id = $(this).attr('data-id');
			var color = $(this).val()
			$('#'+el_id).css("border-color",color);
		})
        $('[name="font_color"]').on('input change keyup keypress',function(){
			var el_id = $(this).attr('data-id');
			var color = $(this).val()
			$('#'+el_id).css({"color":color});
		})

        $('[name="size"]').on('input change keyup keypress',function(){
			var el_id = $(this).attr('data-id');
			var size = $(this).val()
			$('#'+el_id).css({"font-size":size+"px"});
		})

        $('[name="text_value"]').on('input change keyup keypress',function(){
			var el_id = $(this).attr('data-id');
			var txt = $(this).val()
			$('#'+el_id).text(txt);
		})

        $('[name="text_align"]').change(function(){
			var el_id = $(this).attr('data-id');
			var val = $(this).val()
			$('#'+el_id).css('text-align',val);

		})

        $('[name="style"]').change(function(){
			var val = $(this).val()
			var style = $(this).attr('name')
			var el_id = $(this).attr('data-id');
			if($(this).is(":checked") == true){
				if(val == 'bold')
					$('#'+el_id).css("font-weight","bolder");
				else
					$('#'+el_id).css("font-style","italic");
			}else{
				if(val == 'bold')
					$('#'+el_id).css("font-weight","unset");
				else
					$('#'+el_id).css("font-style","unset");
			}
		})

        $('[name="border"]').change(function(){
			var pos = $(this).val()
			var el_id = $(this).attr('data-id');
			var _style = "border-"+pos;
			if($(this).is(":checked") == true){
				$('#'+el_id).css(_style,"1px solid");
			}else{
				$('#'+el_id).css(_style,"none");
			}
		})

        $('[name="position[]"]').on('input keypress keyup change',function(){
			var el_id = $(this).attr('data-id');
			var pos = $(this).attr('data-pos')
			var val = $(this).val()
			$('#'+el_id).css(pos,val+"%");

		})

		$('[name="position1[]"]').on('input keypress keyup change',function(){
			var el_id = $(this).attr('data-id');
			var pos = $(this).attr('data-pos')
			var val = $(this).val()
			$('#'+el_id).css(pos,val+"%");

		})

        $('.remove_field').click(function(){
			var id = $(this).attr('data-id')
			$('.field-item#'+id).remove()
		})
        
        $('[name="size[]"]').on('input keypress keyup change',function(){
			var el_id = $(this).attr('data-id');
			var pos = $(this).attr('data-size')
			var val = $(this).val()
			$('#'+el_id).css(pos,val+"%");

		})

		$('[name="size1[]"]').on('input keypress keyup change',function(){
			var el_id = $(this).attr('data-id');
			var pos = $(this).attr('data-size')
			var val = $(this).val()
			$('#'+el_id).css(pos,val+"%");

		})


        $('[name="filename"]').change(function(){
			var id = $(this).attr('data-id')
			input = document.querySelector('input[name="filename"][data-id="'+id+'"]')
			if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
				var _base64, type;
				var data = e.target.result
					data = data.split(';base64,')
	        	$('img[data-id="'+id+'"]').attr("src",e.target.result);
	        }

				reader.readAsDataURL(input.files[0]);
			}
		})

        $('.field-item').on('mousedown',function(){
			var _ft = $(this).attr('data-type')
			var _this = $(this)
			show_form(_ft,_this,_this.attr('id'))
	})
        
        
    }

    $(document).ready(function(){  
	$('#save').click(function(e){
		e.preventDefault();
		var _this = $(this)
		$('#form-field').html('')
		var wait_until =  new Promise((resolve, reject) => {
			$('[name="template_code"]').val($('#id-card-field').parent().html())
				html2canvas(document.getElementById('id-card-field')).then(function(canvas) {
					// console.log(canvas.toDataURL('image/png'))
					$('[name="template_image"]').val(canvas.toDataURL('image/png'))
				resolve();
					// document.getElementById('preview').appendChild(canvas);
				});
			});
			wait_until.then(function(){

					$.ajax({
				
					url: '../model/save-templates.php',
					data: $('#template-form').serialize(),
					method: 'POST',
					error: function(data) {
					
					// Some error in ajax call
						alert("some Error");
					},
					success: function(data) {
					
					// Ajax call completed successfully
					alert(data);
				}

				
				});
			})



	});
})


</script>
<style>

	.card-body{
		padding: 12px 0;
		background: #c4c4c2;
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
	}

	.card{
		border: 1px solid black;
		border-radius: 10px;
	}

	.card-footer{
		margin-bottom: 12px;
	}

	.img-size{
       width: 90%;
		
	}
    #bg{
        background: gray;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 60px 0;
        border-radius: 5px;
    }
	#id-card-field{
		width:2.5in;
		height:3.5in;
		background:black;
		position:relative;
		background: white;
		border-radius: 5px;
        
        
	}
	#id-card-field .field-item{
		position:absolute;
		margin: 3px 5px;
	}
	#id-card-field .field-item.focus::before{
		content:"0";
		position:relative;
		width:100%;
		height:100%;
		border: 1px pink;
	}
	#id-card-field .field-item[data-type="textfield"]{
		padding:3px 5px;
	}
	#id-card-field .field-item.img{
		width:50px;
		height:50px;
	}
	#id-card-field .field-item>img{
		width:100%;
		height:100%;
		object-fit:fill;
		object-position:center center;
	}
	.remove_field{
		cursor:pointer;
	}

    

</style>