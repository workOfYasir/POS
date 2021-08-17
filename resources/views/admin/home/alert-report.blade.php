<div class="kt-portlet kt-portlet--tabs kt-portlet--height-fluid">
    <div class="kt-portlet__head">
        <div class="kt-portlet__head-label">
            <h3 class="kt-portlet__head-title">
                @translate(Product Stock Alert Reports)
            </h3>
        </div>
    </div>
    <div class="kt-portlet__body">
        <div class="tab-content">
            <div class="tab-pane active" id="kt_widget11_tab1_content">
                <div class="kt-widget11">
                    <div class="table-responsive">
                        <table class="table report2">
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>
                                        @translate(Product)</td>
                                    <td>
                                        @translate(Unit Price)</td>
                                    <td>
                                        @translate(Total Quantity)</td>
                                    <td>
                                        @translate(Total Price)</td>
                                    <td>
                                        @translate(Warehouse)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            $i=1;
                            ?>
                                @foreach($alert_products as $item)
                                @php( $product_q = 0)

                                @foreach($item->totalProductStock as $p)
                                    <input type="hidden" value="{{$product_q +=$p->quantity}}">
                                    @endforeach
                                    @if($product_q
                                    <= $item->alert_quantity)
                                        <tr>
                                            <td>
                                                {{$i++}}
                                            </td>
                                            <td>
                                                <a href="{{route('products.show',$item->id)}}" class="kt-widget11__title">{{$item->name}}</a>
                                                <span class="kt-widget11__sub">{{$item->code}}</span>
                                            </td>
                                            <td>{{formatePrice($item->price)}}</td>
                                            <td class="text-danger">
                                                {{$product_q}}
                                            </td>
                                            <td>{{ formatePrice($item->price*$product_q)}}</td>
                                            <td>
                                                @foreach($item->totalProductStock as $p)
                                                    <span class="kt-badge kt-badge--inline kt-badge--brand">{{$p->warehouse->name}} : <strong>{{$p->quantity}}</strong></span>
                                                    @endforeach
                                            </td>
                                        </tr>
                                        @endif
                                        @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
