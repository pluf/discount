<?php

class Discount_Discount extends Pluf_Model
{

    /**
     * @brief مدل داده‌ای را بارگذاری می‌کند.
     *
     * @see Pluf_Model::init()
     */
    function init()
    {
        $this->_a['table'] = 'discount_discount';
        $this->_a['verbose'] = 'Discount Entity';
        $this->_a['cols'] = array(
            'id' => array(
                'type' => 'Pluf_DB_Field_Sequence',
                'blank' => false,
                'editable' => false,
                'readable' => true
            ),
            'code' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 25,
                'editable' => true,
                'readable' => true
            ),
            'type' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 50,
                'editable' => true,
                'readable' => true
            ),
            'count' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'default' => 1,
                'editable' => false,
                'readable' => true
            ),
            'remain_count' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'default' => 1,
                'editable' => false,
                'readable' => true
            ),
            'off_value' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'default' => 0,
                'editable' => true,
                'readable' => true
            ),
            'name' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'creation_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            'expiry_dtime' => array(
                'type' => 'Pluf_DB_Field_Datetime',
                'blank' => true,
                'editable' => false,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'properties' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => false,
                'size' => 500,
                'editable' => true,
                'readable' => true
            ),
            // relations
            'user' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'Pluf_User',
                'blank' => true,
                'relate_name' => 'user',
                'editable' => true,
                'readable' => true
            )
        );
        
        $this->_a['idx'] = array(
            'discount_idx' => array(
                'col' => 'parent, name',
                'type' => 'unique', // normal, unique, fulltext, spatial
                'index_type' => '', // hash, btree
                'index_option' => '',
                'algorithm_option' => '',
                'lock_option' => ''
            )
        );
    }

    /**
     * \brief پیش ذخیره را انجام می‌دهد
     *
     * @param $create حالت
     *            ساخت یا به روز رسانی را تعیین می‌کند
     */
    function preSave($create = false)
    {
        if ($this->id == '') {
            $this->creation_dtime = gmdate('Y-m-d H:i:s');
        }
    }

}