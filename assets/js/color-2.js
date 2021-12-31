var undo = [];
var redo = [];
$(document).ready(function(){
	var global;
	undo.push($('.export').html());
	
	$('.color').on('click',function(){
		global = $(this).data('color');
	});
	$('#color-pallate-picker').on('change',function(){
		global = $(this).val();
		console.log(global);
	});
	//
	$('.export').children('svg').children('ellipse').click(function(){
		$(this).attr('fill', global);
	})
	$('.export').children('svg').children('polygon').click(function(){
		$(this).attr('fill', global);
	})
	
	$('.export').children('svg').children('rect').click(function(){
		$(this).attr('fill', global);
	})
	//
	
	$('.export').on('click', 'svg path',function(){
		$(this).css("fill",global);
		$('.export').children('svg').children('ellipse').click(function(){
			$(this).attr('fill', global);
		})
		$('.export').children('svg').children('polygon').click(function(){
			$(this).attr('fill', global);
		})
		$('.export').children('svg').children('rect').click(function(){
			$(this).attr('fill', global);
		})
		undo.push($('.export').html());
	});
	$('.convert').on('click',function(){
		var id = $(".export").find("svg").attr('id');
		saveSvgAsPng(document.getElementById(id), "diagram.png");
	});
});
	function un(){
	    if(typeof undo !== 'undefined' && undo.length > 0){
			redo.push($('.export').html());
			undo.pop();
			$('.export').html(undo[undo.length - 1]);
	    }
	}
	function re(){
	    if(typeof redo !== 'undefined' && redo.length > 0){	
			$('.export').html(redo[redo.length - 1]);
			undo.push($('.export').html());
			redo.pop();
	    }
	}
