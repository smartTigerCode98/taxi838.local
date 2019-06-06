
var elements = $('.modal-overlay, .modal');

var elementsSecond = $('.modal2, .modal');

$('#n1').click(function(){
    elements.addClass('active');
});


$('.close-modal').click(function(){
    elements.removeClass('active');
});


$('#msgSuccessAddOrder').click(function(){
    elementsSecond.addClass('active');
});