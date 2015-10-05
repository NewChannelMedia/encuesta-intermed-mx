    <!-- Aqui termina el body de la pagina -->
    <!-- jQuery -->
    <script src="<?= base_url() ?>js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <!--<script src="<?= base_url() ?>js/classie.js"></script>-->
    <!--<script src="<?= base_url() ?>js/cbpAnimatedHeader.js"></script>-->
    <!-- Contact Form JavaScript -->
    <script src="<?= base_url() ?>js/jqBootstrapValidation.js"></script>
    <!--<script src="<?= base_url() ?>js/contact_me.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="<?= base_url() ?>js/utils.js"></script>

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script type="text/javascript">

    var data = [{
        label: '2006',
        value: 100
    },{
        label: '2006',
        value: 100
    },{
        label: '2006',
        value: 100
    },{
        label: '2006',
        value: 100
    }];

    var ykeys = ['value'];

    MorrisBar('myfirstchart', data, ykeys);

  function MorrisDonut(element, data){
    console.log('Elemento: ' + element + ' Data: ' + JSON.stringify(data));
    new Morris.Donut({
      // ID of the element in which to draw the chart.
      element: element,
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: data,
      // The name of the data record attribute that contains x-values.
      hideHover: 'auto',
      resize: true
    });
  }




  function MorrisBar(element, data, ykeys){
    console.log('Elemento: ' + element + ' Data: ' + JSON.stringify(data));
    new Morris.Bar({
      // ID of the element in which to draw the chart.
      element: element,
        data: [{
            label: '2006',
            value: 100
        }, {
            label: '2007',
            value: 75
        }, {
            label: '2008',
            value: 50
        }, {
            label: '2009',
            value: 75
        }, {
            label: '2010',
            value: 50
        }, {
            label: '2011',
            value: 75
        }, {
            label: '2012',
            value: 100
        }],
        xkey: 'label',
        ykeys: ['value'],
        hideHover: 'auto',
        resize: true
    });
  }
  </script>

  </body>
</html>
