<script>
    
    function valor_saldo_actual(){
        var saldo =  $('#separado_saldo_h').val() - $('#abono_valor_reg').val();
        $('#separado_saldo_actual_reg').val(saldo);
        var total_abonado = parseInt($('#separado_abonado_h').val() ) + parseInt($('#abono_valor_reg').val());
        $('#separado_abonado_total_reg').val(total_abonado);
    }
</script>