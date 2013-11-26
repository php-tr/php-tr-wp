<h2>Perform an alternative search instead</h2>
<div id="cse" style="width: 100%;">Loading</div>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript"> 
    google.load('search', '1', {language : 'en', style : google.loader.themes.MINIMALIST});
    google.setOnLoadCallback(function() {
        var customSearchOptions = {};
        var customSearchControl = new google.search.CustomSearchControl('<?php echo get_option('phpmanual_google_custom_search_api_key')?>', customSearchOptions);
        customSearchControl.setLinkTarget(google.search.Search.LINK_TARGET_SELF);
        customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
        var options = new google.search.DrawOptions();
        options.setAutoComplete(true);
        customSearchControl.draw('cse', options);
        customSearchControl.execute("<?php echo get_search_query(); ?>");  }, true);
        </script>