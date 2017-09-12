var li=links(); //global declare
//var load=loader(); //global declare

//host approve
/*aproved*/

$( function() {
  $( "#from_date" ).datepicker({dateFormat: 'yy-mm-dd'});
  $( "#to_date" ).datepicker({dateFormat: 'yy-mm-dd'});
} );

function user_control(value){
	var val = $(value).val().trim();
	var split = val.split("|");
	var assign = split[0];
	var id = split[1];

	var prove = confirm('Are you sure you want to update the user?');
  	if (prove == 1) {

		$.ajax({
	        type: 'POST',
	        url:li+'admin/user_controls/',
	        data:{id:id,assign:assign},
	        dataType:'json',
	        success: function(data){
	        	if (data==1) {
	        		alert('User updated successfully!');
              location.reload();
	        	}else{
	        		location.reload();
	        		alert('User update was not successful!');
	        	}
	        },
	        error: function(){
	          alert('Error user control!');
	        }
	    });
	}
}

$("#auto_email").keyup(function(){
      
    var v=$("#auto_email").val();
  
    if(v != ''){
    
      $('#auto_email').addClass('ac_loading');        
          
      $("#auto_email").autocomplete({
          source: function( request, response ) {
      
          $.ajax({
        
            type:'POST',
            dataType:'json',
            url:li+'admin/autocomplete_view_email',
            data:{id:v},
            success:function(data)
            {
                response(data);
            }
            
          });         
            
          $("#auto_email").removeClass('ac_loading');

        }   
      
      });
    }
});
$("#auto_state").keyup(function(){
      
    var v=$("#auto_state").val();
  
    if(v != ''){
    
      $('#auto_state').addClass('ac_loading');        
          
      $("#auto_state").autocomplete({
          source: function( request, response ) {
      
          $.ajax({
        
            type:'POST',
            dataType:'json',
            url:li+'admin/autocomplete_view_state',
            data:{id:v},
            success:function(data)
            {
                response(data);
            }
            
          });         
            
          $("#auto_state").removeClass('ac_loading');

        }   
      
      });
    }
});

$("#auto_city").keyup(function(){
      
    var v=$("#auto_city").val();
  
    if(v != ''){
    
      $('#auto_city').addClass('ac_loading');        
          
      $("#auto_city").autocomplete({
          source: function( request, response ) {
      
          $.ajax({
        
            type:'POST',
            dataType:'json',
            url:li+'admin/autocomplete_view_city',
            data:{id:v},
            success:function(data)
            {
                response(data);
            }
            
          });         
            
          $("#auto_city").removeClass('ac_loading');

        }   
      
      });
    }
});
$("#auto_location").keyup(function(){
      
    var v=$("#auto_location").val();
  
    if(v != ''){
    
      $('#auto_location').addClass('ac_loading');        
          
      $("#auto_location").autocomplete({
          source: function( request, response ) {
      
          $.ajax({
        
            type:'POST',
            dataType:'json',
            url:li+'admin/autocomplete_view_street_location',
            data:{id:v},
            success:function(data)
            {
                response(data);
            }
            
          });         
            
          $("#auto_location").removeClass('ac_loading');

        }   
      
      });
    }
});

//chatting and inbox admin with user
function reply_inbox(value){
	var all_val = $(value).val().trim();

	$.ajax({
        type: 'POST',
        url:li+'admin/reply_inbox/',
        data:{all_val:all_val},
        dataType:'json',
        success: function(data){

        	$("#send_button").val(all_val);
        	
	        $("#message_body").focus();

        	if (data.final==2) {
        		$("#conversation_start").html('Please, converasation start.');
        		
        	}else{

        		var datas = data.final;

        		var full_data='';
		        for(i=0; i<datas.length;i++){
		        	var id = datas[i].id;
		        	var details = datas[i].details;
		        	var added_date = datas[i].added_date;
		        	var type = datas[i].type;

		        	var fname = datas[i].fname;


		        	if (type==0) {
		        		full_data += '<div class="mmg_extra">'+
							'<h4>Admin</h4>'+
							'<p>'+details+'</p>'+
							'<span>'+added_date+'</span>'+
						'</div>';
		        	}else{
		        		full_data += '<div class="mmg">'+
							'<h4>'+fname+'</h4>'+
							'<p>'+details+'</p>'+
							'<span>'+added_date+'</span>'+
						'</div>';
		        	}

		        }

		        $("#conversation_start").html(full_data);


        	}
        	
        },
        error: function(){
          alert('Error user control!');
        }
    });

}

