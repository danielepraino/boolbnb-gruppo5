
$(document).ready(function() {
  // single flat map
  var maplat = $('#lat').val();
  var maplon = $('#long').val();
  var addr = $('address').val();
  console.log(maplat);
  console.log(maplon);
  var map = L.map('singleflatmap').setView([maplat, maplon], 13);

  L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
   attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'}).addTo(map);

  L.marker([maplat, maplon]).bindPopup(addr).openPopup().addTo(map);
});
