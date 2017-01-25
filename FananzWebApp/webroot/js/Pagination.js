
        jQuery(document).ready(function () {
            jQuery("div.holder").jPages({
                containerID: "portfolioUl",
                perPage: 9,
                keyBrowse: true,
                scrollBrowse: false,
                animation: "bounceIn",
                callback: function (pages,
        items) {
                    jQuery("#legend1").html("Page " + pages.current + " of " + pages.count);
                   // jQuery("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                }
            });
//            jQuery("button").click(function () {
//                /* get given page */
//                var page = parseInt(jQuery("input").val());
//                /* jump to that page */
//                jQuery("div.holder").jPages(page);
//            });

            jQuery("select#Itemsperpage").change(function () {
                /* get new no of items per page */
                var newPerPage = parseInt(jQuery(this).val());
                /* destroy jPages and initiate plugin again */
                jQuery("div.holder").jPages("destroy").jPages({
                    containerID: "portfolioUl",
                    perPage: newPerPage,
                    keyBrowse: true,
                    scrollBrowse: false,
                    animation: "bounceIn",
                    callback: function (pages,
        items) {
                        jQuery("#legend1").html("Page " + pages.current + " of " + pages.count);
                      //  jQuery("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
                    }
                });
            });
//            jQuery("select#Animation").change(function () {
//                /* get new css animation */
//                var newAnimation = jQuery(this).val();
//                /* destroy jPages and initiate plugin again */
//                jQuery("div.holder").jPages("destroy").jPages({
//                    containerID: "portfolioUl",
//                    animation: newAnimation,
//                    keyBrowse: true,
//                    scrollBrowse: true,
//                    callback: function (pages,
//        items) {
//                        jQuery("#legend1").html("Page " + pages.current + " of " + pages.count);
//                        jQuery("#legend2").html("Elements "+items.range.start + " - " + items.range.end + " of " + items.count);
//                    }
//                });
//            });
        });
    
    