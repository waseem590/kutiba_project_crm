$(".menu-toggle").on('click', function (e) {
    e.preventDefault();
    $("#wrapper").toggleClass("toggled");
});

// preparing delete method
const deleteRecord = (id, uri) => {
    document.getElementById("identity").value;
    let route = window.location.origin + uri + id;
    // alert(route); Enter only Arabic Words
    document.getElementById("deleteForm").setAttribute("action", route);
    $("#deleteModal").modal("show");
};
const deleteClockRecord = (user_id, id, uri) => {
    document.getElementById("identity").value;
    let route = window.location.origin + uri + user_id +'/'+ id ;
    // alert(route);
    document.getElementById("deleteForm").setAttribute("action", route);
    $("#deleteModal").modal("show");
};

// Add active state to sidbar nav links
var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
$("#sidebar-wrapper a.nav-link").each(function() {
    if (this.href === path) {
        $(this).closest('.nav-link').addClass("active");
    }
});
// $('.www a').on('click', function(e){
//     // e.preventDefault();
//     // $('body').find('.www').addClass('showNew');
//     $('collapse:not(.show)').css("display", "block");
// });

$(document).ready(function () {
    $("#example").DataTable();
    $("#TaskListTable").DataTable();
        $("#ApplicationListTable").DataTable();
        $("#DeletedApplicationTable").DataTable();
});

var dData = function () {
    return Math.round(Math.random() * 90) + 10;
};

// Global Options:
Chart.defaults.global.defaultFontColor = "white";
Chart.defaults.global.defaultFontSize = 12;

var index = 11;
var cbx = document.getElementById("canvas_bars").getContext("2d");
var barChartDemo = new Chart(cbx, {
    type: "bar",
    data: {
        labels: [
            "1m ago",
            "20 secs ago",
            "15 secs ago",
            "10 secs ago",
            "5 secs ago",
        ],
        datasets: [
            {
                label: "VPS 1",
                data: [dData(), dData(), dData(), dData(), dData()],

                //backgroundColor: "rgba(255,255,255, 0.5)"
                backgroundColor: "rgba(34, 126, 201, 0.5)",
            },
            {
                label: "VPS 2",
                data: [dData(), dData(), dData(), dData(), dData()],
                //backgroundColor: "rgba(40, 69, 101, 0.5)"
                backgroundColor: "rgba(255,255,255, 0.3)",
            },
        ],
    },
    options: {
        animation: false,
    },
});

var ctx = document.getElementById("canvas_line");
var lineChart = new Chart(ctx, {
    type: "line",
    data: {
        labels: [
            "1m ago",
            "20 secs ago",
            "15 secs ago",
            "10 secs ago",
            "5 secs ago",
        ],
        datasets: [
            {
                label: "VPS 1",
                data: [dData(), dData(), dData(), dData(), dData()],

                //backgroundColor: "rgba(255,255,255, 0.5)"
                backgroundColor: "rgba(34, 126, 201, 0.5)",
            },
            {
                label: "VPS 2",
                data: [dData(), dData(), dData(), dData(), dData()],
                //backgroundColor: "rgba(40, 69, 101, 0.5)"
                backgroundColor: "rgba(255,255,255, 0.3)",
            },
        ],
    },
    options: {
        animation: false,
    },
});

function addData(number_of_positions) {
    var position = number_of_positions - 1;

    lineChart.data.datasets[0].data[position - 4] =
        lineChart.data.datasets[0].data[position - 3];
    lineChart.data.datasets[0].data[position - 3] =
        lineChart.data.datasets[0].data[position - 2];
    lineChart.data.datasets[0].data[position - 2] =
        lineChart.data.datasets[0].data[position - 1];
    lineChart.data.datasets[0].data[position - 1] =
        lineChart.data.datasets[0].data[position];

    lineChart.data.datasets[1].data[position - 4] =
        lineChart.data.datasets[1].data[position - 3];
    lineChart.data.datasets[1].data[position - 3] =
        lineChart.data.datasets[1].data[position - 2];
    lineChart.data.datasets[1].data[position - 2] =
        lineChart.data.datasets[1].data[position - 1];
    lineChart.data.datasets[1].data[position - 1] =
        lineChart.data.datasets[1].data[position];

    lineChart.data.datasets[0].data[position] = dData();
    lineChart.data.datasets[1].data[position] = dData();

    console.log(position);
    lineChart.update();
}

setInterval(function () {
    addData(5);
}, 5000);

$(".nav li").on("click", function () {
    $(".nav li").removeClass("active");
    $(this).addClass("active");
});

$(".menu-toggle").on('click', function (e) {
    e.preventDefault();
    $("#sidebar-wrapper").toggleClass("new-width");
});


