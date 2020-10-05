@extends('layouts.app')

@section('content')
<div class="card text-center">
    <div class="card-header">
        <p class="timer"></p>
    </div>
    <div class="card-body">
        <h3 class="card-title">Feliz Jornada.</h3>
        <p class="card-text">Marca tus entradas y salidas.</p>
        <button id="checkIn" type="button" class="btn btn-success" onclick="StartTime()">Check In</button>
        <button id="checkOut" type="button" class="btn btn-danger" onclick="endTime()">Check Out</button>
    </div>
    <div class="card-footer text-muted">
        Los registros seran corroborados, recuerda hacer tus check correctamente.
    </div>
</div>
<script>
    var lastTimeRecord;
    var accumTime;
    var timeForShow;

    function getLastRecord()
    {
        lastTimeRecord = {!! json_encode($timeRecord) !!};
        return lastTimeRecord;
    }   

    function getLastAccumulateTime()
    {
        accumTime = {!! json_encode($accTime) !!};
        return accumTime;
    }  

    // formatAccTime

        function makeFormatAccTime()
        {
            var duration = moment.duration(accumTime, 'seconds');
            var formatted = duration.format("hh:mm:ss");
            return formatted;
        }

    // endFormatAccTime

    // actualFormatAccTime
    
        function makeActualFormatAccTime()
        {
            var floatAccumTime = moment.duration(accumTime, "seconds");
            var accTimeFormatted = floatAccumTime.format("HH:mm:ss");
            return accTimeFormatted
        }
    // endActualFormatAccTime

    // showTimeSeccion

        function showTime(time)
        {
            $('.timer').text(time);
        }

    // endShowtimeSeccion

    function makeTimeInterval(){

        timeForShow = setInterval(() => {
            let timeForInterval =  makeFormatAccTime();
            showTime(timeForInterval)
        }, 100);
    }
    
    // bottonStatusSeccion

        function bottonStatus()
        {
            initialLastTimeRecord = getLastRecord();

            if (initialLastTimeRecord)
            {
                if (initialLastTimeRecord.end_time == null)
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
            getLastAccumulateTime();
            makeTimeInterval();

            /* showTime(); */
        });
    // endInitialFunction


    // CheckIn start seccion

        function StartTime() {
            $.ajax({
                url:"{{ route('start') }}",  
                success:function(result)
                {
                    console.log(result)
                    lastTimeRecord = getLastRecord();
                    $('#checkIn').attr("disabled", "disabled");
                    $('#checkOut').removeAttr("disabled");
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
                    console.log(result)
                    lastTimeRecord = getLastRecord();
                    accumTime = result.lastAccumulateTime;
                    $('#checkOut').attr("disabled", "disabled");
                    $('#checkIn').removeAttr("disabled");
                }
            });
        }   

    // CheckOut stop seccion

</script>
@endsection


