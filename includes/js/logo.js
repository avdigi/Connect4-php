var loadingIcon = $('#loading-icon');
var puzzleContainer = $('#logoContainer');
var piece = $('#loading-icon circle');
var speed1 = 0.5;
var speed2 = 0.7;
var speedVar = 1;


var tl = new TimelineMax({
	
	onComplete: function() {
		this.invalidate();
		this.restart();
	}
	
});

function startAnimation(){
	speedVar=1;
	tl
	.resume()
	.timeScale(1)
	.staggerTo(piece, speed1, {
			scale: 0.5,
			transformOrigin: "50% 50%",
			ease: Bounce.easeOut
		}, 0.04) 

	.to(loadingIcon, speed2, {
			rotation: "+=135",
			ease: Circ.easeInOut,
		})

	.to(piece, speed1, {
			scale: 1,
			ease: Bounce.easeOut,
		})

	.to(loadingIcon, speed2, {
			rotation: "+=135",
			ease: Circ.easeInOut,
		})
}

function speedAnimation(){
	speedVar++;
	tl.timeScale(speedVar);
	if(speedVar>=42){
		alert("Congratulations! You have discovered the meaning of life!");
	}
}

function stopAnimation(){
	tl.restart();
	tl.pause();
}

