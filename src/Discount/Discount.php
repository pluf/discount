<?php

class Discount_Discount extends Pluf_Model
{

    /**
     *
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
                'blank' => true,
                'is_null' => true,
                'default' => 1,
                'editable' => true,
                'readable' => true
            ),
            'remain_count' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => false,
                'default' => 0,
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
                'is_null' => true,
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
            'valid_day' => array(
                'type' => 'Pluf_DB_Field_Integer',
                'blank' => true,
                'is_null' => true,
                'default' => NULL,
                'editable' => true,
                'readable' => true
            ),
            'description' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 250,
                'editable' => true,
                'readable' => true
            ),
            'properties' => array(
                'type' => 'Pluf_DB_Field_Varchar',
                'blank' => true,
                'is_null' => true,
                'size' => 500,
                'editable' => true,
                'readable' => true
            ),
            // relations
            'user' => array(
                'type' => 'Pluf_DB_Field_Foreignkey',
                'model' => 'User',
                'blank' => true,
                'is_null' => true,
                'relate_name' => 'user',
                'editable' => true,
                'readable' => true
            )
        );

        $this->_a['idx'] = array(
            'discount_idx' => array(
                'col' => 'code',
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
     * @param
     *            $create
     */
    function preSave($create = false)
    {
        if ($this->id == '') {
            $this->creation_dtime = gmdate('Y-m-d H:i:s');
            $this->remain_count = $this->count;
        }
    }

    /**
     *
     * @return Discount_Engine
     */
    public function get_engine()
    {
        return Discount_Shortcuts_GetEngineOr404($this->type);
    }
}
