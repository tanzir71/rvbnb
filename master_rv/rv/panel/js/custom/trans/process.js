var li=links(); //global declare
//var load=loader(); //global declare

$("#tag").keyup(function(){
		  
    var v=$("#tag").val();
  
    if(v != ''){
		
		$('#tag').addClass('ac_loading');				
				
		$("#tag").autocomplete({
    		source: function( request, response ) {
		
			 	$.ajax({
			
					type:'POST',
					dataType:'json',
					url:li+'admin/autocomplete_view/',
					data:{id:v},
					success:function(data)
					{
		   				response(data);
					}
				});					
					
				$("#tag").removeClass('ac_loading');

			}		
		
		});
	}
});


$("#supp").keyup(function(){
		  
    var v=$("#supp").val();
  
    if(v != ''){
		
		$('#supp').addClass('ac_loading');				
				
		$("#supp").autocomplete({
    		source: function( request, response ) {
		
			 	$.ajax({
			
					type:'POST',
					dataType:'json',
					url:li+'admin/autocomplete_view_supp/',
					data:{id:v},
					success:function(data)
					{
		   				response(data);
					}
				});					
					
				$("#supp").removeClass('ac_loading');

			}		
		
		});
	}
});

$("#suppss").keyup(function(){
		  
    var v=$("#suppss").val();
  
    if(v != ''){
		
		$('#suppss').addClass('ac_loading');				
				
		$("#suppss").autocomplete({
    		source: function( request, response ) {
		
			 	$.ajax({
			
					type:'POST',
					dataType:'json',
					url:li+'admin/autocomplete_view_supp/',
					data:{id:v},
					success:function(data)
					{
		   				response(data);
					}
				});					
					
				$("#suppss").removeClass('ac_loading');

			}		
		
		});
	}
});

function  create_bill(){
	var supp_id = $("#supp").val().trim();
	var explode = supp_id.split('*');
	var supp = explode[1];

	var b_date = $("#b_date").val().trim();
	var service = $("#service").val().trim();
	var amount = $("#amount").val().trim();

	if (supp=='' || b_date=='' || service=='' || amount=='') {
		alert('Information Incomplete');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/create_bill_final',
	        data:{supp:supp,b_date:b_date,service:service,amount:amount},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           location.reload();
	           $(overlay).fadeOut();
	           $("#supp").val('');
	           $("#service").val('');
	           $("#amount").val('');

	           $("#supp").focus();
	    	},
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}

