<li id="headsearch">
    <form method="get" action="<?php echo home_url( '/' ); ?>" id="topsearch">
      <fieldset>
        <input type="text" id="headsearch-keywords" name="s" value="<?php echo get_search_query(); ?>" placeholder="Search..." size="30" accesskey="s" id="s" />
        <input type="submit"
          value="Go"
          id="headsearch-submit"
          class="submit" />
       </fieldset>
    </form>
  </li>