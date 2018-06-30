<style>
    .money{
        padding-right: 0px;
    }
    .money{
        margin-left: -30px;
    }
    li.active{
        border-top: 3px solid #34c7d4 !important;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-12" style="margin-bottom: 10px;margin-right: 30px"><span class="btn btn-primary" data-toggle="modal" data-target="#profitsForm">@lang('library.add_profits')</span></div>

        <div class="col-md-8">
            <div class="col-md-12">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered table-hover dt-responsive" id="inst_profits_table"
                           width="100%">
                        <thead>
                        <tr>
                            <th>المبلغ</th>
                            <th>طريقة التسديد</th>
                            <th>التاريخ</th>
                            <th>الوقت</th>
                            <th>العملية</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4" style="line-height: 2; font-size: 15px; border:1px solid #cccccc;padding:5px;margin-top: 12px">
            <div class="col-md-12">
                <div class="col-md-4 money">@lang('driver.totalSales'):</div>
                <div class="col-md-4 ">{{number_format($driver ? $driver->total_profits : 00.00,2,'.','')}} ريال</div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 money">@lang('driver.instProfit'):</div>
                <div class="col-md-4 " >{{number_format($instProfits,2,'.','')}} ريال</div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3 money">@lang('driver.beenPayed'):</div>
                <div class="col-md-4">{{number_format($instPayedProfits,2,'.','')}} ريال</div>
            </div>
            <div class="col-md-12">
                <div class="col-md-4 money">@lang('driver.reset'):</div>
                <div class="col-md-4 ">{{number_format($resetPayment,2,'.','')}} ريال</div>
            </div>
            <div class="col-md-12">
                <div class="col-md-3 money">@lang('driver.pureProfits'):</div>
                <div class="col-md-4 ">{{number_format($pureProfits,2,'.','')}} ريال</div>
            </div>
        </div>

    </div>
</div>