function  create_supp(){
	var supp_name = $("#supp_name").val().trim();
	var phone = $("#phone").val().trim();
	var address = $("#address").val().trim();

	if (supp_name=='' || phone=='') {
		alert('Information Incomplete');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/create_supp',
	        data:{supp_name:supp_name,phone:phone,address:address},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           location.reload();
	           $(overlay).fadeOut();
	           $("#supp_name").val('');
	           $("#phone").val('');	    	
	           $("#address").val('');

	           $("#supp_name").focus();	    	
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}
function  create_bank(){
	var acc_name = $("#acc_name").val().trim();
	var acc_no = $("#acc_no").val().trim();

	if (acc_name=='' || acc_no=='') {
		alert('Information Incomplete');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/create_bank',
	        data:{acc_name:acc_name,acc_no:acc_no},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           location.reload();
	           $(overlay).fadeOut();
	           $("#acc_name").val('');
	           $("#acc_no").val('');	    	
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}
function  max_pay(){
	var dated = $("#dated").val().trim();
	var amount = $("#amount").val().trim();

	if (dated=='' || amount=='') {
		alert('Information Incomplete');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/max_payment',
	        data:{dated:dated,amount:amount},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           location.reload();
	           $(overlay).fadeOut();
	           $("#amount").val('');

	           $("#amount").focus();	    	
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}

function payment_window(my){
	var pay_id = $(my).val().trim();
	if (pay_id=='') {
		alert('none');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/payment_window',
	        data:{pay_id:pay_id},
	        dataType:'json',
	        success: function(data){

	           $("#bill_id").val(data.id);
	           $("#amount").val(data.amount);
	           $("#p_date").val(data.dated);

	           $("#bill_date").val(data.dated);

	           $("#c_date").val(data.pay_date);

	           $("#pay_datess").val(data.pay_date);


	           $("#supp_name").html(data.supp_name);
	           
	           //$("#max_pay").html(data.max_pay);

	           $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}




$('#ch_pay').on('click', '#status', function(){
	var ch_id =$(this).val();
	if (ch_id==1 || ch_id==3 || ch_id==4) {
		$('#forwared_date').css('display', 'none');
	}else{
		$('#forwared_date').css('display', 'block');
	}
})



function create_payment(){
	var bill_id = $("#bill_id").val().trim();
	var p_date = $("#p_date").val().trim();

	var bank = $("#tag").val().trim();
	var explode = bank.split('*');
	var bank_id = explode[1];

	var c_date = $("#c_date").val().trim();
	var pay_date = $("#pay_datess").val().trim();

	var amount = $("#amount").val().trim();
	var note = $("#note").val().trim();


	if (bill_id=='' || p_date=='' || bank=='' || c_date=='' || amount=='' || pay_date=='') {
		alert('Information Incomplete');
	}else{

		$(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/create_payment_passed',
	        data:{bill_id:bill_id,p_date:p_date,bank_id:bank_id,c_date:c_date,amount:amount,pay_date:pay_date,note:note},
	        dataType:'json',
	        success: function(data){
	        	if (data.am==1) {
	        		var info = '* Max Amount Crossed';
	        		$("#amount_info").html(info).fadeIn().delay(3000).fadeOut();
	        		 $(overlay).fadeOut();
	        	}else{
	        		alert(data.su);
	        		location.reload();
	        	}
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
	
}

function payment_status(my){
	var pay_id = $(my).val().trim();
	if (pay_id=='') {
		alert('none');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/payment_status_modal',
	        data:{pay_id:pay_id},
	        dataType:'json',
	        success: function(data){

	           $("#pay_id").val(data.pay_id);
	           $("#bill_no").val(data.bill_id);
	           $("#p_dated").val(data.dated);
	           $("#amount").val(data.amount);
	           $("#check_date").val(data.check_date);
	           $("#note").val(data.note);

	           $("#bank_name").val(data.bank_name);
	           $("#supp_name").html(data.supp_name);

	           $("#max_pay").html(data.max_pay);


	           $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}


function create_payment_status(){
	var bill_no = $("#bill_no").val().trim();
	var pay_id = $("#pay_id").val().trim();
	var p_dated = $("#p_dated").val().trim();
	var check_date = $("#check_date").val().trim();
	var amount = $("#amount").val().trim();
	var note = $("#note").val().trim();

	var status =$('input[name=status]:checked').val();
	if (status==1 || status==3 || status==4) {

		if (bill_no=='' || pay_id=='' || p_dated=='' || check_date=='' || amount=='' || status=='') {
			alert('Information Incomplete');
		}else{

			$(overlay).fadeIn();
			$.ajax({
		        type: 'POST',
		        url:li+'admin/create_payment_status_passed',
		        data:{bill_no:bill_no,pay_id:pay_id,p_dated:p_dated,check_date:check_date,amount:amount,status:status,note:note},
		        dataType:'json',
		        success: function(data){
		        	if (data.am==1) {
		        		var info = '* Payment Failed';
		        		$("#amount_info").html(info).fadeIn().delay(3000).fadeOut();
		        		 $(overlay).fadeOut();
		        	}else{
		        		alert(data.su);
		        		location.reload();
		        	}
		        },
		        error: function(){
		          alert('error..!');
		        }
		    });
		}

	}else{

		var forw_date = $("#forw_date").val().trim();

		if (bill_no=='' || pay_id=='' || p_dated=='' || check_date=='' || amount=='' || status=='' || forw_date=='') {
			alert('Information Incomplete');
		}else{

			$(overlay).fadeIn();
			$.ajax({
		        type: 'POST',
		        url:li+'admin/create_payment_status_suspected',
		        data:{bill_no:bill_no,pay_id:pay_id,p_dated:p_dated,check_date:check_date,amount:amount,status:status,forw_date:forw_date,note:note},
		        dataType:'json',
		        success: function(data){
	        		if (data.am==1) {
		        		var info = '* Max Amount Crossed';
		        		$("#forw_info").html(info).fadeIn().delay(3000).fadeOut();
		        		 $(overlay).fadeOut();
		        	}else{
		        		alert(data.su);
		        		location.reload();
		        	}
		        },
		        error: function(){
		          alert('error..!');
		        }
		    });
		}

	}
}


//searching report
function search_bill_report(){

	var supp = $("#supp").val().trim();
	var explode = supp.split('*');
	var supp_id = explode[1];

	var start_dated = $("#start_dated").val().trim();
	var end_dated = $("#end_dated").val().trim();
	var status = $("#status_s").val().trim();
	var pay_date = $("#pay_dated").val().trim();

	var detect = $("#detect").val().trim();

	$.ajax({
	    type: 'POST',
	    url:li+'admin/search_bill_report',
	    data:{supp_id:supp_id,start_dated:start_dated,end_dated:end_dated,status:status,pay_date:pay_date},
	    dataType:'json',
	    success: function(data){
	    	if (data==false) {
	    		alert('No Data Found');
	    	}else{
	    		//alert(data);
	    		$(overlay).fadeIn();
	    		var i;
	            var thirdS='';
	        	for(i=0; i<data.length;i++){
			        var amount = data[i].amount;	        
			        var supp_name = data[i].name;	        
			        var id = data[i].id;	        
			        var dated = data[i].dated;	        
			        var service = data[i].service;	        
			        var pay_date = data[i].pay_date;	        
			        var statu = data[i].status;

			        if (pay_date=='0000-00-00') { var pp_da = ''}else{
			        	var pp_da = pay_date;
			        }

			        if (statu==0) {var status='<button class="btn btn-sm btn-danger" disabled>Pending</button>'}
			        else if (statu==2) {var status='<button class="btn btn-sm btn-warning" disabled>Under Payment</button>'}
			        else if (statu==1) {var status='<button class="btn btn-sm btn-success" disabled>Paid</button>'}
			        else if (statu==4) {var status='<button class="btn btn-sm btn-primary" disabled>unpaid</button>'}


			       if (detect==1 && statu==0 && pay_date=='0000-00-00') {var linkss = 'class="btn mybtn btn-info" href="#modal_pay" value='+id+' data-toggle="modal" onclick="return payment_window(this)"'}
			       else if (detect==2 && statu==0 && pay_date !=='0000-00-00') {var linkss = 'class="btn mybtn btn-info" href="#modal_pay" value='+id+' data-toggle="modal" onclick="return payment_window(this)"'}
			       else{ var linkss = 'class="btn mybtn"'; }


			        thirdS += '<tr>'+
		        			'<td>'+id+'</td>'+
		        			'<td><button '+linkss+'>'+supp_name+'</button></td>'+
		        			'<td>'+dated+'</td>'+
		        			'<td class="text-right"><b>'+amount+'</b></td>'+
		        			'<td>'+service+'</td>'+
		        			'<td>'+status+'</td>'+
		        			'<td>'+pp_da+'</td>'+
        				'</tr>';

        			
        			$(overlay).fadeOut();
        			$("#bill_table_data").html(thirdS);

		        }

	    	}
	    },
	    error: function(){
	      alert('searching error..!');
	    }
	});

}

function max_pay_show_m(my){
	var max_id = $(my).val().trim();
	if (max_id=='') {
		alert('none');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/max_pay_show_m',
	        data:{max_id:max_id},
	        dataType:'json',
	        success: function(data){

	           $("#max_idd").val(data.id);
	           $("#max_amount").val(data.amount);
	           $("#max_dated").val(data.dated);

	           $("#max_dated").html(data.dated);


	           $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}
function  max_pay_update(){
	var id = $("#max_idd").val().trim();
	var dated = $("#max_dated").val().trim();
	var amount = $("#max_amount").val().trim();

	if (dated=='' || amount=='' || id=='') {
		alert('Information Incomplete');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/max_pay_update',
	        data:{dated:dated,amount:amount,id:id},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           location.reload();
	           $(overlay).fadeOut();
	           $("#amount").val('');

	           $("#amount").focus();	    	
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}

function bank_up_m(my){
	var bank_id = $(my).val().trim();
	if (bank_id=='') {
		alert('none');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/bank_up_m',
	        data:{bank_id:bank_id},
	        dataType:'json',
	        success: function(data){

	           $("#bank_idd").val(data.id);
	           $("#bank_nme_up").val(data.name);
	           $("#acc_no_up").val(data.acc_no);

	           $("#bank_nams").html(data.name);


	           $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}
function  bank_update(){
	var id = $("#bank_idd").val().trim();
	var name = $("#bank_nme_up").val().trim();
	var acc_no = $("#acc_no_up").val().trim();

	if (acc_no=='' || name=='' || id=='') {
		alert('Information Incomplete');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/bank_update',
	        data:{acc_no:acc_no,name:name,id:id},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           location.reload();
	           $(overlay).fadeOut();
	           $("#amount").val('');

	           $("#amount").focus();	    	
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}
function supplier_up(my){
	var supp_id = $(my).val().trim();
	if (supp_id=='') {
		alert('none');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/supplier_up',
	        data:{supp_id:supp_id},
	        dataType:'json',
	        success: function(data){

	           $("#supp_id").val(data.id);
	           $("#ssupp_name").val(data.name);
	           $("#ssupp_phone").val(data.phone);
	           $("#supp_address").val(data.address);

	           $("#ssupp_named").html(data.name);


	           $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}
function  supplier_updates(){
	var id = $("#supp_id").val().trim();
	var name = $("#ssupp_name").val().trim();
	var phone = $("#ssupp_phone").val().trim();
	var address = $("#supp_address").val().trim();

	if (phone=='' || name=='' || address=='' || id=='') {
		alert('Information Incomplete');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/supplier_updates',
	        data:{phone:phone,name:name,id:id,address:address},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           location.reload();
	           $(overlay).fadeOut();
	           $("#amount").val('');

	           $("#amount").focus();	    	
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}
function bill_up(my){
	var bill_id = $(my).val().trim();
	if (bill_id=='') {
		alert('none');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/bill_up',
	        data:{bill_id:bill_id},
	        dataType:'json',
	        success: function(data){

	           $("#bill_ids").val(data.id);

	           $("#suppss").val(data.supp_name+'*'+data.supp_ids);

	           $("#bss_date").val(data.dated);
	           $("#servicess").val(data.service);

	           $("#amountss").val(data.amount);

	           $("#bill_no").html(data.supp_name);


	           $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}
function  update_bill(){
	var id = $("#bill_ids").val().trim();

	var supp_id = $("#suppss").val().trim();
	var explode = supp_id.split('*');
	var supp = explode[1];

	var service = $("#servicess").val().trim();
	var dated = $("#bss_date").val().trim();
	var amount = $("#amountss").val().trim();

	if (supp=='' || amount=='' || dated=='' || id=='') {
		alert('Information Incomplete');
	}else{
	    $(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/update_bill',
	        data:{supp:supp,amount:amount,id:id,dated:dated,service:service},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           location.reload();
	           $(overlay).fadeOut();
	           $("#amount").val('');

	           $("#amount").focus();	    	
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
}





function create_paydate_up(){
	var bill_id = $("#bill_id").val().trim();
	var pay_date = $("#pay_date").val().trim();
	var amount = $("#amount").val().trim();
	var bill_date = $("#bill_date").val().trim();

	if (bill_id=='' || pay_date=='' || bill_date=='' || bill_date=='') {
		alert('Information Incomplete');
	}else{

		$(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'admin/create_paydate_up',
	        data:{bill_id:bill_id,pay_date:pay_date,amount:amount,bill_date:bill_date},
	        dataType:'json',
	        success: function(data){
	        	if (data.am==1) {
	        		var info = '* Max Amount Crossed';
	        		$("#amount_info").html(info).fadeIn().delay(3000).fadeOut();
	        		 $(overlay).fadeOut();
	        	}else{
	        		alert(data.su);
	        		location.reload();
	        	}
	        },
	        error: function(){
	          alert('error..!');
	        }
	    });
	}
	
}
