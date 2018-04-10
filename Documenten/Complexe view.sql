select 
  hd_int_prpl_view_item.orderrule_id AS orderrule_id,
  hd_int_prpl_view_item.order_nr AS order_nr,
  hd_int_prpl_view_item.product_code AS product_code,
  hd_int_prpl_grootboek_actief.delivery_printing AS delivery_printing,
  hd_int_prpl_grootboek_actief.delivery_machine AS delivery_machine,
  hd_int_prpl_grootboek_actief.delivery_homework AS delivery_homework,
  hd_int_prpl_prepress.prepress_done_date AS prepress_done_date,
  
  # Aantal dagen printen + restant van de week tot vrijdag
  hd_int_prpl_prepress.prepress_done_date + interval hd_int_prpl_grootboek_actief.delivery_printing + 5 - date_format(hd_int_prpl_prepress.prepress_done_date,'%w') day AS print_end_base,
  
  hd_int_prpl_printing.end_date_late AS print_end_late,
  
  # Check of er een nieuwe datum is opgegeven, anders aantal dagen printen + restant van de week tot vrijdag
  case when hd_int_prpl_printing.end_date_late > '0000-00-00' then hd_int_prpl_printing.end_date_late else hd_int_prpl_prepress.prepress_done_date + interval hd_int_prpl_grootboek_actief.delivery_printing + 5 - date_format(hd_int_prpl_prepress.prepress_done_date,'%w') day end AS print_end,
  
  # Aantal dagen printen + aantal dagen machine + restant van de week tot vrijdag
  hd_int_prpl_prepress.prepress_done_date + interval hd_int_prpl_grootboek_actief.delivery_printing + hd_int_prpl_grootboek_actief.delivery_machine + 5 - date_format(hd_int_prpl_prepress.prepress_done_date,'%w') day AS mach_end_base,
  
  hd_int_prpl_machine.end_date_late AS mach_end_late,
  
  # Check of er een nieuwe datum is opgegeven, anders aantal dagen printen + aantal dagen machine + restant van de week tot vrijdag
  case when hd_int_prpl_machine.end_date_late > '0000-00-00' then hd_int_prpl_machine.end_date_late else hd_int_prpl_prepress.prepress_done_date + interval hd_int_prpl_grootboek_actief.delivery_printing + hd_int_prpl_grootboek_actief.delivery_machine + 5 - date_format(hd_int_prpl_prepress.prepress_done_date,'%w') day end AS mach_end,
  
  # Aantal dagen thuiswerk + aantal dagen printen + aantal dagen machine + restant van de week tot vrijdag
  hd_int_prpl_prepress.prepress_done_date + interval hd_int_prpl_grootboek_actief.delivery_printing + hd_int_prpl_grootboek_actief.delivery_machine + hd_int_prpl_grootboek_actief.delivery_homework + 5 - date_format(hd_int_prpl_prepress.prepress_done_date,'%w') day AS pack_end_base,
  
  hd_int_prpl_packaging.end_date_late AS pack_end_late,
  
  # Check of er een nieuwe datum is opgegeven, anders aantal dagen thuiswerk + aantal dagen printen + aantal dagen machine + restant van de week tot vrijdag
  case when hd_int_prpl_packaging.end_date_late > '0000-00-00' then hd_int_prpl_packaging.end_date_late else hd_int_prpl_prepress.prepress_done_date + interval hd_int_prpl_grootboek_actief.delivery_printing + hd_int_prpl_grootboek_actief.delivery_machine + hd_int_prpl_grootboek_actief.delivery_homework + 5 - date_format(hd_int_prpl_prepress.prepress_done_date,'%w') day end AS pack_end,
  
  # Extra dagen om aan te vullen tot vrijdag
  5 - date_format(hd_int_prpl_prepress.prepress_done_date,'%w') AS days_addition_print,
  
  # Aantal dagen thuiswerk + aantal dagen printen + aantal dagen machine + restant van de week tot vrijdag
  hd_int_prpl_prepress.prepress_done_date + interval hd_int_prpl_grootboek_actief.delivery_printing + hd_int_prpl_grootboek_actief.delivery_machine + hd_int_prpl_grootboek_actief.delivery_homework + 5 - date_format(hd_int_prpl_prepress.prepress_done_date,'%w') day AS leverdatum_base,
  
  # Check of er ergens een nieuwe datum is opgegeven, en neem deze eventueel mee in de berekening van de leverdatum
  case when hd_int_prpl_packaging.end_date_late > '0000-00-00' then hd_int_prpl_packaging.end_date_late when hd_int_prpl_machine.end_date_late > '0000-00-00' then hd_int_prpl_machine.end_date_late + interval hd_int_prpl_grootboek_actief.delivery_homework day when hd_int_prpl_printing.end_date_late > '0000-00-00' then hd_int_prpl_printing.end_date_late + interval hd_int_prpl_grootboek_actief.delivery_machine + hd_int_prpl_grootboek_actief.delivery_homework day when hd_int_prpl_prepress.prepress_done_date > '0000-00-00' then hd_int_prpl_prepress.prepress_done_date + interval 5 - date_format(hd_int_prpl_prepress.prepress_done_date,'%w') + hd_int_prpl_grootboek_actief.delivery_printing + hd_int_prpl_grootboek_actief.delivery_machine + hd_int_prpl_grootboek_actief.delivery_homework day else '0000-00-00' end AS leverdatum,
  
  # Als alle deelzendingen verzonden zijn, is de leverdatum definitief.
  case when hd_int_prpl_packaging.done_date > '0000-00-00' then 1 else 0 end AS date_def

from
  hd_int_prpl_view_item

left join
  hd_int_prpl_grootboek_actief on hd_int_prpl_grootboek_actief.BKHGBNR = hd_int_prpl_view_item.ledger_code

left join
  hd_int_prpl_packaging on hd_int_prpl_packaging.order_nrint = hd_int_prpl_view_item.orderrule_id

left join
  hd_int_prpl_machine on hd_int_prpl_machine.order_nrint = hd_int_prpl_view_item.orderrule_id

left join
  hd_int_prpl_printing on hd_int_prpl_printing.order_nrint = hd_int_prpl_view_item.orderrule_id

left join
  hd_int_prpl_prepress on hd_int_prpl_prepress.order_nrint = hd_int_prpl_view_item.orderrule_id