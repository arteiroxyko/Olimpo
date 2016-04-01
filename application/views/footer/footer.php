<script>
    $('.tpData').datetimepicker({
      timepicker:false,
      lang:'de',
      i18n:{
         de:{
          months:[
           'Jan','Fev','Mar','Abr',
           'Mai','Jun','Jul','Ago',
           'Set','Out','Nov','Dez',
          ],
          dayOfWeek:[
           "Dom", "Seg", "Ter", "Qua", 
           "Qui", "Sex", "Sab",
          ]
         }
      },
      timepicker:false,
      format:'d/m/Y'
    });
    $('.tpDataMes').datetimepicker({
      timepicker:false,
      lang:'de',
      i18n:{
         de:{
          months:[
           'Jan','Fev','Mar','Abr',
           'Mai','Jun','Jul','Ago',
           'Set','Out','Nov','Dez',
          ],
          dayOfWeek:[
           "Dom", "Seg", "Ter", "Qua", 
           "Qui", "Sex", "Sab",
          ]
         }
      },
      timepicker:false,
      format:'m/Y'
    });
    $('.tpTime').datetimepicker({
        datepicker:false,
        format:'H:i'
    });

</script>
<script type="text/javascript">
//<![CDATA[
  bkLib.onDomLoaded(function() {
        new nicEditor().panelInstance('textCurso');
        new nicEditor().panelInstance('textConteudo');
  });
  //]]>
  </script>
</body>
</html>