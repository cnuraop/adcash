<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Member extends CI_Model{
    
    function __construct() {
        // Set table name
        $this->table = 'members';
    }
    
    /*
     * Fetch members data from the database
     * @param array filter data based on the passed parameters
     */
    function getRows($params = array()){
        $this->db->select('*');
        $this->db->from($this->table);
        
        if(array_key_exists("conditions", $params)){
            foreach($params['conditions'] as $key => $val){
                $this->db->where($key, $val);
            }
        }
        
        if(!empty($params['searchKeyword'])){
            $search = $params['searchKeyword'];
            $likeArr = array('user' => $search, 'product' => $search, 'price' => $search);
            $this->db->or_like($likeArr);
        }
        
        if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
            $result = $this->db->count_all_results();
        }else{
            if(array_key_exists("id", $params)){
                $this->db->where('id', $params['id']);
                $query = $this->db->get();
                $result = $query->row_array();
            }else{
                $this->db->order_by('user', 'asc');
                if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit'],$params['start']);
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
                    $this->db->limit($params['limit']);
                }
                
                $query = $this->db->get();
                $result = ($query->num_rows() > 0)?$query->result_array():FALSE;
            }
        }
        
        // Return fetched data
        return $result;
    }
    
    /*
     * Insert members data into the database
     * @param $data data to be insert based on the passed parameters
     */
    public function insert($data = array()) {
        if(!empty($data)){
            // Add created and modified date if not included
            if(!array_key_exists("created", $data)){
                $data['created'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Insert member data
            $insert = $this->db->insert($this->table, $data);
            
            // Return the status
            return $insert?$this->db->insert_id():false;
        }
        return false;
    }
    
    /*
     * Update member data into the database
     * @param $data array to be update based on the passed parameters
     * @param $id num filter data
     */
    public function update($data, $id) {
        if(!empty($data) && !empty($id)){
            // Add modified date if not included
            if(!array_key_exists("modified", $data)){
                $data['modified'] = date("Y-m-d H:i:s");
            }
            
            // Update member data
            $update = $this->db->update($this->table, $data, array('id' => $id));

            
            // Return the status
            return $update?true:false;
        }
        return false;
    }
    
    /*
     * Delete member data from the database
     * @param num filter data based on the passed parameter
     */
    public function delete($id){
        // Delete member data
        $delete = $this->db->delete($this->table, array('id' => $id));
        
        // Return the status
        return $delete?true:false;
    }


    public function getAllGroups()
    {
        /*
        $query = $this->db->get('location');

        foreach ($query->result() as $row)
        {
            echo $row->description;
        }*/

        $query = $this->db->query('SELECT product_name FROM products');


        return $query->result();

        //echo 'Total Results: ' . $query->num_rows();
    }



    public function get_data_between_7days()
   { 

        // $this->db->select('*');
        // $this->db->where('created BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()');
        // $this->db->where($conditions);
        // $result = $this->db->get($table);
        // return $result->result();
          
         $query = $this->db->query('SELECT * FROM `members` WHERE `created` BETWEEN DATE_SUB(NOW(), INTERVAL 7 DAY) AND NOW()'); 
          
         return $query->result(); 

   }

    public function get_data_today()
   { 

        // $this->db->select('*');
        // $this->db->where('created BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()');
        // return $result = $this->db->get($table);

    $query = $this->db->query('SELECT * FROM `members` WHERE `created` BETWEEN DATE_SUB(NOW(), INTERVAL 1 DAY) AND NOW()'); 
          
         return $query->result(); 
    
   }

}