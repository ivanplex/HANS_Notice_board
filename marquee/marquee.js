var posters = [ 
	"/src/A_side.png", 
	"/src/B_side.png", 
	"/src/C_side.png"
];

var index = 1;

setInterval(function() {
	document.body.style.background = 'url('+posters[index]+')  0 0 no-repeat';
	document.body.style.backgroundSize = "contain";

	index++;
	if (index >= posters.length) { index = 0; }
}, 2000); 