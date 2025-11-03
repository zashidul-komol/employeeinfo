 <div class="col-md-4">
    <h4 class="section-subtitle hidden-sm hidden-xs">&nbsp;</h4>
    <div class="panel">
        <div class="dash-box-height">
            <div class="manageHgt">
                <a href="{{ route('distributors.index') }}">
                    <div class="dash-box-heightIn">
                        <h4 class="subtitle">Distributors</h4>
                        <div class="row">
                            <div class="col-xs-6">
                                <h5 class="title color-primary">{{number_format($shops['distributors'],0)}}</h5>
                            </div>
                            <div class="col-xs-6 text-right">
                                <img class="svg" src="{{ asset('storage/images/dashboard-icon/distributor.png') }}" alt="dfno">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="manageHgt">
                <a href="{{ route('shops.index') }}">
                    <div class="dash-box-heightIn">
                        <h4 class="subtitle">Outlets</h4>
                        <div class="row">
                            <div class="col-xs-6">
                                <h5 class="title color-primary">{{number_format($shops['retailers'],0)}}</h5>
                            </div>
                            <div class="col-xs-6 text-right">
                                <img class="svg" src="{{ asset('storage/images/dashboard-icon/outlet.png') }}" alt="dfno">
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            @if ($stockReceive['primary']!==false)
            <div class="manageHgt">
                <a href="{{ route('inventories.depotAllocatedStockIndex') }}">
                    <div class="dash-box-heightIn">
                        <h4 class="subtitle">Wait to Receive (Primary Stock)</h4>
                        <div class="row">
                            <div class="col-xs-6">
                                <h5 class="title color-primary">{{number_format($stockReceive['primary'], 0)}}</h5>
                            </div>
                            <div class="col-xs-6 text-right">
                                <img class="svg" src="{{ asset('storage/images/dashboard-icon/waittorecive.png') }}" alt="dfno">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

            @if ($stockReceive['transfer']!==false)
            <div class="manageHgt">
                <a href="{{ route('inventories.stockTransferLists') }}">
                    <div class="dash-box-heightIn">
                        <h4 class="subtitle">Wait to Receive (Transfer)</h4>
                        <div class="row">
                            <div class="col-xs-6">
                                <h5 class="title color-primary">{{number_format($stockReceive['transfer'], 0)}}</h5>
                            </div>
                            <div class="col-xs-6 text-right">
                                <img class="svg" src="{{ asset('storage/images/dashboard-icon/waittorecive.png') }}" alt="dfno">
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @endif

        </div>
    </div>
</div>