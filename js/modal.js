window.addEventListener('load', function() {
    // Get the modals
    var modals = Array.from(document.getElementsByClassName("modal"));

    // Get the button that opens the modal
    var btns = Array.from(document.getElementsByClassName("modal-trigger"));

    // Get the <span> element that closes the modal
    var spans = Array.from(document.getElementsByClassName("close"));

    // When the user clicks on the button, open the modal
    btns.forEach(
        function(btn) {
            btn.onclick = function() {
                document.getElementById(btn.dataset.target).style.display = "block";

            };
        }
    );


    // When the user clicks on <span> (x), close the modal
    spans.forEach(
        function(span) {
            span.onclick = function() {
                document.getElementById(span.dataset.target).style.display = "none";
            };
        }
    );

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        let target = event.target;
        console.log(target);
        if (target.className == 'modal') {
            target.style.display = "none";
        }

    }
});