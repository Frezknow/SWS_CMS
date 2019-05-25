$(document).ready(function(){
  $('#alphaDropdownLink').hover(function(){
    $('#alphaDropdownMenu').fadeIn(500);
  });
  
});

$(document).on('click','.menuButton',function(){
  $('.links2').slideToggle('slow');
});
