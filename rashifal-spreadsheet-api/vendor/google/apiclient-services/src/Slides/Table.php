<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Slides;

class Table extends \Google\Collection
{
  protected $collection_key = 'verticalBorderRows';
  /**
   * @var int
   */
  public $columns;
  /**
   * @var TableBorderRow[]
   */
  public $horizontalBorderRows;
  protected $horizontalBorderRowsType = TableBorderRow::class;
  protected $horizontalBorderRowsDataType = 'array';
  /**
   * @var int
   */
  public $rows;
  /**
   * @var TableColumnProperties[]
   */
  public $tableColumns;
  protected $tableColumnsType = TableColumnProperties::class;
  protected $tableColumnsDataType = 'array';
  /**
   * @var TableRow[]
   */
  public $tableRows;
  protected $tableRowsType = TableRow::class;
  protected $tableRowsDataType = 'array';
  /**
   * @var TableBorderRow[]
   */
  public $verticalBorderRows;
  protected $verticalBorderRowsType = TableBorderRow::class;
  protected $verticalBorderRowsDataType = 'array';

  /**
   * @param int
   */
  public function setColumns($columns)
  {
    $this->columns = $columns;
  }
  /**
   * @return int
   */
  public function getColumns()
  {
    return $this->columns;
  }
  /**
   * @param TableBorderRow[]
   */
  public function setHorizontalBorderRows($horizontalBorderRows)
  {
    $this->horizontalBorderRows = $horizontalBorderRows;
  }
  /**
   * @return TableBorderRow[]
   */
  public function getHorizontalBorderRows()
  {
    return $this->horizontalBorderRows;
  }
  /**
   * @param int
   */
  public function setRows($rows)
  {
    $this->rows = $rows;
  }
  /**
   * @return int
   */
  public function getRows()
  {
    return $this->rows;
  }
  /**
   * @param TableColumnProperties[]
   */
  public function setTableColumns($tableColumns)
  {
    $this->tableColumns = $tableColumns;
  }
  /**
   * @return TableColumnProperties[]
   */
  public function getTableColumns()
  {
    return $this->tableColumns;
  }
  /**
   * @param TableRow[]
   */
  public function setTableRows($tableRows)
  {
    $this->tableRows = $tableRows;
  }
  /**
   * @return TableRow[]
   */
  public function getTableRows()
  {
    return $this->tableRows;
  }
  /**
   * @param TableBorderRow[]
   */
  public function setVerticalBorderRows($verticalBorderRows)
  {
    $this->verticalBorderRows = $verticalBorderRows;
  }
  /**
   * @return TableBorderRow[]
   */
  public function getVerticalBorderRows()
  {
    return $this->verticalBorderRows;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(Table::class, 'Google_Service_Slides_Table');
