function carousel() {
    var current = 0;
    var x = document.getElementsByClassName("images");
    var i;
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    current++;
    if (current > x.length) {current = 1}    
    x[current-1].style.display = "block";  
    setTimeout(carousel, 15000);    
}