function submit_messege(value){
	var all_val = $(value).val().trim();
	var details = $("#message_body").val().trim();

	$.ajax({
        type: 'POST',
        url:li+'admin/submit_messege/',
        data:{all_val:all_val,details:details},
        dataType:'json',
        success: function(data){


	        $("#message_body").val(' ');
	        $("#message_body").focus();

    		var datas = data.final;

    		var full_data='';
	        for(i=0; i<datas.length;i++){
	        	var id = datas[i].id;
	        	var details = datas[i].details;
	        	var added_date = datas[i].added_date;
	        	var type = datas[i].type;

	        	var fname = datas[i].fname;


	        	if (type==0) {
	        		full_data += '<div class="mmg_extra">'+
						'<h4>Admin</h4>'+
						'<p>'+details+'</p>'+
						'<span>'+added_date+'</span>'+
					'</div>';
	        	}else{
	        		full_data += '<div class="mmg">'+
						'<h4>'+fname+'</h4>'+
						'<p>'+details+'</p>'+
						'<span>'+added_date+'</span>'+
					'</div>';
	        	}

	        }

	        $("#conversation_start").html(full_data);

        },
        error: function(){
          alert('Error inbox!');
        }
    });
}


function request_inbox(){
  var email = $("#auto_email").val().trim();

  if (email=='') {alert('Information incomplete');}else{
    $.ajax({
      type:'POST',
      dataType:'json',
      url:li+'admin/request_inbox/',
      data:{email:email},
      success:function(data)
      {
          $("#auto_email").val(' ');
          if(data.failed==2){
            alert('Request Failed');
          }else if(data.old==3){
            alert('Already Added.');
            $("#auto_email").focus();
          }else{
            location.reload();
          }
      }
      
    });
  }
}




function payment_withdrw_by_admin(valu){
  var values = $(valu).val().trim();
  var valu = confirm('Are you sure you want to update payment withdraw?');
    if (valu == 1) {


      $.ajax({
          type: 'POST',
          url:li+'admin/payment_withdrw_by_admin/',
          data:{values:values},
          dataType:'json',
          success: function(data){
            if (data==1) {
              alert('Withdraw request approved!');
              location.reload();
            }else{
              location.reload();
              alert('Wwithdraw request rejected!');
            }
          },
          error: function(){
            alert('Error!');
          }
      });
  }

}

function password_change(){
  var old_pass = $("#old_pass").val().trim();
  var new_pass = $("#new_pass").val().trim();
  var confirm_pass = $("#confirm_pass").val().trim();

  if (new_pass !== '' && old_pass !== '' && confirm_pass !== '') {
    if (new_pass == confirm_pass) {
      $.ajax({
        type: 'POST',
        url:li+'admin/password_change',
        data:{old_pass:old_pass,new_pass:new_pass,confirm_pass:confirm_pass},
        dataType:'json',
        success: function(response){

          $("#old_pass").val('');
          $("#new_pass").val('');
          $("#confirm_pass").val('');

          if (response['success']) {
            $("#show_change_pass").html(response['success']);
          }else if(response['mismatch']){
            $("#show_change_pass").html(response['mismatch']);
          }else{;
            $("#show_change_pass").html(response['try_new']);
          }

        },
        error: function(){
          alert('error');
        }
      });
    }else{
      $("#show_change_pass").html('Confirm pass did not match.');
    }
    
  }else{
    $("#show_change_pass").html('Information incomplete.');
  }


}