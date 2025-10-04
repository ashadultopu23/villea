
(function ($) {
    // Handle Add to Compare
    $(document).on("click", ".add-to-compare", function (e) {
        e.preventDefault();
        let id = $(this).data("id");
        let compare = JSON.parse(localStorage.getItem("compare")) || [];

        if (!compare.includes(id)) {
            compare.push(id);
            localStorage.setItem("compare", JSON.stringify(compare));
            showCompareToast();
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

        // Refresh page with updated IDs
        if (compare.length > 0) {
            // let url = "/compare/?ids=" + compare.join(",");
            // window.location.href = url;
            let url = myTheme.siteUrl + '/compare/?ids=' + compare.join(',');
            window.location.href = url;

        } else {
            // window.location.href = "/compare/"; // Empty compare page
            let url = myTheme.siteUrl + '/compare/'; // Empty compare page
            window.location.href = url;
        }
    });

    // Toast function
    function showCompareToast(already = false) {
        $("#compare-toast").remove();
        let compare = JSON.parse(localStorage.getItem("compare")) || [];
        let url = "/compare/?ids=" + compare.join(",");
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
