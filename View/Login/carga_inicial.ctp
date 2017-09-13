<style>
	body {
		text-align: center;
		vertical-align: middle;
		padding: 10% 0;
		font-family: 'roboto_condensedregular', sans-serif !important;
	}

	#wrapper {
	  width: 400px;
	  margin: 0 auto 0;
	  text-align: center;
	  white-space: pre-line;
	  vertical-align: middle;
	}

	.cogs {
	  height: auto;
	  display: inline-block;
	}

	svg {
	  float: left;
	}

	svg:first-child {
	  margin-top: -10px;
	}

	svg:nth-child(2) {
	  margin-left: -4px;
	  margin-top: -6px;
	}

	svg:nth-child(3) {
	  clear: left;
	  float: left;
	  margin-top: -24px;
	  margin-left: 6px;
	}

	progress {
	  -webkit-appearance: none;
	  appearance: none;
	  width: 100%;
	  margin: 10px auto;
	  clear: left;
	  display: inline-block;
	}

	progress[value]::-webkit-progress-value {
	  background: #fff;
	  border-radius: 2px;
	}

	progress[value]::-webkit-progress-bar {
	  border-radius: 10px;
	  border: 2px solid #fff
	}


	/* Animations */

	@-webkit-keyframes rotate {
	  from {
	    -webkit-transform: rotate(0);
	  }
	  to {
	    -webkit-transform: rotate(360deg);
	  }
	}

	@-webkit-keyframes rotate-opp {
	  from {
	    -webkit-transform: rotate(0);
	  }
	  to {
	    -webkit-transform: rotate(-360deg);
	  }
	}

	.cog * {
	  -webkit-animation: rotate 3s infinite;
	  -webkit-transform-origin: 50% 50%;
	  -webkit-animation-timing-function: linear;
	}

	.cog-opp * {
	  -webkit-animation: rotate-opp 3s infinite;
	  -webkit-transform-origin: 50% 50%;
	  -webkit-animation-timing-function: linear;
	}


	/* Pre-animation cycle */

	progress {
	  width: 0;
	  display: none;
	}

	.cogs {
	  margin-top: -50px;
	  opacity: 0;
	}


	/* Change color */

	body,
	progress[value]::-webkit-progress-bar {
	  background: #003964;
	}


	/* Orange :D 
	body,
	progress[value]::-webkit-progress-bar {
	  background: #d77235;
	} */
</style>

<?php 
	echo $this->Html->css(array(
		'../fonts/font.css',
	));
	echo $this->Html->script('../material/js/jquery-2.1.1.min.js'); 
?>
<div id="wrapper" class="wheelLoader">
	<div class="cogs">
		<svg 
			height=50px 
			width=50px 
			viewBox="0 0 900 900"><g class=cog transform=" translate(90,0)"><path transform=scale(0.5) fill="#fff" d="M249.773 763.25q-5 -20 -23.75 -31.25t-40 -5l-76.25 22.5q-21.25 6.25 -43.75 -3.125t-32.5 -28.125l-26.25 -45q-10 -18.75 -6.25 -42.5t18.75 -38.75l56.25 -55q15 -15 15 -36.25t-15 -36.25l-56.25 -55q-16.25 -15 -18.75 -38.75t7.5 -42.5l25 -46.25q10 -18.75 32.5 -27.5t43.75 -2.5l76.25 21.25q21.25 6.25 40 -5t23.75 -31.25l18.75 -76.25q6.25 -21.25 25 -36.25t40 -15l51.25 0q21.25 0 40 15t25 36.25l20 76.25q6.25 21.25 24.375 31.25t38.125 5l76.25 -21.25q21.25 -6.25 43.75 2.5t32.5 27.5l26.25 46.25q10 18.75 6.25 42.5t-18.75 38.75l-56.25 55q-16.25 15 -15.625 36.25t15.625 36.25l56.25 55q15 15 18.75 38.75t-6.25 42.5l-26.25 45q-10 18.75 -32.5 28.125t-43.75 3.125l-76.25 -22.5q-20 -5 -38.125 5t-24.375 31.25l-20 77.5q-6.25 21.25 -25 35.625t-40 14.375l-51.25 0q-21.25 0 -40 -14.375t-25 -35.625zm110 -366.25q-43.75 0 -74.375 30.625t-30.625 73.125 30.625 73.125 74.375 30.625q42.5 0 73.125 -30t30.625 -73.75 -30.625 -73.75 -73.125 -30z"/></g></svg>    <svg height=65px width=65px viewBox="0 0 900 900"><g class="cog cog-opp"transform=translate(30,0)><path transform=scale(0.5) fill="#fff"  d="M249.773 763.25q-5 -20 -23.75 -31.25t-40 -5l-76.25 22.5q-21.25 6.25 -43.75 -3.125t-32.5 -28.125l-26.25 -45q-10 -18.75 -6.25 -42.5t18.75 -38.75l56.25 -55q15 -15 15 -36.25t-15 -36.25l-56.25 -55q-16.25 -15 -18.75 -38.75t7.5 -42.5l25 -46.25q10 -18.75 32.5 -27.5t43.75 -2.5l76.25 21.25q21.25 6.25 40 -5t23.75 -31.25l18.75 -76.25q6.25 -21.25 25 -36.25t40 -15l51.25 0q21.25 0 40 15t25 36.25l20 76.25q6.25 21.25 24.375 31.25t38.125 5l76.25 -21.25q21.25 -6.25 43.75 2.5t32.5 27.5l26.25 46.25q10 18.75 6.25 42.5t-18.75 38.75l-56.25 55q-16.25 15 -15.625 36.25t15.625 36.25l56.25 55q15 15 18.75 38.75t-6.25 42.5l-26.25 45q-10 18.75 -32.5 28.125t-43.75 3.125l-76.25 -22.5q-20 -5 -38.125 5t-24.375 31.25l-20 77.5q-6.25 21.25 -25 35.625t-40 14.375l-51.25 0q-21.25 0 -40 -14.375t-25 -35.625zm110 -366.25q-43.75 0 -74.375 30.625t-30.625 73.125 30.625 73.125 74.375 30.625q42.5 0 73.125 -30t30.625 -73.75 -30.625 -73.75 -73.125 -30z"/></g></svg>    <svg height=65px width=65px viewBox="0 0 900 900"><g class=cog transform=translate(30,0)><path transform=scale(0.5) fill="#fff" d="M249.773 763.25q-5 -20 -23.75 -31.25t-40 -5l-76.25 22.5q-21.25 6.25 -43.75 -3.125t-32.5 -28.125l-26.25 -45q-10 -18.75 -6.25 -42.5t18.75 -38.75l56.25 -55q15 -15 15 -36.25t-15 -36.25l-56.25 -55q-16.25 -15 -18.75 -38.75t7.5 -42.5l25 -46.25q10 -18.75 32.5 -27.5t43.75 -2.5l76.25 21.25q21.25 6.25 40 -5t23.75 -31.25l18.75 -76.25q6.25 -21.25 25 -36.25t40 -15l51.25 0q21.25 0 40 15t25 36.25l20 76.25q6.25 21.25 24.375 31.25t38.125 5l76.25 -21.25q21.25 -6.25 43.75 2.5t32.5 27.5l26.25 46.25q10 18.75 6.25 42.5t-18.75 38.75l-56.25 55q-16.25 15 -15.625 36.25t15.625 36.25l56.25 55q15 15 18.75 38.75t-6.25 42.5l-26.25 45q-10 18.75 -32.5 28.125t-43.75 3.125l-76.25 -22.5q-20 -5 -38.125 5t-24.375 31.25l-20 77.5q-6.25 21.25 -25 35.625t-40 14.375l-51.25 0q-21.25 0 -40 -14.375t-25 -35.625zm110 -366.25q-43.75 0 -74.375 30.625t-30.625 73.125 30.625 73.125 74.375 30.625q42.5 0 73.125 -30t30.625 -73.75 -30.625 -73.75 -73.125 -30z"/></g>
		</svg>
	</div>
	<progress varlue="0" max="100"></progress>
	<h3 style="color:white;">Sincronizando datos...</h3>
