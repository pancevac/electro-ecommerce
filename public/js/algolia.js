(function() {
    var client = algoliasearch('0F0EEPKTJA', 'be26d178fdbb270eae98ef4e0ae09540');
    var index = client.initIndex('products');
    let locale = document.documentElement.lang;
    //console.log(locale);
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

                    if (suggestion._highlightResult) {

                      return '<span>' + suggestion._highlightResult[locale].name.value + '</span>' +
                        /*'<div class="search-desc">'+ suggestion.description +'</div>' +*/
                        '<img src="'+ suggestion.image + '" class="search-thumb">';
                    }

                },
                empty: function (result) {
                    return 'No result for "' + result.query + '"';
                }
            }
        }).on('autocomplete:selected', function (event, suggestion, dataset) {
            window.location.href = suggestion[locale].link;
    });
})();