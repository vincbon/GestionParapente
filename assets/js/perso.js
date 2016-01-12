$(document).ready(function() {
	var allForms = document.getElementsByTagName('form');
    var i, form;
    
    for(i = 0; form = allForms[i]; i++) (function(form){
        form.onsubmit = function() {
            var allInputs = form.getElementsByTagName('input');
            var input, j;

            for(j = 0; input = allInputs[j]; j++) {
                if(input.getAttribute('name') && !input.value) {
                    input.setAttribute('name', '');
                }
            }
        }
    })(form);
	
	$(".modal-wide").on("show.bs.modal", function() {
		var height = $(window).height() - 200;
		$(this).find(".modal-body").css("max-height", height);
	});
});