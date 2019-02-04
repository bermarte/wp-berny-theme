
 $(document).ready(function () {
     
     var iframeWidth  = $('iframe:nth-child(1)').contents().width();
     console.log(iframeWidth);
     var iframeHeight  = $('iframe:nth-child(1)').contents().height();
     console.log(iframeHeight);
     
     total = iframeHeight * 4;
     $(".videos").css('height', total + 'px');
       
     $(".videoWrapper iframe:nth-child(1)").css('height', (iframeWidth/2) + 'px');
     $(".videoWrapper iframe:nth-child(2)").css('height', (iframeWidth/2) + 'px');
     $(".videoWrapper iframe:nth-child(3)").css('height', (iframeWidth/2) + 'px');
     $(".videoWrapper iframe:nth-child(4)").css('height', (iframeWidth/2) + 'px');
     $(".videoWrapper iframe:nth-child(5)").css('height', (iframeWidth/2) + 'px');
     $(".videoWrapper iframe:nth-child(6)").css('height', (iframeWidth/2) + 'px');
     $(".videoWrapper iframe:nth-child(7)").css('height', (iframeWidth/2) + 'px');
     $(".videoWrapper iframe:nth-child(8)").css('height', (iframeWidth/2) + 'px');

     $(".videoWrapper iframe:nth-child(3)").css('top', (iframeWidth/2) + 'px');
     $(".videoWrapper iframe:nth-child(4)").css('top', (iframeWidth/2) + 'px');
     $(".videoWrapper iframe:nth-child(5)").css('top', (iframeWidth) + 'px');
     $(".videoWrapper iframe:nth-child(6)").css('top', (iframeWidth) + 'px');
     $(".videoWrapper iframe:nth-child(7)").css('top', (iframeWidth + (iframeWidth/2)) + 'px');
     $(".videoWrapper iframe:nth-child(8)").css('top', (iframeWidth + (iframeWidth/2)) + 'px');

 });
 
    

