<?php

class ZumrutSnippetsProductsTable {
    public function __construct() {
        add_filter('manage_edit-product_columns', array($this, 'modify_product_columns'));
    }
    public function modify_product_columns($columns) {
        if (isset($columns['sku'])) {
            unset($columns['sku']);
        }
        if (isset($columns['brand'])) {
            unset($columns['brand']);
        }
        if (isset($columns['product_tag'])) {
            unset($columns['product_tag']);
        }
        return $columns;
    }
}