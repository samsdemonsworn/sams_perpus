@extends('template')

@section('judul')
Dashboard
@stop

@section('ac-dash')
active
@stop

@section('subjudul')
The future is not where my dream is
@stop

@section('content')
<div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-red">
      <span class="info-box-icon"><i class="fa fa-star-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">{{ $pinjam_banyak[0]->nama }}</span>
        <span class="info-box-number">{{ $pinjam_banyak[0]->jumlah }} Buku</span>
        <div class="progress">
          <div class="progress-bar" style="width:{{ $pinjam_banyak[0]->jumlah }}%"></div>
        </div>
            <span class="progress-description">
            Pinjam buku terbanyak
            </span>
      </div>
      <!-- /.info-box-content -->
    </div> 
      <!-- /.info-box  -->
  </div> 

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-yellow">
      <span class="info-box-icon"><i class="fa fa-users"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Anggota</span>
        <span class="info-box-number">{{ $anggota[0]->jumlah }} Anggota</span>

        <div class="progress">
          <div class="progress-bar" style="width: {{ $anggota[0]->jumlah }}%"></div>
        </div>
            <span class="progress-description">
              Anggota Saat Ini
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-aqua">
      <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Jumlah Peminjam</span>
        <span class="info-box-number">{{ $jmlh_pinjam[0]->jumlah }} <i class="fa fa-user"></i></span>

        <div class="progress">
          <div class="progress-bar" style="width: {{ $jmlh_pinjam[0]->jumlah }}%"></div>
        </div>
            <span class="progress-description" id="bulan">
              
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box bg-aqua">
      <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">{{ $p_bulan[0]->nama }}</span>
        <span class="info-box-number">{{ $p_bulan[0]->jumlah }}</span>

        <div class="progress">
          <div class="progress-bar" style="width: {{$p_bulan[0]->jumlah}}%"></div>
        </div>
            <span class="progress-description" >
              pinjam banyak/bulan
            </span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="content">
    <div class="row">
      <div class="col-xs-12">
            <!-- interactive chart -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <i class="fa fa-bar-chart-o"></i>

              <h3 class="box-title">Pelengkap supaya Area Chart penuh</h3>

              <div class="box-tools pull-right">
                Real time
                <div class="btn-group" id="realtime" data-toggle="btn-toggle">
                  <button type="button" class="btn btn-default btn-xs active" data-toggle="on">On</button>
                  <button type="button" class="btn btn-default btn-xs" data-toggle="off">Off</button>
                </div>
              </div>
            </div>
            <div class="box-body">
              <div id="interactive" style="height: 300px;"></div>
            </div>
            <!-- /.box-body-->
          </div>
            <!-- /.box -->

      </div>
        <!-- /.col -->
    </div>
  </div>

  <script>
var month = new Array();
month[0] = "Januari";
month[1] = "Februari";
month[2] = "Maret";
month[3] = "April";
month[4] = "Mei";
month[5] = "Juni";
month[6] = "Juli";
month[7] = "Agustus";
month[8] = "September";
month[9] = "Oktober";
month[10] = "November";
month[11] = "Desember";

var d = new Date();
var m = month[d.getMonth()];
document.getElementById("bulan").innerHTML = m;

</script>

<script>
$(function(){
/*
     * Flot Interactive Chart
     * -----------------------
     */
    // We use an inline data source in the example, usually data would
    // be fetched from a server
    var data = [], totalPoints = 100

    function getRandomData() {

      if (data.length > 0)
        data = data.slice(1)

      // Do a random walk
      while (data.length < totalPoints) {

        var prev = data.length > 0 ? data[data.length - 1] : 50,
            y    = prev + Math.random() * 10 - 5

        if (y < 0) {
          y = 0
        } else if (y > 100) {
          y = 100
        }

        data.push(y)
      }

      // Zip the generated y values with the x values
      var res = []
      for (var i = 0; i < data.length; ++i) {
        res.push([i, data[i]])
      }

      return res
    }

    var interactive_plot = $.plot('#interactive', [getRandomData()], {
      grid  : {
        borderColor: '#f3f3f3',
        borderWidth: 1,
        tickColor  : '#f3f3f3'
      },
      series: {
        shadowSize: 0, // Drawing is faster without shadows
        color     : '#3c8dbc'
      },
      lines : {
        fill : true, //Converts the line chart to area chart
        color: '#3c8dbc'
      },
      yaxis : {
        min : 0,
        max : 100,
        show: true
      },
      xaxis : {
        show: true
      }
    })

    var updateInterval = 500 //Fetch data ever x milliseconds
    var realtime       = 'on' //If == to on then fetch data every x seconds. else stop fetching
    function update() {

      interactive_plot.setData([getRandomData()])

      // Since the axes don't change, we don't need to call plot.setupGrid()
      interactive_plot.draw()
      if (realtime === 'on')
        setTimeout(update, updateInterval)
    }

    //INITIALIZE REALTIME DATA FETCHING
    if (realtime === 'on') {
      update()
    }
    //REALTIME TOGGLE
    $('#realtime .btn').click(function () {
      if ($(this).data('toggle') === 'on') {
        realtime = 'on'
      }
      else {
        realtime = 'off'
      }
      update()
    })
    /*
     * END INTERACTIVE CHART
     */
})
</script>

@stop
