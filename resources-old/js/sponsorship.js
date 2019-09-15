
$(".setPrice").each(function() {
  $(this).click(function () {
    var prezzo = $(this).find('#prezzo').text();
    $('#amount').val(prezzo);

    var durata = $(this).attr("name");
    $('#duration').val(durata);


    console.log(durata);
    console.log(prezzo);

    var searchFlatId = new URLSearchParams(window.location.search)
    var getFlatId = searchFlatId.get('flatId')
    console.log(getFlatId);

    var dataToPost = {
      'price': prezzo,
      'duration': durata,
      'flat_id': getFlatId
    }
    console.log(dataToPost);
  });
});


// function postToDb(methodType, url, data){
//   $.ajax({
//     url: url,
//     method: methodType,
//     data: data,
//     success: function(obj){
//     },
//     error: function() {
//     }
//   });
// }
//
// $.ajaxSetup({
//   headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//   }
// });
//
// $("#confPayment").click(function(e){
//     e.preventDefault();
//     postToDb('POST','sponsorship', dataToPost);
//     console.log(dataToPost);
//
// });
