
// $.ajax({
//     type: "POST",
//     url: "",
//     data: $("#start").val(),
//     dataType: "json",
//     success: function(data) {
//         console.log(1)
//     }
// });
// $("#tx").on("input", function(e) {
//     var input = $(this);
//     var val = input.val();
//
//         console.log(val);
//
//
// });
// $.ajax({
//     type: "POST",
//     url: 'login.php',
//     data: $(this).serialize(),
//     success: function(response)
//     {
//         var jsonData = JSON.parse(response);
//
//         // user is logged in successfully in the back-end
//         // let's redirect
//         if (jsonData.success == "1")
//         {
//             location.href = 'my_profile.php';
//         }
//         else
//         {
//             alert('Invalid Credentials!');
//         }
//     }
// });
//console.log("Main.js");

// $('#timerbutton').on('click',function (event){
//    // console.log('test');
//     event.preventDefault();
//     let state = $(this).val();
//     // console.log(state);
//     if(state == "start"){
//         $(this).prop('value', 'stop');
//     }else{
//         $(this).prop('value', 'start');
//     }
//     $.ajax({
//         type: "POST",
//         url: "test",
//         dataType: 'json',
//         data: {"state": state },         // данные, которые отправляем на сервер
//         success: function(data) {
//             console.log(data);
//             var test = JSON.parse(data);
//             // console.log(test);
//
//             $("#timertable").empty();
//             //$("#timertable").append("<tr><td><input id=\"timerbutton\"  class=\"mk\" type=\"button\" name=\"timerbutton\" value="+state+" /></td></tr>");
//             console.log(data);
//
//             // $('#start-test').attr('data-id', test);
//         }
//     });
//     // .fail(function(data) {
//     //    console.log(data)
//     // });
// });

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
                console.log( "started time" + ": " + value['started_time'] );
                console.log( "stopped time" + ": " + value['stopped_time'] );
                // if(value['started_time'] == "10:58"){
                //     console.log(7878)
                // }

                var start = value['started_time'];
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