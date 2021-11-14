<script>
   // window.location.replace("http://web.stpoucc.com/web/login.php");
</script>

<?php

for ($i=1; $i <= 12 ; $i++) { 
    echo
    ' union all <br>
    select '.$i.' mes, count(1) cantidad from subcategoria sub, producto prod, ordentrabajo otr, seguimiento s
    where sub.sub_codigo = prod.sub_codigo
    and prod.prod_codigo = otr.prod_codigo
    and sub.cat_codigo = ".'.'$arrCategoria[$i][\'id\']'.'."  /* Codigo categoria */
    and fnu_getCantFalSegxOtr(otr.otr_codigo) = 0
    and otr.est_codigo = 1
    and s.otr_codigo = otr.otr_codigo
    and EXTRACT(MONTH FROM s.seg_fechaFinal) = '.$i.'
    and s.seg_codigo = (select max(se.seg_codigo) from seguimiento se where se.otr_codigo = otr.otr_codigo)
    <br><br>';
}


?>