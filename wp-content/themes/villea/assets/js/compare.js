(function ($) {
    // Handle Add to Compare
    $(document).on("click", ".add-to-compare", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        let compare = JSON.parse(localStorage.getItem("compare")) || [];

        if (!compare.includes(id)) {
            compare.push(id);
            localStorage.setItem("compare", JSON.stringify(compare));
            showCompareToast(false);
        } else {
            showCompareToast(true);
        }
    });

    // Handle Remove from Compare
    $(document).on("click", ".remove-compare-btn", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        let compare = JSON.parse(localStorage.getItem("compare")) || [];

        // Remove property from array
        compare = compare.filter(item => item != id);
        localStorage.setItem("compare", JSON.stringify(compare));

        // Redirect or empty compare
        let url = myTheme.siteUrl + '/compare/';
        if (compare.length > 0) {
            url += '?ids=' + compare.join(',');
        }
        window.location.href = url;
    });

    // Toast function
    function showCompareToast(already = false) {
        $("#compare-toast").remove();
        let compare = JSON.parse(localStorage.getItem("compare")) || [];
        let url = myTheme.siteUrl + '/compare/?ids=' + compare.join(',');

        let toast = $(`
            <div id="compare-toast" class="compare-toast">
                <p>${already ? "Property already in compare." : "Property added to compare."}</p>
                <a href="${url}" class="go-to-compare-btn">
                    Go to Compare (${compare.length})
                </a>
            </div>
        `);

        $("body").append(toast);
        toast.fadeIn();

        setTimeout(function () {
            toast.fadeOut(function () { $(this).remove(); });
        }, 5000);
    }
})(jQuery);

















// use the html structure below for the compare button
//<a href="javascript:void(0);" class="property-compare-button add-to-compare" data-id="<?php echo get_the_ID(); ?>" title="Compare">
//  <i class="fas fa-balance-scale-right"></i>
//</a>