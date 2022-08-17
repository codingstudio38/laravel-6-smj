  <!--  END CONTENT AREA  -->
      
    <script src="{{url('/')}}/public/bootstrap/js/popper.min.js"></script>
    <script src="{{url('/')}}/public/bootstrap/js/bootstrap.min.js"></script>
    <script src="{{url('/')}}/public/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{url('/')}}/public/assets/js/app.js"></script>
    <script type="text/javascript">
        var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#cmd').click(function () {
        doc.fromHTML($('#content').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });
    </script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{url('/')}}/public/plugins/highlight/highlight.pack.js"></script>
    <script src="{{url('/')}}/public/assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL CUSTOM SCRIPTS -->
    <script src="{{url('/')}}/public/assets/js/scrollspyNav.js"></script>
    <script>
        checkall('todoAll', 'todochkbox');
        $('[data-toggle="tooltip"]').tooltip()
    </script>
    <!-- END PAGE LEVEL CUSTOM SCRIPTS -->
</body>
</html>