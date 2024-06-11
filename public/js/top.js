
const viewButton = document.querySelector('#viewButton');

window.onscroll = function() {
    var top = window.scrollY;
    if(top >= 1000) {
        viewButton.style.display = "inline";
    }
    else {
        viewButton.style.display = "none";
    }
}
