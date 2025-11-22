jQuery(function($){

    function runAjaxFilter() {

        // Collect selected categories
        let selectedCats = [];
        $('.wc-cat-filter:checked').each(function(){
            let cat = $(this).data('cat');
            if(cat !== 'all') {
                selectedCats.push(cat);
            }
        });

        if(selectedCats.length === 0) {
            selectedCats = 'all';
        }

        // Collect selected sizes
        let selectedSizes = [];
        $('.wc-size-filter:checked').each(function(){
            selectedSizes.push($(this).data('size'));
        });

        $.ajax({
            url: ajax_object.ajax_url,
            type: "POST",
            data: {
                action: "filter_products",
                categories: selectedCats,
                sizes: selectedSizes
            },
            beforeSend: function() {
                $('.products').css('opacity', '0.4');
            },
            success: function(data) {
                $('.products').html(data);
                $('.products').css('opacity', '1');
            }
        });
    }

    // Category change
    $('.wc-cat-filter').on('change', function(){
        let clickedCat = $(this).data('cat');

        if(clickedCat === 'all') {
            $('.wc-cat-filter').not(this).prop('checked', false);
        } else {
            $('#cat-all').prop('checked', false);
        }

        runAjaxFilter();
    });

    // Size change
    $('.wc-size-filter').on('change', function(){
        runAjaxFilter();
    });

});
