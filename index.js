

$(document).ready(function(){
//banner owl carousel

$("#banner-area .owl-carousel").owlCarousel({
    dots:true,
   loop:true,
    items:1,
    margin:10,
    autoHeight:true
});
//top sale owl carousel
$("#top-sale .owl-carousel").owlCarousel({
    dots:false,
    loop:true,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
//isotope filter
var $grid=$(".grid").isotope({
    itemSelector : '.grid-item',
    layoutMode : 'fitRows'
})
}); 
//filter items on button click

// isotope filter
    var $grid = $(".grid").isotope({
        itemSelector : '.grid-item',
        layoutMode : 'fitRows'
    });

    // filter items on button click
    $(".btn-group").on("click", "button", function(){
        var filterValue = $(this).attr('data-filter');
        $grid.isotope({ filter: filterValue});
    })

    //top sale owl carousel
$("#new-comers .owl-carousel").owlCarousel({
    dots:false,
    loop:true,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
$("products-imgs .owl-carousel").owlCarousel({
    dots:false,
    loop:true,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
// product qty section

let $qty_up = $(".qty .qty-up");
let $qty_down = $(".qty .qty-down");
let $input = $(".qty .qty_input");

// click on qty up button
$qty_up.click(function(e){
    if($input.val() >= 1 && $input.val() <= 9){
        $input.val(function(i, oldval){
            return ++oldval;
        });
    }
});

   // click on qty down button
function quan_down($id){
    $input = document.getElementById($id);
if($input.val() > 1 && $input.val() <= 10){
    $input.val(function(i, oldval){
        return --oldval;
        });
    }
}

        const imgs = document.querySelectorAll('.img-select -a');
        const imgBtns = [...imgs];
        let imgId = 1;

        imgBtns.forEach((imgItem) => {
            imgItem.addEventListener('click', (event) => {
                event.preventDefault();
                imgId = imgItem.dataset.id;
                slideImage();
            });
        });

        function slideImage(){
            const displayWidth = document.querySelector('.img-showcase img:first-child').clientWidth;

            document.querySelector('.img-showcase').style.transform = `translateX(${- (imgId - 1) * displayWidth}px)`;
        }

        window.addEventListener('resize', slideImage);


