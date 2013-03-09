<?php
abstract class Abstract_Table extends Zend_Db_Table_Abstract
{
    protected $_rowClass = 'Abstract_Table_Row';
    protected $_rowsetClass = 'Abstract_Table_Rowset';
    protected $_data = array();

    const DATA_TYPE_DEFAULT = 0;
    const DATA_TYPE_ARRAY = 10;
    const DATA_TYPE_ASSOC = 20;
    const DATA_TYPE_STDCLASS = 30;

    public function init()
    {
        return parent::init();
    }



    /**
     * Returns the first row of the find query
     *
     * @param Integer|Array $primary
     * @return Zend_Db_Table_Row
     */
    public function get($pk){

        // If the Primary Key is an Array
        if(is_array($pk)){
            // Call the parent's find method with dynamic amount of parameters
            return call_user_func_array(array($this,'find'), $pk)->current();
        }
        // The primary Key Is a single column
        return parent::find($pk)->current();
    }

    /**
     * Get the Number of queried rows.
     * The where clause is a filter in here: If It's null then count ALL records in table
     *
     * @param String $where
     * @return Integer
     */
    public function getCount($where=null){

        $select = $this->select()->from($this, 'count(*)');
        if ($where){
            $select = $select->where($where);
        }

        return $this->_db->fetchOne($select);
    }

    /**
     * Return all dependent tables' reference columns that
     * have existing link to the given row
     *
     * @param Integer|Array $pk
     * @return null|Array - no reference rows |
     *                      Array of all ref columns that are linked to the row
     */
    public function getRefColumns($pk){

        $arr_links = array();
        $curr = $this->get($pk);
        foreach($this->_dependentTables as $model){

            if($rowset = count($curr->findDependentRowset($model))){
                $arr_links[] = $model;
            }
        }

        return !empty($arr_links) ? $arr_links : null;
    }

    /**
     * Update by PK, Filtering the data and using the Row class
     *
     * @param Arary $arr_data
     * @param String $where
     */
    public function updateByPk($arr_data, $pk)
    {
        return $this->get($pk)->setFromArray($arr_data)->save();
    }

    /**
     * Update by PK, Filtering the data and using the Row class
     *
     * @param Arary $arr_data
     * @param String $where
     */
    public function updateByPkFiltered($arr_data, $pk, $arr_ex=array(), $htmlentities = true)
    {
        $this->_filterArray($arr_data, $arr_ex, $htmlentities);

        return $this->updateByPk($arr_data, $pk)->save();
    }

    /**
     * Delete By PK using the Row class
     *
     * @param $id - Integer OR Array
     * @return void
     */
    public function deleteByPk($pk){
        if($row = $this->get($pk)){
            $row -> delete();
            return true;
        }
        return false;
    }



    /**
     * clear the rowset from extra information and save as pure std objects
     *
     * @param Zend_Table_Rowset & $data
     * @return void
     */
    public function rowsetToStdObjects(& $data){
        $arr_rowset = array();
        foreach ($data as $key => $row){
            $arr_rowset[] = $row->toStdObject();
        }
        unset($data);
        return $arr_rowset;
    }


    /**
     * Quote values and place them into a piece of text with placeholders
     *
     * The placeholder is a question-mark; all placeholders will be replaced
     * with the quoted value.
     *
     * Accepts unlimited number of parameters, one for every question mark.
     *
     * @param string $text Text containing replacements
     * @return string
     */
    public function quoteIntoMany($text)
    {
        // get function arguments
        $args = func_get_args();

        // remove $text from the array
        array_shift($args);

        // check if the first parameter is an array and loop through that instead
        if (isset($args[0]) && is_array($args[0])) {
            $args = $args[0];
        }

        // replace each question mark with the respective value
        foreach ($args as $arg) {
            $text = preg_replace('/\?{1}/', $this->_db->quote($arg), $text, 1);
        }

        // return processed text
        return $text;
    }

