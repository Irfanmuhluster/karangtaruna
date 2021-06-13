
<link rel="stylesheet" href="{{ theme_asset('backend::default', 'vendor/kendoui/kendo.bootstrap-v4.min.css') }}">
<script src="{{ theme_asset('backend::default', 'vendor/kendoui/kendo.all.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#message").kendoEditor({
                tools: [
                "bold",
                "italic",
                "underline",
                "strikethrough",
                "insertUnorderedList",
                "insertOrderedList",
                "formatting",
                "justifyLeft",
                "justifyCenter",
                "justifyRight",
                "justifyFull",
                ]
        });
      
    })
</script>
