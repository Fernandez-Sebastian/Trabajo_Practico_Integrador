$(document).ready(function(){
    const imgItems = $(".slider li").length;
    let imgPos = 1;

for(let i = 1; i<= imgItems; i++){
    $(".pagination").append('<li><i class="bi bi-circle-fill"></i></li>');
}

$(".slider li").hide();
$(".slider li:first").show();
$(".pagination li:first").css({"color": "#CD6E2E"});

$(".pagination li").click(pagination);
$(".right i").click(nextSlider);
$(".left i").click(prevSlider);

setInterval(function(){
    nextSlider()
}, 4000);

//FUNCIONES ===============================
function pagination(){
    const paginationPos = $(this).index()+ 1;
    $(".slider li").hide();
    $('.slider li:nth-child('+ paginationPos +')').fadeIn();
$(".pagination li").css({"color": "#ffffff"});
    $(this).css({"color": "#CD6E2E"});

imgPos =paginationPos;
}


function nextSlider(){
if(imgPos >= imgItems){
    imgPos = 1;
}else {imgPos++;}

$(".pagination li").css({"color": "#ffffff"});
$('.pagination li:nth-child('+ imgPos +')').css({"color": "#CD6E2E"});

    $(".slider li").hide();
    $('.slider li:nth-child('+ imgPos +')').fadeIn();
}

function prevSlider(){
    if(imgPos <= 1 ){
        imgPos = imgItems;
    }else {imgPos--;}
    
    $(".pagination li").css({"color": "#ffffff"});
    $('.pagination li:nth-child('+ imgPos +')').css({"color": "#CD6E2E"});
    
        $(".slider li").hide();
        $('.slider li:nth-child('+ imgPos +')').fadeIn();
    }


})