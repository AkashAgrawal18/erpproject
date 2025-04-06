<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
    /* -------- stock transfer working ---------- */
    public function get_edit_stck_transfer($id)
    {
        $this->db->select('stcktrans.*,m_batch_number,m_batch_balqty as balance_qty,prod.m_pro_name,prod.m_pro_pic,pkg.m_cat_name as package_name,size.m_cat_name as size_name');
        $this->db->join('master_batch_tbl batch', 'batch.m_batch_id = stcktrans.stk_trans_batch', 'left')
            ->join('master_product_tbl as prod', 'prod.m_pro_id = stcktrans.stk_trans_prod', 'left')
            ->join('master_cate_tbl size', 'prod.m_pro_size = size.m_cat_id', 'left')
            ->join('master_cate_tbl pkg', 'prod.m_pro_pack = pkg.m_cat_id', 'left');
        $this->db->where('stk_trans_challan', $id);
        //   $this->db->where('si_issue_status', 1);
        $this->db->order_by('m_pro_name');
        return $this->db->get('stock_transfers stcktrans')->result();
    }

    public function Stck_trans_group($from_date = '', $todate = '')
    {
        $user_store = $this->session->userdata('user_store');

        $this->db->select('stcktrans.stk_trans_challan,stcktrans.stk_trans_remark,stcktrans.stk_trans_date,stcktrans.stk_trans_status,SUM(stcktrans.stk_trans_qty) as totalqty,tranfrom.m_str_name as trans_from,transto.m_str_name as trans_to,GROUP_CONCAT(DISTINCT mprod.m_pro_name) as product_name,GROUP_CONCAT(DISTINCT mbatch.m_batch_number) as batch_number');

        $this->db->from('stock_transfers stcktrans');
        $this->db->join('master_store_tbl tranfrom', 'tranfrom.m_str_id = stcktrans.stk_trans_from', 'left');
        $this->db->join('master_store_tbl transto', 'transto.m_str_id = stcktrans.stk_trans_to', 'left');
        $this->db->join('master_product_tbl mprod', 'FIND_IN_SET(mprod.m_pro_id, stcktrans.stk_trans_prod) > 0', 'left');
        $this->db->join('master_batch_tbl mbatch', 'FIND_IN_SET(mbatch.m_batch_id, stcktrans.stk_trans_batch) > 0', 'left');
        $this->db->where("stcktrans.stk_trans_from !=",0);

        if (!empty($user_store)) {
            $this->db->where("(stcktrans.stk_trans_from = '$user_store' OR stcktrans.stk_trans_to = '$user_store')");
        }
        if (!empty($from_date)) {
            $this->db->where('DATE_FORMAT(stcktrans.stk_trans_date, "%Y-%m-%d") >=', $from_date);
        }
        if (!empty($todate)) {
            $this->db->where('DATE_FORMAT(stcktrans.stk_trans_date, "%Y-%m-%d") <=', $todate);
        }

        $this->db->order_by('stcktrans.stk_trans_date', 'desc');
        $this->db->group_by('stcktrans.stk_trans_challan');
        return $this->db->get()->result();
    }


    public function insert_stock_transfe()
    {
        $trans_id = $this->input->post('stk_trans_id');
        $trans_prod = $this->input->post('stk_trans_prod');
        $trans_batch = $this->input->post('stk_trans_batch');
        $trans_qty = $this->input->post('stk_trans_qty');
        $item_qty = $this->input->post('pre_item_qty');
        $stk_trans_date = $this->input->post('stk_trans_date');
        $stk_trans_from = $this->input->post('stk_trans_from');
        $stk_trans_to = $this->input->post('stk_trans_to');
        $stk_trans_remark = $this->input->post('stk_trans_remark');

        $date_part = date('dm', strtotime($stk_trans_date));
        $inv_dtl = $this->db->select('stk_trans_challan')->order_by('stk_trans_id', 'desc')->group_by('stk_trans_challan')->get('stock_transfers')->row();
        if (!empty($inv_dtl)) {
            preg_match('/CH\d{4}(\d+)/', $inv_dtl->stk_trans_challan, $matches);
            $last_number = isset($matches[1]) ? intval($matches[1]) : 0;
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }
        $cha_spo = 'CH' . $date_part . str_pad($new_number, 3, '0', STR_PAD_LEFT);

        foreach ($trans_batch as $key => $cau) {
            $s_data = array(
                "stk_trans_date" => $stk_trans_date,
                "stk_trans_from" => $stk_trans_from,
                "stk_trans_to" => $stk_trans_to,
                "stk_trans_remark" => $stk_trans_remark,
                "stk_trans_status" => 1,
                "stk_trans_prod"    => $trans_prod[$key],
                "stk_trans_batch"    => $cau,
                "stk_trans_qty"    => $trans_qty[$key],
                "stk_trans_balqty"    => $trans_qty[$key],
            );

            if (!empty($trans_id[$key])) {
                $new_qty = ((int)$trans_qty[$key] - (int)$item_qty[$key]);
                $s_data['stk_trans_updatedby'] = $this->session->userdata('user_id');
                $s_data['stk_trans_updatedon'] = date('Y-m-d H:i');
                $this->db->where('stk_trans_id', $trans_id[$key])->update('stock_transfers', $s_data);
                $this->update_stck_qty(1, $cau, $new_qty);
                $res = 2;
            } else {
                $s_data["stk_trans_challan"] = $cha_spo;
                $s_data['stk_trans_addedby'] = $this->session->userdata('user_id');
                $s_data['stk_trans_addedon'] = date('Y-m-d H:i');
                $this->db->insert('stock_transfers', $s_data);
                $this->update_stck_qty(1, $cau, $trans_qty[$key]);
                $res = 1;
            }
        }
        return $res;
    }

    public function delete_stock_transfe()
    {
        $dtype = $this->input->post('delete_type');
        if ($dtype == 1) {
            $stck_datil = $this->db->select('stk_trans_batch,stk_trans_qty')->where('stk_trans_challan', $this->input->post('delete_id'))->get('stock_transfers')->result();

            foreach ($stck_datil as $kry) {
                $this->update_stck_qty(1, $kry->stk_trans_batch, ($kry->stk_trans_qty * (-1)));
            }
            $this->db->where('stk_trans_challan', $this->input->post('delete_id'));
            return $this->db->delete('stock_transfers');
        } else {
            $stck_datil = $this->db->select('stk_trans_batch,stk_trans_qty')->where('stk_trans_id', $this->input->post('delete_id'))->get('stock_transfers')->row();
            $this->update_stck_qty(1, $stck_datil->stk_trans_batch, ($stck_datil->stk_trans_qty * (-1)));
            $this->db->where('stk_trans_id', $this->input->post('delete_id'));
            return $this->db->delete('stock_transfers');
        }
    }

    public function get_store_availble_batch($todate = '', $storeid = '', $prod_id = '')
    {
        $user_store = $this->session->userdata('user_store');

        $this->db->select('stk_trans_id,m_batch_id,m_batch_number,m_batch_price,m_batch_mrp,m_batch_date,stk_trans_qty,stk_trans_balqty as balance_qty,stk_trans_to,m_batch_pro_id,prod.m_pro_name,pkg.m_cat_name as package_name,size.m_cat_name as size_name')
            ->join('master_batch_tbl batch', 'batch.m_batch_id = stock_transfers.stk_trans_batch', 'left')
            ->join('master_product_tbl prod', 'prod.m_pro_id = stock_transfers.stk_trans_prod', 'left')
            ->join('master_cate_tbl pkg', 'prod.m_pro_pack = pkg.m_cat_id')->join('master_cate_tbl size', 'prod.m_pro_size = size.m_cat_id')->where('stk_trans_balqty >', 0);

        if (!empty($user_store)) {
            $this->db->where('stk_trans_to', $user_store);
        }
        if (!empty($prod_id)) {
            $this->db->where('m_batch_pro_id', $prod_id);
        }
        if (!empty($storeid)) {
            $this->db->where('stk_trans_to', $storeid);
        }
        if (!empty($todate)) {
            $this->db->where('stk_trans_date <=', $todate);
        }

        return $this->db->order_by('prod.m_pro_name')->get('stock_transfers')->result();
    }

    public function update_stck_qty($type, $stckId, $qty)
    {
        if ($type == 1) {
            $qb_stckid = $this->db->select('stk_trans_id')->where('stk_trans_batch', $stckId)->where('stk_trans_from', 0)->get('stock_transfers')->row();
            $stk_trans_id = $qb_stckid->stk_trans_id;
        } else {
            $stk_trans_id = $stckId;
        }
        return $this->db->set('stk_trans_balqty', 'stk_trans_balqty - ' . (int)$qty, FALSE)
            ->where('stk_trans_id', $stk_trans_id)->update('stock_transfers');
    }

    /* -------- stock transfer working ---------- */
    /* -------- Invoice working ---------- */
    public function get_edit_invoice($id)
    {
        $this->db->select('invoice_items_tbl.*,m_batch_number,stk_trans_balqty as balance_qty,prod.m_pro_name,prod.m_pro_pic,pkg.m_cat_name as package_name,size.m_cat_name as size_name');
        $this->db->join('stock_transfers', 'stock_transfers.stk_trans_id = inv_item_stcktrans', 'left')
            ->join('master_batch_tbl batch', 'batch.m_batch_id = inv_item_batch', 'left')
            ->join('master_product_tbl as prod', 'prod.m_pro_id = inv_item_product', 'left')
            ->join('master_cate_tbl size', 'prod.m_pro_size = size.m_cat_id', 'left')
            ->join('master_cate_tbl pkg', 'prod.m_pro_pack = pkg.m_cat_id', 'left');
        $this->db->where('inv_item_invoice', $id);
        $resitem = $this->db->get('invoice_items_tbl')->result();

        $this->db->select('invoice_tbl.*,entities.m_entity_name,m_entity_mobile,m_entity_type,m_entity_address,m_entity_gstno,m_entity_discount,m_entity_state');
        $this->db->join('master_entities_tbl entities', 'entities.m_entity_id = m_inv_entity', 'left');
        $this->db->where('m_inv_id', $id);
        $res = $this->db->get('invoice_tbl')->row();
        if (!empty($resitem)) {
            $res->item_data = $resitem;
        }
        return $res;
    }

    public function invoice_group($from_date = '', $todate = '')
    {
        $user_store = $this->session->userdata('user_store');

        $this->db->select('m_inv_id,m_inv_no,m_inv_entity,m_inv_date,m_inv_store,m_inv_amount,m_inv_discount,m_inv_cgst,m_inv_sgst,m_inv_totalamt,m_inv_remarks,store.m_str_name,entities.m_entity_name,m_entity_mobile');
        $this->db->from('invoice_tbl');
        $this->db->join('master_store_tbl store', 'store.m_str_id = m_inv_store', 'left');
        $this->db->join('master_entities_tbl entities', 'entities.m_entity_id = m_inv_entity', 'left');

        if (!empty($user_store)) {
            $this->db->where('m_inv_store', $user_store);
        }
        if (!empty($from_date)) {
            $this->db->where('DATE_FORMAT(m_inv_date, "%Y-%m-%d") >=', $from_date);
        }
        if (!empty($todate)) {
            $this->db->where('DATE_FORMAT(m_inv_date, "%Y-%m-%d") <=', $todate);
        }
        $this->db->order_by('m_inv_id', 'desc');
        return $this->db->get()->result();
    }


    public function insert_invoice()
    {
        $m_inv_id  = $this->input->post('m_inv_id');
        $m_inv_entity = $this->input->post('m_inv_entity');
        $m_entity_mobile = $this->input->post('m_entity_mobile');
        $m_entity_name = $this->input->post('m_entity_name');
        $m_entity_type = $this->input->post('m_entity_type');

        $checkCust = $this->db->where('m_entity_mobile', $m_entity_mobile)->get('master_entities_tbl')->row();
        if (!empty($checkCust) && $checkCust->m_entity_id == $m_inv_entity) {
            $entity_id = $m_inv_entity;
        } else if (!empty($checkCust)) {
            $entity_id = $checkCust->m_entity_id;
        } else {
            $ct_data = array(
                "m_entity_name" => $m_entity_name,
                "m_entity_type" => $m_entity_type ?: 1,
                "m_entity_mobile" => $m_entity_mobile,
                "m_entity_status" => 1,
                "m_entity_addedon" => date('Y-m-d H:i'),
            );
            $this->db->insert('master_entities_tbl', $ct_data);
            $entity_id = $this->db->insert_id();
        }
        $m_inv_date = $this->input->post('m_inv_date');
        $date_part = date('dm', strtotime($m_inv_date));
        $inv_dtl = $this->db->select('m_inv_no')->order_by('m_inv_id', 'desc')->get('invoice_tbl')->row();
        if (!empty($inv_dtl)) {
            preg_match('/Inv\d{4}(\d+)/', $inv_dtl->m_inv_no, $matches);
            $last_number = isset($matches[1]) ? intval($matches[1]) : 0;
            $new_number = $last_number + 1;
        } else {
            $new_number = 1;
        }
        $inv_spo = 'Inv' . $date_part . str_pad($new_number, 3, '0', STR_PAD_LEFT);

        $s_data = array(
            'm_inv_entity' => $entity_id,
            'm_inv_date' => $m_inv_date,
            'm_inv_store' => $this->input->post('m_inv_store'),
            'm_inv_amount' => $this->input->post('m_inv_amount'),
            'm_inv_dispr' => $this->input->post('m_inv_dispr'),
            'm_inv_discount' => $this->input->post('m_inv_discount'),
            'm_inv_pretax_amount' => $this->input->post('m_inv_pretax_amount'),
            'm_inv_cgst' => $this->input->post('m_inv_cgst'),
            'm_inv_sgst' => $this->input->post('m_inv_sgst'),
            'm_inv_igst' => $this->input->post('m_inv_igst'),
            'm_inv_totalamt' => $this->input->post('m_inv_totalamt'),
            'm_inv_remarks' => $this->input->post('m_inv_remarks'),
            'm_inv_status' => 1,
        );
        if (!empty($m_inv_id)) {
            $s_data['m_inv_updatedby'] = $this->session->userdata('user_id');
            $s_data['m_inv_updatedon'] = date('Y-m-d H:i');
            $this->db->where('m_inv_id', $m_inv_id)->update('invoice_tbl', $s_data);
            $invoice_id = $m_inv_id;
        } else {
            $s_data['m_inv_no'] = $inv_spo;
            $s_data['m_inv_addedby'] = $this->session->userdata('user_id');
            $s_data['m_inv_addedon'] = date('Y-m-d H:i');
            $this->db->insert('invoice_tbl', $s_data);
            $invoice_id = $this->db->insert_id();
        }

        $inv_item_id = $this->input->post('inv_item_id');
        $inv_item_stcktrans = $this->input->post('inv_item_stcktrans');
        $inv_item_product = $this->input->post('inv_item_product');
        $inv_item_batch = $this->input->post('inv_item_batch');
        $inv_item_qty = $this->input->post('inv_item_qty');
        $pre_item_qty = $this->input->post('pre_item_qty');
        $inv_item_rate = $this->input->post('inv_item_rate');
        $inv_item_pretaxamt = $this->input->post('inv_item_pretaxamt');
        $inv_item_cgst = $this->input->post('inv_item_cgst');
        $inv_item_sgst = $this->input->post('inv_item_sgst');
        $inv_item_disamt = $this->input->post('inv_item_disamt');
        $inv_item_disper = $this->input->post('inv_item_disper');
        $inv_item_igst = $this->input->post('inv_item_igst');
        $inv_item_netamt = $this->input->post('inv_item_netamt');

        foreach ($inv_item_batch as $key => $cau) {
            $si_data = array(
                "inv_item_invoice" => $invoice_id,
                "inv_item_stcktrans" => $inv_item_stcktrans[$key] ?: 0,
                "inv_item_batch" => $cau,
                "inv_item_product" => $inv_item_product[$key],
                "inv_item_qty" => $inv_item_qty[$key],
                "inv_item_date" => $m_inv_date,
                "inv_item_rate"    => $inv_item_rate[$key],
                "inv_item_pretaxamt"    => $inv_item_pretaxamt[$key],
                "inv_item_cgst"    => $inv_item_cgst[$key],
                "inv_item_sgst"    => $inv_item_sgst[$key],
                "inv_item_disamt"    => $inv_item_disamt[$key],
                "inv_item_disper"    => $inv_item_disper[$key],
                "inv_item_igst"    => $inv_item_igst[$key],
                "inv_item_netamt"    => $inv_item_netamt[$key],
                "inv_item_status"    => 1,
            );

            if (!empty($inv_item_id[$key])) {
                $new_qty = ((int)$inv_item_qty[$key] - (int)$pre_item_qty[$key]);
                $s_data['inv_item_updatedon'] = date('Y-m-d H:i');
                $this->db->where('inv_item_id', $inv_item_id[$key])->update('invoice_items_tbl', $si_data);
                $this->update_stck_qty(2, $inv_item_stcktrans[$key], $new_qty);
                $res = 2;
            } else {
                $s_data['inv_item_addedon'] = date('Y-m-d H:i');
                $this->db->insert('invoice_items_tbl', $si_data);
                $this->update_stck_qty(2, $cau, $inv_item_stcktrans[$key]);
                $res = 1;
            }
        }
        return $res;
    }

    public function delete_invoice()
    {
        $dtype = $this->input->post('delete_type');
        if ($dtype == 1) {
            $stck_datil = $this->db->select('inv_item_stcktrans,inv_item_qty')->where('inv_item_invoice', $this->input->post('delete_id'))->get('invoice_items_tbl')->result();

            foreach ($stck_datil as $kry) {
                $this->update_stck_qty(2, $kry->inv_item_stcktrans, ($kry->inv_item_qty * (-1)));
            }
            $this->db->where('m_inv_id', $this->input->post('delete_id'));
            $this->db->delete('invoice_tbl');
            $this->db->where('inv_item_invoice', $this->input->post('delete_id'));
            return $this->db->delete('invoice_items_tbl');
        } else {
            $stck_datil = $this->db->select('inv_item_stcktrans,inv_item_qty')->where('inv_item_id', $this->input->post('delete_id'))->get('invoice_items_tbl')->row();
            $this->update_stck_qty(2, $stck_datil->inv_item_stcktrans, ($stck_datil->inv_item_qty * (-1)));
            $this->db->where('inv_item_id', $this->input->post('delete_id'));
            return $this->db->delete('invoice_items_tbl');
        }
    }
    /* ---------------- INvoice working ------------------ */
}
