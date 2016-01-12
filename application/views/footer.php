		<!-- Fermeture du 'container' de bootstrap -->
		</div>
	<!-- Scripts -->
	<script src="<?php echo base_url("assets/js/jquery.js") ?>"></script>
	<script src="<?php echo base_url("assets/js/bootstrap.js") ?>"></script>
	<script src="<?php echo base_url("assets/js/perso.js") ?>"></script>
    <script>
         var duree_mn = 0;
        var duree_h = 0;
    </script>
	<script>
  		$(function () {

            $("input[id^='select'").each(function() {
                var id = $(this).attr('id').split('_');
                var value = $(this).attr('value');
                if (value!=null && value!='' && value.trim()) {
                    $("button[id='select_"+id[1]+'_'+value).css('visibility', 'hidden');
                    $("tr[id="+id[1]+'_'+value).addClass('success');
                }
            });

        	$("button[id^='select']").click(function() {
                var id = $(this).attr('id').split('_');
                var old_id = $("input[id="+id[0]+'_'+id[1]).attr("value");

                $("tr[id="+id[1]+'_'+old_id).removeClass('success');
                $("button[id=select_"+id[1]+'_'+old_id).css('visibility', 'visible');;

                $("tr[id="+id[1]+'_'+id[2]).addClass('success');
                $(this).css('visibility', 'hidden');
        		
                $("input[id="+id[0]+'_'+id[1]).attr("value", id[2]);
        	});

        	$("button[id^='pop_']").popover({trigger: 'hover', placement: 'left'});

        	$(".trb").hover(
        		function() {$(this).addClass('warning')},
        		function() {$(this).removeClass('warning')}
        	);

            function calculerPrix() {
                duree_h = $('#duree_h').val();
                duree_mn = $('#duree_mn').val();
                if (duree_h != '' && duree_h.trim() && duree_mn != '' && duree_mn.trim()) {
                    var tarif = $("#tarif").val();
                    var prix = tarif * (parseInt(duree_mn, 10)
                                        + 60*parseInt(duree_h, 10));
                    $("#prix").attr('value', prix.toFixed(2));
                } else {
                    $("#prix").attr('value', '');
                }
            }

            $("input[id^='duree']").bind('change', calculerPrix);
            $("select[id='tarif']").bind('change', calculerPrix);

            $(".modal th").each(function() {
                $(this).html($(this).contents(':first').html());
            });

            $("#tarif_defaut").change(function() {
                $("#form_preferences").submit();
            });
  		});
	</script>
	</body>
</html>