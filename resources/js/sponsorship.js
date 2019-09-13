$(".setPrice").each(function() {
  $(this).click(function () {
    var prezzo = $(this).find('#prezzo').text();
    $('#amount').val(prezzo);

    var durata = $(this).attr("name");
    $('#duration').val(durata);
    console.log(durata);
  });
});


$.ajax({
         url: sponsorship.store,
         method:"POST",
         data:{room:room, bed:bed[0], wifi:wifi[0], parking:parking[0], pool:pool[0], concierge:concierge[0], sauna:sauna[0], sea_view:sea_view[0]},
         success:function(data){
         },
         'error': function (error) {
           console.log(error);
         }
     });
