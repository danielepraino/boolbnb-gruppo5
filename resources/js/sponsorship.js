
$(".setPrice").each(function() {
  $(this).click(function () {
    var prezzo = $(this).find('#prezzo').text();
    console.log(prezzo);
    $('#amount').val(prezzo);
  })
});
