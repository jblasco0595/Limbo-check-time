@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card text-center">
            <div class="card-header">
                <p class="timer"></p>
            </div>
            <div class="card-body">
                <h3 class="card-title">Los sueños se realizan cuando mantienes el compromiso con ellos.</h3>
                <p class="card-text">Marca tus entradas y salidas.</p>
                <button id="checkIn" type="button" class="btn btn-success" onclick="StartTime()">Check In</button>
                <button id="checkOut" type="button" class="btn btn-danger" onclick="endTime()">Check Out</button>
            </div>
            <div class="card-footer text-muted">
                Los registros seran corroborados, recuerda hacer tus check correctamente.
            </div>
        </div>
    </div>

</div>

<script>
    var lastTimeRecord = {!! json_encode($timeRecord) !!};
    var accumTime = parseFloat({!! json_encode($accTime)!!});
    var timeForShow = [];

    var makeTimeInterval = () =>
    {
        timeForShow.push( setInterval(() => {
            showTime()
        }, 100));
    }
    var stopTimeInterval = () =>
    {
        timeForShow.map( intervalID => clearInterval(intervalID) );
        timeForShow = []

    }
    //courrentTime

    function getWindowTime(initTime)
    {
        let start = moment.utc(initTime); // some random moment in time (in ms)
        let end = moment(); // some random moment after start (in ms)
        let diff = end.diff(start);
        let diffInSeconds = Math.round(diff / 1000);
        return diffInSeconds
    }
    //endCourrentTime

    // formatAccTime

    function makeFormatAccTime(timeForFormat)
    {
        var duration = moment.duration(timeForFormat, 'seconds');
        var formatted = duration.format("hh:mm:ss");
        return formatted;
    }

    // endFormatAccTime

    // showTimeSeccion

    function showTime()
    {
        if(lastTimeRecord)
        {
            if (lastTimeRecord.end_time == null)
            {
                var diff = getWindowTime(lastTimeRecord.init_time);
                var courrentTime = (parseFloat(accumTime) + parseFloat(diff));
                console.log(accumTime, diff, courrentTime);
                let timeForPrint = makeFormatAccTime(courrentTime);

                $('.timer').text(timeForPrint);
            }  else {
                let timeForPrint = makeFormatAccTime(accumTime);
                $('.timer').text(timeForPrint);
            }
        } else {
            let timeForPrint = makeFormatAccTime(0);
            $('.timer').text(timeForPrint);
        }
    }

    // endShowtimeSeccion


    // bottonStatusSeccion

    function bottonStatus()
    {
        if (lastTimeRecord)
        {
            if (lastTimeRecord.end_time == null)
            {
                $('#checkIn').attr("disabled", "disabled");
                $('#checkOut').removeAttr("disabled");
            } else {
                $('#checkOut').attr("disabled", "disabled");
                $('#checkIn').removeAttr("disabled");
            }
        } else {
            $('#checkOut').attr("disabled", "disabled");
            $('#checkIn').removeAttr("disabled");
        }

    }

    // endBottonsStatusSeccion

    // initalFunction

    $( document ).ready(function() {
        bottonStatus();
        makeTimeInterval();
    });
    // endInitialFunction


    // CheckIn start seccion

    function StartTime() {
        $.ajax({
            url:"{{ route('start') }}",
            success:function(result)
            {
                console.log(result);
                lastTimeRecord = result.lastTimeRange
                $('#checkIn').attr("disabled", "disabled");
                $('#checkOut').removeAttr("disabled");
                makeTimeInterval();
            }
        });
    }

    // CheckIn start seccion

    // CheckOut stop seccion

    function endTime() {
        $.ajax({
            url:"{{ route('end') }}",
            success:function(result)
            {
                accumTime = result.lastAccumulateTime;
                lastTimeRecord = result.lastTimeRange
                stopTimeInterval()
                $('#checkOut').attr("disabled", "disabled");
                $('#checkIn').removeAttr("disabled");
            }
        });
    }

    // CheckOut stop seccion

</script>
@endsection


