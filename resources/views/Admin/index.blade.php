@include('Admin.header')
      <!-- End Navbar -->
      <div class="content">
{{--          <div class="text-right mt-3">--}}
{{--              <a href="{{ route('accounts.index') }}" class="btn btn-primary">Account List</a>--}}
{{--          </div>--}}
          <div class="row">
              <div class="col text-right">
                  <a href="{{ route('BankAccount') }}" class="btn btn-secondary">Bank Accounts</a>
              </div>
              <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                  @csrf
                  <button type="submit" class="btn btn-secondary">
                      <i class="fa fa-user" aria-hidden="true"></i> Logout
                  </button>
              </form>
          </div>
        <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-single-02 text-danger"></i>
                    </div>
                  </div>
                    <div class="col-7 col-md-12">
                        <div class="numbers">
                            <p class="card-category">Created</p>
                            <a href="{{ route('accounts.index') }}" class="btn btn-danger" class="card-title">Accounts</a>
                        </div>
                    </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update Now
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-12">
                    <div class="numbers">
                      <p class="card-category">Completed</p>
                        <a href="{{ route('transactions.index') }}" class="btn btn-success" class="card-title">Trans</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-calendar-o"></i>
                  Last day
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-bank text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-12">
                    <div class="numbers">
                      <p class="card-category">Approved</p>
                        <a href="{{ route('loans.index') }}" class="btn btn-warning" class="card-title">Loans</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-clock-o"></i>
                  In the last hour
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-world-2 text-primary"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-12">
                    <div class="numbers">
                      <p class="card-category">Currency</p>
                      <a href="{{ route('Rate') }}" class="btn btn-primary" class="card-title">Rates</a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-refresh"></i>
                  Update now
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Users Behavior</h5>
                <p class="card-category">24 Hours performance</p>
              </div>
              <div class="card-body ">
                <canvas id=chartHours width="400" height="100"></canvas>
              </div>
              <div class="card-footer ">
                <hr>
                <div class="stats">
                  <i class="fa fa-history"></i> Updated 3 minutes ago
                </div>
              </div>
            </div>
          </div>
        </div>
{{--        <div class="row">--}}
{{--          <div class="col-md-4">--}}
{{--            <div class="card ">--}}
{{--              <div class="card-header ">--}}
{{--                <h5 class="card-title">Email Statistics</h5>--}}
{{--                <p class="card-category">Last Campaign Performance</p>--}}
{{--              </div>--}}
{{--              <div class="card-body ">--}}
{{--                <canvas id="chartEmail"></canvas>--}}
{{--              </div>--}}
{{--              <div class="card-footer ">--}}
{{--                <div class="legend">--}}
{{--                  <i class="fa fa-circle text-primary"></i> Opened--}}
{{--                  <i class="fa fa-circle text-warning"></i> Read--}}
{{--                  <i class="fa fa-circle text-danger"></i> Deleted--}}
{{--                  <i class="fa fa-circle text-gray"></i> Unopened--}}
{{--                </div>--}}
{{--                <hr>--}}
{{--                <div class="stats">--}}
{{--                  <i class="fa fa-calendar"></i> Number of emails sent--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
{{--          <div class="col-md-8">--}}
{{--            <div class="card card-chart">--}}
{{--              <div class="card-header">--}}
{{--                <h5 class="card-title">NASDAQ: AAPL</h5>--}}
{{--                <p class="card-category">Line Chart with Points</p>--}}
{{--              </div>--}}
{{--              <div class="card-body">--}}
{{--                <canvas id="speedChart" width="400" height="100"></canvas>--}}
{{--              </div>--}}
{{--              <div class="card-footer">--}}
{{--                <div class="chart-legend">--}}
{{--                  <i class="fa fa-circle text-info"></i> Tesla Model S--}}
{{--                  <i class="fa fa-circle text-warning"></i> BMW 5 Series--}}
{{--                </div>--}}
{{--                <hr />--}}
{{--                <div class="card-stats">--}}
{{--                  <i class="fa fa-check"></i> Data information certified--}}
{{--                </div>--}}
{{--              </div>--}}
{{--            </div>--}}
{{--          </div>--}}
        </div>
      </div>
@include('Admin.footer')
