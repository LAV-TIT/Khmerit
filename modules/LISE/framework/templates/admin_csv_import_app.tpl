<script>
  let cvs_app = {
    running: false,
    start: 1,
    step: 10,
    end: 0,
    count: 0
  };

  let timer_app = {
    estimate_timer: null,
    start_time: 0,
    lap_time: 0
  };

  function msToTime(s)
  {
    // Pad to 2 or 3 digits, default is 2
    let pad = (n, z = 2) => ('00' + n).slice(-z);
    return pad(s/3.6e6|0) + 'H ' + pad((s%3.6e6)/6e4 | 0) + 'm ' + pad((s%6e4)/1000|0) + 's' /*+ pad(s%1000, 3)*/;
  }

  function set_end(val)
  {
    cvs_app.end = val;
    $("#progressbar").progressbar( "option", "max", cvs_app.end );
    $("#total").html(cvs_app.end);
  }

  function set_progress(val)
  {
    cvs_app.count = val;
    $("#count").html(cvs_app.count);
    $( "#progressbar" ).progressbar({
      value: cvs_app.count
    });
  }

  function start_estimating()
  {
    timer_app.start_time = new Date().getTime();
    timer_app.estimate_timer = setInterval(estimate_time, 1000);
  }

  function estimate_time()
  {
    timer_app.lap_time = new Date().getTime();
    let lapsed = timer_app.lap_time - timer_app.start_time;
    let ratio = lapsed / cvs_app.count;
    let estimated = ratio * cvs_app.end;
    let time_left = estimated - lapsed;
    $("#lapsed").html( msToTime(lapsed) );
    $("#time_estimated").html( msToTime(estimated) );
    $("#time_left").html( msToTime(time_left) );
  }

  function stop_estimating()
  {
    clearInterval(timer_app.estimate_timer);
  }

{*  function ajax_init()*}
{*  {*}
{*    $.ajax({*}
{*      type:"GET",*}
{*      url: "{cms_action_url action=admin_cvs_export_ajax forjs=1}",*}
{*      data: "{$actionid}wstp=0",*}
{*      success: function(data)*}
{*           {*}
{*             set_end(data.content.lines);*}
{*             //recursive_ajax();*}
{*           }*}
{*    });*}

{*  }*}

{*  function recursive_ajax()*}
{*  {*}
{*//    let step = cvs_app.step;*}
{*//*}
{*//    if(cvs_app.count === 0)*}
{*//    {*}
{*//      cvs_app.count = 1;*}
{*//    }*}

{*    if(cvs_app.count + cvs_app.step > cvs_app.end)*}
{*    {*}
{*      cvs_app.step = cvs_app.end - cvs_app.count;*}
{*    }*}

{*    $.ajax({*}
{*      type:"GET",*}
{*      url: "{cms_action_url action=admin_cvs_export_ajax forjs=1}",*}
{*      data: "{$actionid}wstp=1&{$actionid}offset=" + cvs_app.count + "&{$actionid}step=" + cvs_app.step,*}
{*      success: function(data)*}
{*               {*}
{*                 cvs_app.count = cvs_app.count + cvs_app.step;*}

{*                  //console.warn(cvs_app.count, cvs_app.end,  Math.round(cvs_app.count / cvs_app.end), Math.round( 1000 * (cvs_app.count / cvs_app.end) ) );*}
{*                 $( "#progressbar" ).progressbar({*}
{*                   //value: 1000 * (cvs_app.count / cvs_app.end)  //100 * (Loaded / Total)*}
{*                   value: cvs_app.count*}
{*                 });*}

{*                 $("#count").html(cvs_app.count);*}
{*                 $("#total").html(cvs_app.end);*}

{*                 if(cvs_app.count >= cvs_app.end)*}
{*                    {*}
{*                      stop();*}
{*                    }*}

{*                 if(cvs_app.running)*}
{*                   {*}
{*                     //console.warn("get jvm info success");*}
{*                     recursive_ajax();*}
{*                   }*}
{*                 else*}
{*                   {*}
{*                     console.warn("stopped");*}
{*                   }*}
{*                }*}
{*    });*}
{*  }*}

  function run()
  {
    console.warn("started");
    cvs_app.running = true;
    start_estimating();
    //ajax_init();
    recursive_ajax();
  }

  function stop()
  {
    stop_estimating();
    cvs_app.running = false;
  }

  function toggle()
  {
    if(cvs_app.running)
    {
      stop();
      $("#run").html('run');
    }
    else
    {
      run();
      $("#run").html('stop');
    }
  }

  $(function()
  {
    $("#progressbar").progressbar({
      max: 1000
    });

   $("#run").on( "click", function() {
     toggle();
     return false;
   });

    document.getElementById('loadarea').src = '{cms_action_url action=cvs_import_step_1 forjs=1}';

   //ajax_init();

  });

</script>

<div id="app">
  <div class="container c_full cf">
    <div id="messages" class="grid_8 warning">
      Please wait a few moments: preparation can take from a few seconds to a few minutes depending on the import size.
    </div>
  </div>
</div>

{*<a href="#" id="run" class="button">run</a>*}

<div id="progressbar" class="ui-progressbar-value"></div>
<div id="info" style="max-width: 50%">
  <p>Items: <span id="count" style="margin: auto">0</span> of <span id="total">0</span></p>
  <p>Time: <span id="lapsed" style="margin: auto">00H 00m 00s</span></p>
  <p>Left: <span id="time_left" style="margin: auto">00H 00m 00s</span></p>
  <p>Estimated: <span id="time_estimated" style="margin: auto">00H 00m 00s</span></p>
</div>



<iframe id="loadarea" style="display:none;"></iframe>



