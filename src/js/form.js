function startForms() {
	globalEnviando = false;
	$(".f-contato").on('click', 'input[type=submit]',  function(event) {
	event.preventDefault();
	if (globalEnviando == false) {
	    $(this).animate({'opacity': '0.30'}, 600);
	    $(this).css('cursor', 'default');
	    globalEnviando = true;
	    var url = "controller/ajax.submit.php"; // script de envio do formulário
	    $.ajax({
	        type: "POST",
	        url: url,
	        data: $(this).closest('form').serialize(), // serializes the form's elements.
	        success: function(data)
	        {
	            //alert(data); // resposta
	            $(".f-contato").append('<p class="m-resposta">'+data+'</p>')
	            $(".m-resposta").fadeOut(0).fadeIn(600, function() {
	                $(".m-resposta").delay(5000).fadeOut(600, function() {
	                    $(".m-resposta").remove();
	                });
	            });
	            setTimeout(function (){ globalEnviando = false; $(".f-contato").find('input[type=submit]').animate({'opacity': '1'}, 600);$(".contato").find('input[type=submit]').css('cursor','pointer');}, 700);
	        }
	    });
	};
	return false; // avoid to execute the actual submit of the form.
	});
}