<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 Autocomplete Search using Bootstrap Typeahead JS - ItSolutionStuff.com</title>
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <link href="https://code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css"/>
    <script src="https://unpkg.com/jquery@2.2.4/dist/jquery.js"></script>
</head>
<body>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4>Autocomplete from database</h4>
                    <hr>

                    <div class="form-group">
                        <label>Product</label>
                        <input id="product_id" name="product_id" type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Name</label>
                        <input id="name"  type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Buy Rate</label>
                        <input id="buy_rate"  type="text" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Sale Price</label>
                        <input id="sale_price"  type="text" class="form-control">
                    </div>

                </div>
            </div>
        </div>

        <script>
            $(function () {
               $('#product_id').autocomplete({
                   source:function(request,response){

                       $.getJSON('?term='+request.term,function(data){
                            var array = $.map(data,function(row){
                                return {
                                    value:row.id,
                                    label:row.name,
                                    name:row.name,
                                    buy_rate:row.buy_rate,
                                    sale_price:row.sale_price
                                }
                            })

                            response($.ui.autocomplete.filter(array,request.term));
                       })
                   },
                   minLength:1,
                   delay:500,
                   select:function(event,ui){
                       $('#name').val(ui.item.name)
                       $('#buy_rate').val(ui.item.buy_rate)
                       $('#sale_price').val(ui.item.sale_price)
                   }
               })
            })
        </script>

</body>
</html>
