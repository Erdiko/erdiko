<?php
class Abstract_Table_Rowset extends Zend_Db_Table_Rowset_Abstract
{
    public function toStdObjects(){
        $arr_rowset = array();
        foreach ($this as $key => $row){
            $arr_rowset[] = $row->toStdObject();
        }
        unset($this);
        return $arr_rowset;
    }
    /**
     * Loops through the rowset and returns the guven column values as an array
     *
     * @param String $columnName
     */
    public function toColumnArray($columnName)
    {
        $arr_column = array();
        foreach ($this as $row)
        {
            $arr_column[] = $row->$columnName;
        }

        return $arr_column;
    }

    public function toPkArray()
    {
        $pk = $this->_table->getPrimary();
        if(!is_array($pk)) {
            return $this->toColumnArray($pk);
        }
        // @todo: consider multikey tables and return those columns
        return null;
    }
}