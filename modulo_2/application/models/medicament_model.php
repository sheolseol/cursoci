<?php
class medicament_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	
	public function addTypeMedicament($data=array())
	{
		$this->db->insert('tipo_medicamento',$data);
		return $this->db->insert_id();
	}

	public function getTypeMedicament(){

		$query=$this->db
			->select("`id_type_medicament`,`name_type_medicament`,`description_type_medicament`,`date_type_medicament`")
			->from("tipo_medicamento")
			->get();
			return $query->result();

	}#end

	public function getTypeMedicamentForId($id){

		$query=$this->db
			->select("`id_type_medicament`,`name_type_medicament`,`description_type_medicament`")
			->from("tipo_medicamento")
			->where(array("id_type_medicament"=>$id))
			->get();
			#echo $this->db->last_query();exit; imprimier consulta
			return $query->row();

	}#end

	public function updateTypeMedicament($data=array(),$id)
	{
		$this->db->where('id_type_medicament', $id);
		$this->db->update('tipo_medicamento', $data); 
		return true;
	}

	public function getMedicament(){

		$query=$this->db
			->select("`id_medicament`,`name_medicament`,`id_reletion`,`date_medicament`,id_type_medicament,name_type_medicament")
			->from("medicamentos, tipo_medicamento")
			->where("id_type_medicament = id_reletion")
			->get();
			return $query->result();

	}#end

	public function getMedicamentForId($id){

		$query=$this->db
			->select("`id_medicament`,`name_medicament`,`id_reletion`,description_medicament,`date_medicament`")
			->from("medicamentos")
			->where(array("id_medicament"=>$id))
			->get();
			#echo $this->db->last_query();exit; imprimier consulta
			return $query->row();

	}#end

	public function addMedicament($data=array())
	{
		$this->db->insert('medicamentos',$data);
		return true;
	}#end

	public function editMedicament($data=array(),$id)
	{
		
		$this->db->where('id_medicament', $id);
		$this->db->update('medicamentos', $data); 
		return true;
	}#end

	public function deleteMedicament($id)
	{
		
		$this->db->where('id_medicament', $id);
		$this->db->delete('medicamentos'); 
		return true;
	}#end

	public function deleteTypeMedicament($id)
	{

		$query=$this->db
			->select("`id_medicament`,id_reletion")
			->from("medicamentos")
			->where(array("id_reletion"=>$id))
			->get();		
			$val = $query->row();

		if (!sizeof($val)) {
			$this->db->where('id_type_medicament', $id);			
			$this->db->delete('tipo_medicamento'); 
			$this->session->set_flashdata("mensaje","El registro ha sido eliminado exitosamente");
			redirect(base_url()."home/gestortypemedicamet");
			return true;
		}else{
			#echo "no puedes borrar";
			$this->session->set_flashdata("mensaje","El registro no se puede eliminado, debido a que tiene registros relacionados	");
			redirect(base_url()."home/gestortypemedicamet");
		}

		
		
	}#end

	

}#end class