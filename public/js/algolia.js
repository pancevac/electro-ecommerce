(function() {
    var client = algoliasearch('0F0EEPKTJA', 'be26d178fdbb270eae98ef4e0ae09540');
    var index = client.initIndex('products');
    //initialize autocomplete on search input (ID selector must match)
    autocomplete('#aa-search-input',
        { hint: false }, {
            source: autocomplete.sources.hits(index, {hitsPerPage: 5}),
            //value to be displayed in input control after user's suggestion selection
            displayKey: 'name',
            //hash of templates used when rendering dataset
            templates: {
                //'suggestion' templating function used to render a single suggestion
                suggestion: function(suggestion) {
                    /*return '<span>' +
                        suggestion._highlightResult.name.value + '</span><span>' +
                        suggestion.price + '</span>';*/
                    return '<span>' + suggestion._highlightResult.name.value + '</span>' +
                        /*'<div class="search-desc">'+ suggestion.description +'</div>' +*/
                        '<span style="float:left">$' + suggestion.price + '</span>' +
                        '<img src="'+ window.location.origin+'/storage/' + suggestion.image + '" class="search-thumb">';
                },
                empty: function (result) {
                    return 'No result for "' + result.query + '"';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
            window.location.href = window.location.origin + '/product/' + suggestion.id;
    });
})();