 $(document).ready(function () {

     $("#masonry").lightGallery({
         selector: '.item',
         thumbnail: 'true',
         thumbWidth: 50
     });
     
     $("#masonry").on('onAfterOpen.lg',function(event){
            //remove width of div containing thumbs
            //take the value 95% from img.css
            $('.lg-group.lg-thumb').css('width', '');
     });

     var container = document.querySelector('#masonry');
     var msnry = new Masonry(container, {
         isFitWidth: true,
         columnWidth: 50,
         itemSelector: '.item'
     });
 });


/* http://sachinchoolur.github.io/lightGallery/docs/api.html */
