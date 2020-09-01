### PREPRESS ####
    SELECT
      order_nrint,
      0 as printing_id,
      0 as machine_id,
      0 as packaging_id,
      CASE WHEN general_status IN (2,5,8) THEN 'studio' ELSE 'prepress' END as main_status,
      general_status as sub_status,
      order_start_quantity as quantity
    FROM
      hd_int_prpl_general
    JOIN
      hd_int_prpl_view_item ON object_id = order_nrint
    WHERE
      general_status < 100

UNION ALL




### DRUKKERIJ ####
   SELECT
      order_nrint,
      0 as printing_id,
      0 as machine_id,
      0 as packaging_id,
      'printing' as main_status,
      general_status as sub_status,
      order_start_quantity as quantity
    FROM
      hd_int_prpl_general
    JOIN
      hd_int_prpl_view_item ON order_nrint = object_id
    WHERE
      general_status = 100


UNION ALL


    SELECT
      order_nrint,
      0 as printing_id,
      0 as machine_id,
      0 as packaging_id,
      'printing' as main_status,
      100 as sub_status,
      start_quantity as quantity
    FROM
      hd_int_prpl_printing_order
    WHERE
      done_date = '0000-00-00'

UNION ALL

    SELECT
      order_nrint,
      id as printing_id,
      0 as machine_id,
      0 as packaging_id,
      'printing' as main_status,
      101 as sub_status,
      start_quantity as quantity
    FROM
      hd_int_prpl_printing
    WHERE
      done_date = '0000-00-00'


UNION ALL




### MACHINE ####
    SELECT
      order_nrint,
      printing_id as printing_id,
      0 as machine_id,
      0 as packaging_id,
      'packaging' as main_status,
      102 as sub_status,
      start_quantity as quantity
    FROM
      hd_int_prpl_machine_order
    WHERE
      done_date = '0000-00-00'

UNION ALL

    SELECT
      order_nrint,
      printing_id as printing_id,
      id as machine_id,
      0 as packaging_id,
      'packaging' as main_status,
      CASE WHEN start_date = '0000-00-00' THEN 116 ELSE 103 END as sub_status,
      start_quantity as quantity
    FROM
      hd_int_prpl_machine
    WHERE
      done_date = '0000-00-00'


UNION ALL

### MACHINE READY ####
    SELECT
      hd_int_prpl_machine_ready.order_nrint,
      printing_id as printing_id,
      machine_id as machine_id,
      0 as packaging_id,
      'packaging' as main_status,
      117 as sub_status,
      hd_int_prpl_machine_ready.start_quantity as quantity
    FROM
      hd_int_prpl_machine_ready
    JOIN
      hd_int_prpl_machine ON machine_id = hd_int_prpl_machine.id
    WHERE
      hd_int_prpl_machine_ready.done_date = '0000-00-00'

UNION ALL


### VERPAKKER ####
    SELECT
      hd_int_prpl_packaging.order_nrint,
      hd_int_prpl_machine.printing_id as printing_id,
      hd_int_prpl_packaging.machine_id as machine_id,
      hd_int_prpl_packaging.id as packaging_id,
      'packaging' as main_status,
      CASE
        WHEN hd_int_prpl_packaging.adres_nrint  =  '' AND hd_int_prpl_packaging.start_date =  '0000-00-00' THEN 104
        WHEN hd_int_prpl_packaging.adres_nrint  <>  '' AND hd_int_prpl_packaging.start_date =  '0000-00-00' THEN 109
        WHEN hd_int_prpl_packaging.adres_nrint  <>  '' AND hd_int_prpl_packaging.start_date <> '0000-00-00' THEN 105
      END as sub_status,
      hd_int_prpl_packaging.start_quantity as quantity
    FROM
      hd_int_prpl_packaging
    JOIN
      hd_int_prpl_machine ON machine_id = hd_int_prpl_machine.id
    WHERE
      hd_int_prpl_packaging.done_date = '0000-00-00'



UNION ALL




### TRANSPORT ####
    SELECT
      hd_int_prpl_transport.order_nrint,
      hd_int_prpl_machine.printing_id as printing_id,
      hd_int_prpl_packaging.machine_id as machine_id,
      hd_int_prpl_transport.packaging_id as packaging_id,
      'transport' as main_status,
      CASE
        WHEN hd_int_prpl_transport.to_nl =  0 THEN 112
        WHEN hd_int_prpl_transport.to_nl <> 0 AND hd_int_prpl_transport.loading_order =  0 THEN 113
        WHEN hd_int_prpl_transport.to_nl <> 0 AND hd_int_prpl_transport.loading_order <> 0 AND hd_int_prpl_transport.in_nl = 0 THEN 114
        WHEN hd_int_prpl_transport.to_nl <> 0 AND hd_int_prpl_transport.loading_order <> 0 AND hd_int_prpl_transport.in_nl = 1 AND hd_int_prpl_transport.to_transport = 0 THEN 115
      END as sub_status,
      hd_int_prpl_transport.start_quantity as quantity
    FROM
      hd_int_prpl_transport
    JOIN
      hd_int_prpl_packaging ON packaging_id = hd_int_prpl_packaging.id
    JOIN
      hd_int_prpl_machine ON machine_id = hd_int_prpl_machine.id
    WHERE
      hd_int_prpl_transport.to_transport_date = '0000-00-00' AND hd_int_prpl_transport.in_nl <> -1



UNION ALL




### FINANCE ####
    SELECT
      hd_int_prpl_finance.order_nrint,
      hd_int_prpl_machine.printing_id as printing_id,
      hd_int_prpl_packaging.machine_id as machine_id,
      hd_int_prpl_finance.packaging_id as packaging_id,
      'finance' as main_status,
      CASE
        WHEN hd_int_prpl_finance.intake =  0 THEN 106
        WHEN hd_int_prpl_finance.intake <> 0 AND hd_int_prpl_finance.invoice =  0 THEN 107
        WHEN hd_int_prpl_finance.intake <> 0 AND hd_int_prpl_finance.invoice <> 0 AND hd_int_prpl_finance.transport_cost = 0 THEN 108
      END as sub_status,
      hd_int_prpl_finance.start_quantity as quantity
    FROM
      hd_int_prpl_finance
    JOIN
      hd_int_prpl_packaging ON packaging_id = hd_int_prpl_packaging.id
    JOIN
      hd_int_prpl_machine ON machine_id = hd_int_prpl_machine.id
    WHERE
      hd_int_prpl_finance.invoice = 0
    AND
      hd_int_prpl_finance.start_quantity > 0

UNION ALL

### ARCHIVE ####
    SELECT
      hd_int_prpl_finance.order_nrint,
      hd_int_prpl_machine.printing_id as printing_id,
      hd_int_prpl_packaging.machine_id as machine_id,
      hd_int_prpl_finance.packaging_id as packaging_id,
      'archief' as main_status,
      99 as sub_status,
      hd_int_prpl_finance.start_quantity as quantity
    FROM
      hd_int_prpl_finance
    JOIN
      hd_int_prpl_packaging ON packaging_id = hd_int_prpl_packaging.id
    JOIN
      hd_int_prpl_machine ON machine_id = hd_int_prpl_machine.id
    WHERE
      hd_int_prpl_finance.invoice = 1