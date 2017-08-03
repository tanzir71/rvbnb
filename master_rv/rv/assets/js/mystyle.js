var li=links(); //global declare



$( function() {
  $( "#slider-range" ).slider({
    range: true,
    min: 0,
    max: 60,
    values: [ 5, 55 ],
    slide: function( event, ui ) {
      $( "#amount" ).val( "" + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
    }
  });
  $( "#amount" ).val( "" + $( "#slider-range" ).slider( "values", 0 ) +
    " - " + $( "#slider-range" ).slider( "values", 1 ) );
} );


$( function() {
  $( "#from_date" ).datepicker({ minDate: 0, dateFormat: 'yy-mm-dd'});
  $( "#to_date" ).datepicker({ minDate: 0, dateFormat: 'yy-mm-dd'});
} );

var dateToday = new Date();
var dates = $("#from, #to").datepicker({
    defaultDate: "+1w",
    changeMonth: true,
    format: 'YYYY-MM-DD',
    numberOfMonths: 1,
    dateFormat: 'yy-mm-dd',
    minDate: dateToday,

    onSelect: function(selectedDate) {
      var option = this.id == "from" ? "minDate" : "maxDate",
      instance = $(this).data("datepicker"),
      date = $.datepicker.parseDate(instance.settings.dateFormat || $.datepicker._defaults.dateFormat, selectedDate, instance.settings);
      dates.not(this).datepicker("option", "showAnim", 'slide');
    }
});
$( "#from, #to" ).datepicker( "option", "showAnim", 'slide');

$("#location_input").keyup(function(){
      
    var v=$("#location_input").val();
  
    if(v != ''){
    
      $('#location_input').addClass('ac_loading');        
          
      $("#location_input").autocomplete({
          source: function( request, response ) {
      
          $.ajax({
        
            type:'POST',
            dataType:'json',
            url:li+'home/autocomplete_view',
            data:{id:v},
            success:function(data)
            {
                response(data);
            }
            
          });         
            
          $("#location_input").removeClass('ac_loading');

        }   
      
      });
    }
});

function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('maps'), {
    center: {lat: 36.1848607, lng: -95.9798563},
    zoom: 4,
    draggable: true
  });
}

$("#final_search").click(function(){
  var input_data = $('#location_input').val().trim();
  var from = $('#from').val().trim();
  var to = $('#to').val().trim();

  if (input_data=='' && from=='' && to=='') {
    alert('Information Incomplete');
  }else{

    $.ajax({
      type: 'POST',
      url:li+'home/location_data',
      data:{input_data:input_data,from:from,to:to},
      dataType:'json',
      success: function(data){

        if(data.final==false){
          alert('No Data Found.');
        }else{
          var datas = data.final;
          var i;
          var full_data='';
          for(i=0; i<datas.length;i++){
            var location = datas[i].location;
            var amount = datas[i].amount;
            var id = datas[i].id;
            var title = datas[i].title;
            var email = datas[i].email;
            var phone_number = datas[i].phone_number;
            var from_date = datas[i].from_date;
            var to_date = datas[i].to_date;

            full_data += '<div class="col-md-6 col-sm-6">'+
              '<div class="listing mob-space30 space30">'+
                  '<div class="listing-img bg-image" style="background: rgba(0, 0, 0, 0) url(&quot;'+li+'assets/images/host/'+id+'.jpg";) no-repeat scroll center center / cover ;">'+
                      '<div class="li-overlay">'+
                        '<div class="li-overlay-inner">'+
                          '<a href="#" class="mail"></a>'+
                          '<a href="#" class="menu"></a>'+
                          '<a href="#" class="link"></a>'+
                        '</div>'+
                      '</div>'+
                  '</div>'+
                  '<div class="listing-info">'+
                      '<h4 class="li-name"><a href="'+li+'home/host_rv/'+id+'/'+title.split(' ').join('-')+'" target="_blank">'+title+'</a></h4>'+
                      '<ul class="list-icon">'+
                        '<li> <i class="pe-7s-map-marker"></i>'+location+'</li>'+
                        '<li> <i class="pe-7s-call"></i> '+phone_number+'</li>'+
                        '<li> <i class="pe-7s-mail"></i> <a href="mailto:'+email+'">'+email+'</a> </li>'+
                      '</ul>'+
                      '<div class="list-ratings"><i class="fa fa-usd" aria-hidden="true"></i>'+amount+'</div>'+
                  '</div>'+
              '</div>'+
          '</div>';

          $("#filterig_result").html(full_data);

          
            geocoder = new google.maps.Geocoder();
            var mapOptions = 
            {
              zoom: 12
            }
            map = new google.maps.Map(document.getElementById('maps'), mapOptions);
            codeAddress(location,amount,id,title);//call the function

            //full_module(location,amount,id,title,email,phone_number);//call the function

          }

        }
        //$("#demo").html(thirdS);
      },
      error: function(){
        alert('error..!');
      }
    });

  }

});


function codeAddress(address,amount,id,title) 
{
  geocoder.geocode( {address:address}, function(results, status) 
  {
    if (status == google.maps.GeocoderStatus.OK) 
    {
      map.setCenter(results[0].geometry.location);//center the map over the result
      //place a marker at the location
      var marker = new google.maps.InfoWindow(
      {
          map: map,
          position: results[0].geometry.location,
          zoom: 16,

          content: '<a href="'+li+'home/host_rv/'+id+'/'+title.split(' ').join('-')+'" target="_blank"><i class="fa fa-usd" aria-hidden="true"></i>'+amount+'</a>'
      });
    } else {
      alert('Geocode was not successful for the following reason: ' + status);
   }
  });
}

$("#con_pass").blur(function(){
  var pass_up = $("#pass_up").val().trim();
  var con_pass = $("#con_pass").val().trim();


  if (pass_up == con_pass) {
    $("#match_result").html('Password Match');
  }else{
    $("#match_result").html('Password not Match');
  }
});







function initialize_search() {
  var search_country = document.getElementById('search_country');
  var autocomplete = new google.maps.places.Autocomplete(search_country);

  var search_state = document.getElementById('search_state');
  var autocomplete = new google.maps.places.Autocomplete(search_state);

  var search_city = document.getElementById('search_city');
  var autocomplete = new google.maps.places.Autocomplete(search_city);

  var search_borough = document.getElementById('search_borough');
  var autocomplete = new google.maps.places.Autocomplete(search_borough);
}
google.maps.event.addDomListener(window, 'load', initialize_search);