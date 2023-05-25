// get the modal element of the main div for pop up modal
var modal = document.getElementById("modal");

// get the button that opens the modal
var addBtn = document.getElementById("add-btn");

// get the span close element for close button
var closeBtn = document.getElementById("close");


// When the user clicks the add button
addBtn.onclick = function() {
    modal.style.display = "block";
};

// When the user clicks on span close button
closeBtn.onclick = function() {
    modal.style.display = "none";
};

// When the user clicks anywhere or outside the modal, it will automatically close it
window.onclick = function(event) {
    if(event.target == modal) {
        modal.style.display = "none";
        
    }
};

$(document).ready(function () {
    $('#example').DataTable();
});


