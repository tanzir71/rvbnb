    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->

<script>
  /*$( function() {
    $( "#dated" ).datepicker({dateFormat : 'yy-mm-dd'});
  } ); */
    $('.modal').modal({
        backdrop: 'static',
        keyboard: false
    })
</script>

    

    <script src="<?php echo base_url(); ?>assets/js/link.js"></script> <!-- for default link -->
    <script src="<?php echo base_url(); ?>panel/js/custom/test.js"></script> <!-- for pop up -->
    
<script src="<?php echo base_url(); ?>panel/js/custom/web/process.js"></script>

    <script src="<?php echo base_url(); ?>panel/js/jquery-ui.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>panel/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>panel/js/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url(); ?>panel/js/raphael-min.js"></script>
   

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>panel/js/sb-admin-2.js"></script>
	
			
    <script src="<?php echo base_url(); ?>panel/js/custom/test.js"></script>					
    	
    <script type="text/javascript">
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
    </script>
	

</body>

</html>

