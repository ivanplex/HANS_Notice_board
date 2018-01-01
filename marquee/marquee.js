var posters = [ 
	"/proj/hans/src/A_side.png", 
	"/proj/hans/src/B_side.png", 
	"/proj/hans/src/C_side.png"
];

var index = 1;

setInterval(function() {
	document.body.style.background = 'url('+posters[index]+')  0 0 no-repeat';
	document.body.style.backgroundSize = "contain";

	index++;
	if (index >= posters.length) { index = 0; }
}, 2000); 