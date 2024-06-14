$(document).ready(function() {
    $('#search').on('keyup', function() {
        var searchTerm = $(this).val();
        $.ajax({
            url: 'search.php',
            method: 'POST',
            data: { query: searchTerm },
            success: function(response) {
                $('#articles').html(response);
            }
        });
    });

    $('#sort-date').on('change', function() {
        var sort = $(this).val();
        $.ajax({
            url: 'search.php',
            method: 'POST',
            data: { sort: sort },
            success: function(response) {
                $('#articles').html(response);
            }
        });
    });
});
