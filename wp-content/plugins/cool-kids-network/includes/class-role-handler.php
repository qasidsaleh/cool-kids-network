<?php
namespace CKN;

class RoleHandler {
    public static function add_roles() {
        add_role('cool_kid', 'Cool Kid', ['read' => true]);
        add_role('cooler_kid', 'Cooler Kid', ['read' => true]);
        add_role('coolest_kid', 'Coolest Kid', ['read' => true]);
    }

    public static function remove_roles() {
        remove_role('cool_kid');
        remove_role('cooler_kid');
        remove_role('coolest_kid');
    }
}
