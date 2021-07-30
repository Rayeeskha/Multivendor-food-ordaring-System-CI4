<?php 
namespace App\models;
use CodeIgniter\Model;
use CodeIgniter\I18n\Time;

    class Dishes_model extends Model
	{
		protected $table      = 'dish_master';
	    protected $primaryKey = 'id';

	    // protected $returnType     = 'array';
	    // protected $useSoftDeletes = true;
	    protected $allowedFields     = ['category_id','dish_title','dish_details','dish_type', 'image','image_two', 'image_three', 'image_four','status','added_on','restaurent_id'];
	    protected $useTimestamps     = true;
	    // protected $createdField      = 'created_at';
	    // protected $updatedField      = 'updated_at';
	    // protected $deletedField      = 'deleted_at';
	    protected $returnType        = 'array';

	


	    public function search_dish_title($key, $args) {   
			return $this->table('dish_master')->like('dish_title',$key)->where($args);
	    }

	    public function fetch_rec_with_pagination_by_args($tablename, $args){
	    	return $this
                    ->table($tablename)
                    ->select('*')
                    ->where($args)
                    ->paginate(10);
		}

		public function filter_rec_by_args_with_pagination($tablename, $order_format, $args){
			extract($order_format);
			return $this->table($tablename)
                    ->orderBy($order_format['column_name'],$order_format['order'])
                    ->where($args)
                    ->paginate(10);
		}

	



		
		





	}


?>