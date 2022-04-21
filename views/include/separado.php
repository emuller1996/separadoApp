<script>
    
    function valor_saldo_actual(){
        var saldo =  $('#separado_saldo_h').val() - $('#abono_valor_reg').val();
        $('#separado_saldo_reg').val(saldo);
    }
</script>