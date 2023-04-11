(function (root) {
	"use strict";

	////////////////////
	// all functions. //
	////////////////////
	// first class instantiation.
	function proBar(options){

		this.height = 5; // 5px by default.
		this.colorBar = "#2a2a2a";
		this.wrapper_color = "#ecf0f1";
		this.speedAnimation = 0.3; // in seconds
		this.wrapper = "body"; // default value of appending.
		this.finishAnimation = true;
		this.classNameBar = "progressBar"; // default.
		this.wrapperId = "wrapper-progressBar"; // default.
		this.rounded = { // by default All is on Zero.
			topLeft : 0,
			topRight : 0,
			bottomLeft : 0,
			bottomRight : 0
		};
		this.roundedInternal = { // by default All is on Zero.
			topLeft : 0,
			topRight : 0,
			bottomLeft : 0,
			bottomRight : 0
		}

		this.options = options || {};


		if(this.options.color) { this.colorBar = this.options.color }
		if(this.options.height) { 
			this.height = this.options.height; 
		}
		if(this.options.bgColor) { this.wrapper_color = this.options.bgColor }
		if(this.options.speed) { this.speedAnimation = this.options.speed }
		if(this.options.wrapper) { this.wrapper = this.options.wrapper }
		if(this.options.finishAnimation == false) { this.finishAnimation = this.options.finishAnimation;}
		if(this.options.classNameBar) { this.classNameBar = this.options.classNameBar }
		if(this.options.wrapperId) { this.wrapperId = this.options.wrapperId }
		if(this.options.rounded) { 
			this.rounded.topLeft = this.options.rounded.topLeft || 0;
			this.rounded.topRight = this.options.rounded.topRight || 0;
			this.rounded.bottomLeft = this.options.rounded.bottomLeft || 0;
			this.rounded.bottomRight = this.options.rounded.bottomRight || 0;
		}
		if(this.options.roundedInternal) { 
			this.roundedInternal.topLeft = this.options.roundedInternal.topLeft || 0;
			this.roundedInternal.topRight = this.options.roundedInternal.topRight || 0;
			this.roundedInternal.bottomLeft = this.options.roundedInternal.bottomLeft || 0;
			this.roundedInternal.bottomRight = this.options.roundedInternal.bottomRight || 0;
		}

		// create Bar.
	    createBar(
	    		this.wrapper,
	    		this.classNameBar,
	    		this.height,
	    		this.colorBar,
	    		this.wrapperId,
	    		this.wrapper_color,
	    		this.rounded,
	    		this.roundedInternal
	    		);

		// move the bar
		this.move = (percent) => {

			$("."+this.classNameBar).css({
				width: percent+"%",
				transition : "width "+this.speedAnimation+"s"
			});

			// if animation is true, reInitializate Probar.
			if(this.finishAnimation == true) {
				$("#"+this.wrapperId).css({
					"height": this.height+"px"
				});
			}

			// verify if is 100%
			setTimeout(() => {
				if(percent == 100 && this.finishAnimation == true) {
					console.log("je vais faire l'animation bro");
					$("#"+this.wrapperId).css({
						"height": "0px",
						"transition" : "all 0.3s"
					});
					// reset bar to zero.
					$("."+this.classNameBar).css({
						width: "0%"
					});
				}
			},this.speedAnimation * 1000);
		}
		var setSpeed = (speed) => {
			this.speedAnimation = speed;
		}
		var setColor = (color) => {
			this.colorBar = color;
			$("."+this.classNameBar).css({ 
				"background-color" : this.colorBar
			});
		}
		var setWrapperColor = (color) => {
			this.wrapper_color = color;
			$("#"+this.wrapperId).css({ 
				"background-color" : this.wrapper_color
			});
		}
		var setFinishAnimation = (boolean) => {
			this.finishAnimation = boolean;
		}
		var setRounded = (topLeft = 0,topRight = 0,bottomLeft = 0,bottomRight = 0) => {

			this.rounded.topLeft = topLeft || 0;
			this.rounded.topRight = topRight || 0;
			this.rounded.bottomLeft = bottomLeft || 0;
			this.rounded.bottomRight = bottomRight || 0;

			$("#"+this.wrapperId).css({ 
				"border-top-left-radius" : this.rounded.topLeft+'px',
				"border-top-right-radius" : this.rounded.topRight+'px',
				"border-bottom-left-radius" : this.rounded.bottomLeft+'px',
				"border-bottom-right-radius" : this.rounded.bottomRight+'px'
			});
		}
		var setRoundedInternal = (topLeft = 0,topRight = 0,bottomLeft = 0,bottomRight = 0) => {

			this.roundedInternal.topLeft = topLeft || 0;
			this.roundedInternal.topRight = topRight || 0;
			this.roundedInternal.bottomLeft = bottomLeft || 0;
			this.roundedInternal.bottomRight = bottomRight || 0;

			$("."+this.classNameBar).css({ 
				"border-top-left-radius" : this.roundedInternal.topLeft+'px',
				"border-top-right-radius" : this.roundedInternal.topRight+'px',
				"border-bottom-left-radius" : this.roundedInternal.bottomLeft+'px',
				"border-bottom-right-radius" : this.roundedInternal.bottomRight+'px'
			});
		}
		var setHeight = (height = 5) => {
			this.height = height;
			$("#"+this.wrapperId).css({ 
				"height" : this.height+'px'
			});
			$("."+this.classNameBar).css({ 
				"height" : this.height+'px'
			});
		}
		
		let ProBar = {
          setSpeed,
          setHeight,
          setColor,
          setWrapperColor,
          setFinishAnimation,
          setRounded,
          setRoundedInternal,
          goto: (percent,time = null) => {
          	if(time != null) {setSpeed(time)}
          	this.move(percent);
          }
        };

		return ProBar;
	}	


	var createBar = ( element,classNameBar,height,colorBar,wrapperId,wrapper_color,rounded,roundedInternal ) => {
		console.log("la hauteur est de "+height);
		var Css = `
			.${classNameBar} {
				width : 0px;
				height : ${height}px;
				background-color: ${colorBar};
    			border-radius : ${roundedInternal.topLeft}px ${roundedInternal.topRight}px ${roundedInternal.bottomLeft}px ${roundedInternal.bottomRight}px;
			}
			#${wrapperId} {
				width : 100%;
				height : ${height}px;
				background-color : ${wrapper_color};
    			overflow: hidden;
    			border-radius : ${rounded.topLeft}px ${rounded.topRight}px ${rounded.bottomLeft}px ${rounded.bottomRight}px;
			}
		`;

		var htmlBar = `<div id="${wrapperId}"><div class="${classNameBar}"></div></div>`;
		$(element).prepend(htmlBar);
		$("head").append(`
			<style>
				${Css}
			</style>
			`);
	}
	
	if (window.jQuery) {  
    	console.log("JQuery is installed !");
	    root.ProBar = proBar;
    } else {
        // jQuery is not loaded
        console.warn("No Jquery - add it as CDN");
        return false;
    }
}(this));