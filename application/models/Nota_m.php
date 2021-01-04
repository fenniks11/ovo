<?php defined('BASEPATH') or exit('No direct script access allowed');

class Nota_m extends CI_Model
{
    public function invoice_no()
    {
        $sql = "SELECT MAX(MID(no_referensi, 10,4)) AS invoice_no
                FROM nota 
                WHERE MID(no_referensi, 4, 6) = DATE_FORMAT(CURDATE(),'%y%m%d')";
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $n = ((int)$row->invoice_no) + 1;
            $no = sprintf("%'.04d", $n);
        } else {
            $no = "0001";
        }
        $invoice = "OVO" . date('ymd') . $no;
        return $invoice;
    }
}
