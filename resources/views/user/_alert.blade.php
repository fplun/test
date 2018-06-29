<script>
    layui.use('layer', function () {
        @if (session('message'))
        layer.msg("{{ session('message') }}");
        @endif

        @if ($errors->any())
            layer.alert("{{ $errors->first() }}");
        @endif
    })
</script>