<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">

    <title>Manage Media</title>



    <!-- jQuery and jQuery UI (REQUIRED) -->

    <link rel="stylesheet" type="text/css" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/smoothness/jquery-ui.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>



    <!-- elFinder CSS (REQUIRED) -->

    <link rel="stylesheet" type="text/css" href="{{ asset( 'assets/backend/media/css/elfinder.min.css' ) }}">

    <link rel="stylesheet" type="text/css" href="{{ asset( 'assets/backend/media/css/theme.css' ) }}">



    <!-- elFinder JS (REQUIRED) -->

    <script src="{{ asset( 'assets/backend/media/js/elfinder.min.js' ) }}"></script>



    <!-- Include jQuery, jQuery UI, elFinder (REQUIRED) -->



    <script type="text/javascript">

        $().ready(function () {

            var elf = $('#elfinder').elfinder({

                // set your elFinder options here

                customData: { 

                    _token: '{{ csrf_token() }}'

                },

                url: "{{ asset( 'assets/backend/media/php/connector.minimal.php' ) }}",  // connector URL

                dialog: {width: 900, modal: true, title: 'Select a file'},

                resizable: false,

                commandsOptions: {

                    getfile: {

                        oncomplete: 'destroy'

                    }

                },

                getFileCallback : function(file, fm) {
                    window.opener.CKEDITOR.tools.callFunction((function() {
                        var reParam = new RegExp('(?:[\?&]|&amp;)CKEditorFuncNum=([^&]+)', 'i') ;
                        var match = window.location.search.match(reParam) ;
                        return (match && match.length > 1) ? match[1] : '' ;
                    })(), file.url);
                    fm.destroy();
                    window.close();
                }

            }).elfinder('instance');

        });

    </script>





</head>

<body>

<!-- Element where elFinder will be created (REQUIRED) -->

<div id="elfinder"></div>



</body>

</html>

