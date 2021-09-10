<?php

function sess_start() {
    if (!session_id())
        session_start();
}
add_action('init','sess_start');