    /**
     * ZEND's BUG FIX BY OVERWRITING
     * Called by parent table's class during delete() method.
     * This Will Delete in depth
     *
     * @param  string $parentTableClassname
     * @param  array  $primaryKey
     * @return int    Number of affected rows
     */
    public function _cascadeDelete($parentTableClassname, array $primaryKey)
    {
        $rowsAffected = 0;
        foreach ($this->_getReferenceMapNormalized() as $map) {
            if ($map[self::REF_TABLE_CLASS] == $parentTableClassname && isset($map[self::ON_DELETE])) {
                switch ($map[self::ON_DELETE]) {
                    case self::CASCADE:
                        $where = array();
                        for ($i = 0; $i < count($map[self::COLUMNS]); ++$i) {
                            $col = $this->_db->foldCase($map[self::COLUMNS][$i]);
                            $refCol = $this->_db->foldCase($map[self::REF_COLUMNS][$i]);
                            $type = $this->_metadata[$col]['DATA_TYPE'];
                            $where[] = $this->_db->quoteInto(
                                $this->_db->quoteIdentifier($col, true) . ' = ?',
                                $primaryKey[$refCol], $type);
                        }
                        //$rowsAffected += $this->delete($where);
                        $toDelete = $this->fetchAll($where);
                        foreach($toDelete as $row) {
                            $rowsAffected += $row->delete();
                        }
                        break;
                    default:
                        // no action
                        break;
                }
            }
        }
        return $rowsAffected;
    }

    public function fetchAssoc($select=null)
    {
        return $this->fetchAll($select, self::DATA_TYPE_ARRAY);
    }



    /**
     * This overrides the parent::fetchAll
     *
     * @param Zend_Db_Statement|String $select: The select query
     * @param int $returnType: the Zend defined type id
     * @return Abstract_Rowset
     */
    public function fetchAll2($select=null, $returnType=self::DATA_TYPE_DEFAULT){

        switch ($returnType){
            # As Array
            case self::DATA_TYPE_ARRAY: return $this->getAdapter()->fetchAssoc($select);

            case self::DATA_TYPE_ASSOC: return $this->getAdapter()->fetchAll($select);

            # As  StdClass
            case self::DATA_TYPE_STDCLASS:
                $all = $this->getAdapter()->fetchAll($select);
                return $this->rowsetToStdObjects($all);

            # default Rowset
            default: return $this->getAdapter()->fetchAll($select);
        }
    }

    /**
     * Validate given columns against the actual table
     *
     * @param array $arr_colsToCheck
     */
    public function validateColumns(&$arr_colsToCheck) {
        $arr_tableCols = $this->_getCols();

        foreach ($arr_colsToCheck as $filterKey => $filterValue) {
            if(!in_array($filterKey, $arr_tableCols)) {
                unset($arr_colsToCheck[$filterKey]);
            }
        }
    }

    public function insertMany($arr_inserts)
    {
        foreach ($arr_inserts as $arr_insert) {
            $this->insert($arr_insert);
        }
    }

    /**
    * John's convenience methods...
    */

    public function setData($data)
    {
        $this->_data = $data;
    }

    public function getData()
    {
        return $this->_data;
    }

    public function save($data = null)
    {
        if($data != null)
            $this->setData($data); // perhaps to an array merge with existing data instead?

        $data = $this->getData();

        if(isset($data[$this->_primary]))
            $this->update($data, $this->_primary." = ".$data[$this->_primary]);
        else
            $this->insert($data);
    }

    protected function _camelToUnderscore($string)
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1_$2', $string));
    }

    protected function _escapeData($value)
    {
        if(is_numeric($value))
            return $value;
        else 
            return '"'.str_replace('"', '""', $value).'"';
    }

    public function exportToCSV($collection = null)
    {
        $filename = $this->_name.".csv";
        if($collection == null)
            $collection = $this->fetchAll();

        $i = 0;
        $comma = "";

        foreach($collection as $row)
        {
            $line = "";
            
            foreach($row as $name => $value)
            {
                $data = ($i == 0) ? $name : $value;
                $line .= $comma . $this->_escapeData($value);
                $comma = ",";
            }

            $line .= "\n";
            $comma = "";
            $out.=$line;
            $i++;
        }

        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=$filename");
        echo $out;
        exit;
    }

}