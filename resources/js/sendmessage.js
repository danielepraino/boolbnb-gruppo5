// $('#send-btn').click(function() {
//   $.ajax({
//     headers: {
//
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//
//         },
//   url:"http://127.0.0.1:8000/sendmessage",
//   type: "POST",
//   data: {
//     flat_id: $('#flat_id').val(),
//     sender: $('#sender').val(),
//     subject: $('#subject').val(),
//     message: $('#message').val(),
//
//   },
//   success:function(data){
//
//   alert(data.success);
//
//   },
//   error: function(){
//
//   alert('errore');
//   }
//   });
//
// });
