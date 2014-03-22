<?php
class Abstract_Table_Row extends Zend_Db_Table_Row_Abstract
{
    public function toStdObject(){
        $obj_data = new stdClass();
        $arr_data = (array)$this->_data;
        foreach ($arr_data as $key => $value){
            $obj_data->$key = $value;
        }

        return $obj_data;
    }

    /**
     * Overwrite the toArray to convert nested objects as well into array
     * @return array|void
     */
    public function toArray()
    {
        $rowData = (array)$this->_data;
        foreach($rowData as $key => $field) {
            if(is_object($field) && method_exists($field, 'toArray')) {
                $rowData[$key] = $field->toArray();
            }
        }
        //var_dump($rowData); exit;
        return $rowData;
    }
}