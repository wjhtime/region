<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>城市选择器</title>
    <script src="{{ asset('/js/jquery.min.js') }}"></script>
    <script>
        /**
         * 更新城市列表
         * @param obj
         */
        function changeCity(obj)
        {
            $('#city').show().empty().append("<option value=''>请选择</option>");
            $('#county').show().empty().append("<option value=''>请选择</option>");
            $.get('/region/city?province='+obj.value, function(result) {
                $('#city').show().empty().append("<option value=''>请选择</option>");
                $.each(result, function (i, e){
                    $('#city').append("<option value="+e.region_id+">"+e.region_name+"</option>");
                });
            });
        }

        /**
         * 更新县列表
         * @param obj
         */
        function changeCounty(obj)
        {
            $.get('/region/county?city='+obj.value, function(result) {
                $('#county').show().empty().append("<option value=''>请选择</option>");
                $.each(result, function (i, e){
                    $('#county').append("<option value="+e.region_id+">"+e.region_name+"</option>");
                });
            });
        }
    </script>
</head>
<body>
<select name="province" id="province" onchange="changeCity(this)">
    <option value="">请选择</option>
    @foreach ($provinces as $province)
        <option value="{{ $province->get('region_id') }}">{{ $province->get('region_name') }}</option>
    @endforeach
</select>
<select name="city" id="city" style="display: none;" onchange="changeCounty(this)">
</select>
<select name="county" id="county" style="display: none;">
</select>
</body>
</html>