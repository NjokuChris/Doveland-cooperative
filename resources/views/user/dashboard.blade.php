
   @extends('layouts.admin')

   @section('content')

      <!-- Content Header (Page header) -->
       <div class="content-header">
         <div class="container-fluid">
           <div class="row mb-2">
             <div class="col-sm-6">
               <h1 class="m-0">{{ Auth::user()->name }}</h1>
             </div><!-- /.col -->
             <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                 <li class="breadcrumb-item"><a href="#">Home</a></li>
                 <li class="breadcrumb-item active">Dashboard</li>
               </ol>
             </div><!-- /.col -->
           </div><!-- /.row -->
         </div><!-- /.container-fluid -->
       </div>
       <!-- /.content-header -->

       <!-- Main content -->
       <section class="content">
         <div class="container-fluid">
           <!-- Small boxes (Stat box) -->
           <div class="row">
             <div class="col-lg-3 col-6">
               <!-- small box -->
               <div class="small-box bg-info">
                 <div class="inner">

                   <p>Current Balance</p>

                   <h3><span>&#8358;</span>{{number_format($member->current_balance ?? 0)}}</h3>
                 </div>
                 <div class="icon">
                   <i class="ion ion-bag"></i>
                 </div>
                 <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                     <p>Monthly Savings Amount</p>

                    <h3><span>&#8358;</span>{{number_format($member->savings_amount ?? 0) }}</h3>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
             @foreach($loans as $l)
             <div class="col-lg-4 col-6">
               <!-- small box -->
               <div class="small-box bg-warning">
                 <div class="inner">
                    <table>
                        <tr>
                           <th style="color:#fcfcfd"> {{$l->loans_type->salary_group}} </th>
                        </tr>

                        <tr>
                            <th style="color:#fcfcfd">Total Amount</th>
                            <td>{{number_format($l->total_payable_amount)}}</td>
                        </tr>

                        <tr>
                            <th style="color:#fcfcfd">Total Repayments</th>
                            <td>&#8358;{{number_format($l->amount_paid)}}</td>
                        </tr>
                        <tr>
                            <th style="color:#fcfcfd">Running Balance</th>
                            <td>&#8358;{{number_format($l->balance)}}</td>
                        </tr>
                    </table>
                 </div>
                 <div class="icon">
                   <i class="ion ion-stats-bars"></i>
                 </div>
                 <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
               </div>
             </div>
             @endforeach
             <!-- ./col -->

           </div>
           <!-- /.row -->
           <div class="card">
           <div class="card-header">
            <h3 class="card-title"><i class="fa fa-book"></i>   &nbsp;&nbsp;<a href="{{ route('user.withdrawers.create') }}" style="text-align: left">Apply for Cash Withdrawer</a></h3>
            <p style="text-align:right"><a href="{{ route('user.loans.create') }}" style="text-align: left">Apply for Loan</a> <i class="fas fa-angle-double-right right"></i></p>
           </div>
           </div>
           <!-- Main row -->
           <div class="row">
             <!-- Left col -->
             <section class="col-lg-7 connectedSortable">
               <!-- Custom tabs (Charts with tabs)-->
               <div class="card">
                 <div class="card-header">
                   <h3 class="card-title">
                     <i class="fas fa-chart-pie mr-1"></i>
                     Sales
                   </h3>
                   <div class="card-tools">
                     <ul class="nav nav-pills ml-auto">
                       <li class="nav-item">
                         <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                       </li>
                       <li class="nav-item">
                         <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                       </li>
                     </ul>
                   </div>
                 </div><!-- /.card-header -->
                 <div class="card-body">
                   <div class="tab-content p-0">
                     <!-- Morris chart - Sales -->
                     <div class="chart tab-pane active" id="revenue-chart"
                          style="position: relative; height: 300px;">
                         <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                      </div>
                     <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                       <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                     </div>
                   </div>
                 </div><!-- /.card-body -->
               </div>
               <!-- /.card -->
             </section>
             <!-- /.Left col -->
             <!-- right col (We are only adding the ID to make the widgets sortable)-->
             <section class="col-lg-5 connectedSortable">
               <!-- solid sales graph -->
               <div class="card bg-gradient-info">
                 <div class="card-header border-0">
                   <h3 class="card-title">
                     <i class="fas fa-th mr-1"></i>
                     Sales Graph
                   </h3>

                   <div class="card-tools">
                     <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                       <i class="fas fa-minus"></i>
                     </button>
                     <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                       <i class="fas fa-times"></i>
                     </button>
                   </div>
                 </div>
                 <div class="card-body">
                   <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                 </div>
                 <!-- /.card-body -->
                 <div class="card-footer bg-transparent">
                   <div class="row">
                     <div class="col-4 text-center">
                       <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                              data-fgColor="#39CCCC">

                       <div class="text-white">Mail-Orders</div>
                     </div>
                     <!-- ./col -->
                     <div class="col-4 text-center">
                       <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                              data-fgColor="#39CCCC">

                       <div class="text-white">Online</div>
                     </div>
                     <!-- ./col -->
                     <div class="col-4 text-center">
                       <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                              data-fgColor="#39CCCC">

                       <div class="text-white">In-Store</div>
                     </div>
                     <!-- ./col -->
                   </div>
                   <!-- /.row -->
                 </div>
                 <!-- /.card-footer -->
               </div>
               <!-- /.card -->
             </section>
             <!-- right col -->

              <!-- Main content -->
    <section class="conten col-lg-12">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <!-- /.card -->

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"><i class="fa fa-book"></i>   &nbsp;&nbsp;Most Recent Transactions ({{ Auth::user()->name }})</h3>
                  <p style="text-align:right"><a href="{{ route('statement_acc_search') }}" style="text-align: left">Get Account Statements</a> <i class="fas fa-angle-double-right right"></i></p>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Date</th>
                      <th>Amount (NGN)</th>
                      <th>Description</th>
                      <th>Trans. Type</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($transaction as $t)
                      <tr>
                          <td>{{$t['id']}}</td>
                          <td>{{$t['transaction_date']}}</td>
                          <td>{{$t['amount']}}</td>
                          <td>
                              {{$t->naration}}
                          </td>
                          <td>
                              @if($t->salary_group != null)

                                    {{$t->salary_group->salary_group}}
                                  </span>

                              @endif
                          </td>


                      </tr>
                      @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                      <th>S/N</th>
                      <th>Date</th>
                      <th>Amount (NGN)</th>
                      <th>Description</th>
                      <th>Trans. Type</th>
                    </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.card-body -->

              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
           </div>
           <!-- /.row (main row) -->
         </div><!-- /.container-fluid -->
       </section>
       <!-- /.content -->
       @endsection
