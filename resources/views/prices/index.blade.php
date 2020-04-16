@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Prices</h2>
    <div>
        <div style="width:50%;" class="form-group">
            <label for="stock_symbol">Type a stock symbol:</label>
            <input type="text" class="form-control" id="stock_symbol" placeholder="AAPL, AMZN...">
        </div>
        <button id="pricebtn" class="btn btn-primary">Get Price</button>
    </div>
    <div style="margin-top:10px;" id="price_messages"></div>
    <!-- show saved success message -->
    @if (session('price_saved'))
        <div style="margin-top:10px;" class="alert alert-success">
            {{ session('price_saved') }}
        </div>
    @endif
    
    <div id="storeInfo" style="margin-top:2em; display:none">
        <form action="{{ route('prices.store') }}" method="POST">
        @csrf
            <div style="width:50%;" class="form-group">
                <div class="row">
                    <div class="col-md-4">
                        <label for="infoSymbol">Symbol:</label>
                        <input type="text" name="symbol" class="form-control" id="infoSymbol" required/>
                    </div>
                    <div class="col-md-4">
                        <label for="infoHigh">High:</label>
                        <input type="text" name="high" class="form-control" id="infoHigh"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <label for="infoLow">Low:</label>
                        <input type="text" name="low" class="form-control" id="infoLow"/>
                    </div>
                    <div class="col-md-4">
                        <label for="infoPrice">Price:</label>
                        <input type="text" name="price" class="form-control" id="infoPrice" required/>
                    </div>
                </div>
            </div>
            <button type="submit" style="margin-top:10px;" class="btn btn-primary">Save</button>
        </form>
    </div>
    <!-- Show posible errors on request values -->
    @if ($errors->any())
        <div style="margin-top:10px;" class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div style="margin-top:1em;" id="resultTable">
        <table class="table table-striped">
            <thead>
                <tr>
                <th>ID</th>
                <th>Symbol</th>
                <th>High</th>
                <th>Low</th>
                <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @if (count($prices)>0)
                    @foreach($prices as $price)
                    <tr>
                        <td>{{$price->id}}</td>
                        <td>{{$price->symbol}}</td>
                        <td>{{$price->high}}</td>
                        <td>{{$price->low}}</td>
                        <td>{{$price->price}}</td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan=5><div class="alert alert-info">There are not prices yet</div></td>
                    </tr>
                @endif
               
            </tbody>
        </table>
    </div>
    <a href="{{ url('/destroyPrices') }}"><button id="dataClean" class="btn btn-danger">Reset table</button> </a>
    <!-- Show sucess message of reset table -->
    @if (session('table_destroyed'))
        <div style="margin-top:10px;" class="alert alert-success">
            {{ session('table_destroyed') }}
        </div>
    @endif  
</div>
    <script type="text/javascript">
    $(document).ready(function(){
        $('#pricebtn').click(function(){
            var apiKey = "0O18XUJW9P8QVGQJ";
            var stockSymbol = $('#stock_symbol').val();
            $.ajax({
                type:'GET',
                url:"https://www.alphavantage.co/query?function=GLOBAL_QUOTE&symbol=" + stockSymbol + "&apikey=" + apiKey,
                success:function(response){
                    if(response.hasOwnProperty("Error Message"))
                    {
                        $('#price_messages').html("<div class='alert alert-danger'>That stock symbol does not exist</div>").fadeIn().delay(3000).fadeOut();
                        $("#storeInfo").hide();
                    }else{
                        if(response.hasOwnProperty("Global Quote"))
                        {
                            var pricesObj = response["Global Quote"];
                            /*
                            //Code for ajax storing
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });
                            $.ajax({
                                url: "{{ route('prices.store') }}",
                                type: 'POST',
                                data: {
                                    symbol: pricesObj["01. symbol"],
                                    high: pricesObj["03. high"],
                                    low: pricesObj["04. low"],
                                    price: pricesObj["05. price"]
                                },
                                success:function(response) {
                                    $('#saveResult').html("<div style='margin-top:10px; width:50%;' class='alert alert-success'>" + response + "</div>").fadeIn("slow").delay("3000").fadeOut("3000");
                                }
                            });
                            */
                            // show the div of values
                            $("#storeInfo").show();
                            $("#infoSymbol").val(pricesObj["01. symbol"]);
                            $("#infoHigh").val(pricesObj["03. high"]);
                            $("#infoLow").val(pricesObj["04. low"]);
                            $("#infoPrice").val(pricesObj["05. price"]);
                        }else{
                            $("#storeInfo").hide();
                        }
                    }
                }
            });
        });
    });
    </script>
@endsection