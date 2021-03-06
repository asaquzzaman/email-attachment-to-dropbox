<?php
$menu = mdrop_page();
?>
<h2 class="nav-tab-wrapper">
    <?php

    foreach ( $menu[$page] as $tab_key => $tab_event ) {

        $active = ( $tab == $tab_key ) ? 'nav-tab-active' : '';
        $url = mdrop_tab_menu_url( $tab_key, $page );
        printf( '<a href="%1$s" class="nav-tab %4$s" id="%2$s-tab">%3$s</a>',$url, $tab_event['id'], $tab_event['title'], $active );
    }

    ?>
</h2>
<?php
if ( ! $subtab ) {
   if( !isset( $menu[$page][$tab]['submenu'] ) ) {
        return;
    }

    if ( !count( $menu[$page][$tab]['submenu'] ) ) {
        return;
    }

    $subtab = key( $menu[$page][$tab]['submenu'] );
}


?>
<h3 class="hrm-sub-nav">
    <ul class="hrm-subsubsub">
        <?php
            foreach ( $menu[$page][$tab]['submenu'] as $sub_key => $sub_event ) {
                if ( ! hrm_user_can_access( $page, $tab, $sub_key, 'view' ) ) {
                    continue;
                }

                $sub_active = ( $sub_key == $subtab ) ? 'hrm-sub-current' : '';
                $sub_event['id'] = isset( $sub_event['id'] ) ? $sub_event['id'] : '';
                $sub_url = hrm_subtab_menu_url( $tab, $sub_key, $page );
                printf( '<li><a class="%4$s" href="%1$s" id="%2$s-tab">%3$s</a></li> | ',$sub_url , $sub_event['id'], $sub_event['title'], $sub_active );
            }
        ?>
    </ul>
</h3>
