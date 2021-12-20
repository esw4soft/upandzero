$(document).on("click",".codedaddydata a",function () {
    var iframeEle = $('<iframe  frameborder="0" width="100%" height="100%" scrolling="auto" id="jumpsrc"></iframe>');
    iframeEle.attr("src",$(this).data("url"));
    var boxIframe = $(".box-newspage");
    boxIframe.addClass("box-newspage-open");
    boxIframe.removeClass("box-newspage-close");
    // console.log($(this).data("url"));
    boxIframe.append(iframeEle);
});
window.closeParentPopup = function() {
    var boxIframe = $(".box-newspage");
    boxIframe.removeClass("box-newspage-open");
    boxIframe.addClass("box-newspage-close");
    boxIframe.empty();
    
}; 