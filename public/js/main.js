
$('#timerbutton').on('click',function (event){
    event.preventDefault();
    let state = $(this).val();
    if(state == "start"){
        $(this).prop('value', 'stop');
    }else{
        $(this).prop('value', 'start');
    }

    $.ajax({

        type: "POST",
        url: "tracker/test",
        dataType: 'json',
        data: {
            "state": state
        },         // данные, которые отправляем на сервер
        success: function(data) {
            $("#timertable").empty();
            // $("#timertable").remove();
            // console.log(data);
            $.each(data, function( index, value ) {
                // console.log( "started time" + ": " + value['started_time'] );
                // console.log( "stopped time" + ": " + value['stopped_time'] );
                // if(value['started_time'] < "11:05:00"){
                //     console.log('ok')
                // }
                // else{
                //     console.log("late")
                // }

                // var start = value['started_time'];
                var stop = value['stopped_time'] == null ? '' : value['stopped_time'];
                var total = value['total_time'] == null ? '' : value['total_time'];
                // $("#timertable").empty();
                $("#timertable").append("<tr>" +
                        "<td>"+ start +" :: </td>" +
                        "<td>"+ stop +"</td>" +
                        "<td>"+"" + total + "</td>" +
                    "</tr>");
            });
        }
    });


});