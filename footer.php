</layout>
</div>
<footer>
    <div class="footer-content">
        <ul class="footmenu copyright">
            <li><a href="/copyright.php">Copyright &copy; <?php echo get_bloginfo('name'); ?></a></li>
        </ul>
        <ul class="footmenu">
            <?php
                $menu_items = get_footer_links();
                if($menu_items): 
                    foreach($menu_items as $menu_item): if($menu_item->menu_item_parent != 0) continue; ?>
                    <li class="parent "><a href="<?php echo $menu_item->url; ?>" class="menu-link"><?php echo $menu_item->title; ?></a></li>
                    <?php endforeach;?>
                <?php endif; ?>
        </ul>
    </div>
  </footer>
  <?php wp_head(); ?>
</body>
</html>