</div>
<script>
	var url_integracion = "<?php echo $this->Html->url(array('controller'=>'integracion','action'=>'cargaAcademicaDocente')); ?>";
	$.fn.WheelLoader = function(o) {
	  var _this = this[0],
	    $this = $(this),
	    WheelLoader = {
	      $progress: null,
	      $cogs: null,

	      init: function() {
	        this.$progress = $this.find("progress");
	        this.$cogs = $this.find(".cogs");
	        this.reset();
	      },

	      load: function(i) {
	        setTimeout(function() {
	          i += 1;
	          _this.$progress.val(i);

	          if (i == 100){
	          	_this.close();
	          	$('h3').html('Carga exitosa. Redireccionando...');	
	          }else if(i == 70){
	          	_this.load(i);
	          	$('h3').html('La carga esta por finalizar...');	
	          }else{
	            _this.load(i);
	          }
	        }, 30);
	      },

	      reset: function() {
	        _this.$cogs.animate({
	          marginTop: "0",
	          opacity: 1
	        }, 300, function() {
	          _this.$progress.val(0).show().animate({
	            width: "100%"
	          }, 500, function() {
	            _this.load(0);
	          });
	        });
	      },

	      close: function() {
	        _this.$progress.animate({
	          width: "0px"
	        }, 500, function() {
	          $(this).hide();
	          _this.$cogs.animate({
	            marginTop: "-50px",
	            opacity: 0
	          }, 300, function() {
	            setTimeout(function() {
	              _this.reset();
	            }, 500);
	          });
	        });
	        //window.location = "<?php echo $this->Html->url(array('controller'=>'docentes','action'=>'getEventos')); ?>";
	      },
	    };

	  _this.WheelLoader = WheelLoader,
	    _this = _this.WheelLoader,
	    _this.init();
	};
	$(document).ready(function() {
	  $(".wheelLoader").WheelLoader();
	  	$.ajax({
			type: 'POST',
			dataType: 'json',
			url: url_integracion,
			cache: false,
			error: function (xhr, ajaxOptions, thrownError) {
			    //alert(xhr.responseText);
			    //alert(thrownError);
			},
			/*xhr: function () {
			    var xhr = new window.XMLHttpRequest();
			    xhr.addEventListener("progress", function (evt) {
			    	console.log(evt)
			        if (evt.lengthComputable) {
			            var percentComplete = evt.loaded / evt.total;
			            _this.$progress.val(i);
			            _this.load(Math.round(percentComplete * 100));
			            if (Math.round(percentComplete * 100)>70) {
							$('h3').html('La carga esta por finalizar...');	
			            }
			        }
			    }, false);
			    return xhr;
			},*/
			beforeSend: function () {
			},
			complete: function (response) {
				console.log(response);
				window.location = "<?php echo $this->Html->url(array('controller'=>'docentes','action'=>'getEventos')); ?>";
			},
			});
	});
</script>